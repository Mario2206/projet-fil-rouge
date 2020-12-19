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
        $this->render("registerView");

    }
    public function register(){
        
        $userForm = new UserForm($_POST);
        $userForm->validate();
        $validateError = $userForm->getErrors();
        
        if($validateError){
            $this->redirectWithErrors("/register", $validateError);
        }

        $uniqueUser = $this->userModel->checkUnique(["email" =>$_POST["email"], "password" =>$_POST["password"]]);
        

        if($uniqueUser){
            $passwordHash = password_hash($_POST["password"], PASSWORD_BCRYPT);

            $result = $this->userModel->save(
                $_POST["username"],
                $_POST["email"],
                $passwordHash,
                $_POST["firstname"],
                $_POST["lastname"] 
            );

            if(!$result) $this->redirectWithErrors("/login", "Server Error");

            $this->redirect("/login", "Le compte a été créé correctement !");

        }
            
        $this->redirectWithErrors("/register", "Pseudo ou email déjà utilisé");
        
    }
}