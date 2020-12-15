<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Form\UserForm;
use Core\Controller\Controller;
use Core\Tools\Session;



class RegisterController extends Controller{

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }   

    public function registerPage() {
        $error = Session::get("error");
        $this->render("registerView", compact("error"));

    }
    public function register(){
        
        $userForm = new UserForm($_POST);
        $userForm->validate();
        $validateError = $userForm->getErrors();
        
        if($validateError){
            $this->redirectWithErrors("/register", "error");
        }

        $uniqueUser = $this->userModel->checkUnique(["email" =>$_POST["email"], "password" =>$_POST["password"]]);
        

        if($uniqueUser){
            $passwordHash = password_hash($_POST["password"], PASSWORD_BCRYPT);

            $result = $this->userModel->save(
                $_POST["username"],
                $_POST["email"],
                $passwordHash,
                $_POST["firstName"],
                $_POST["lastName"] 
            );

            if(!$result) $this->redirectWithErrors("/login", "Server Error");

            $this->redirect("/login");

        }else{
            Session::set("error", "Pseudo ou email incorrect");
            $this->redirect("/register");
        }
    }
}