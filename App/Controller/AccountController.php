<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Form\UserForm;
use Core\Controller\Controller;
use Core\Tools\Session;



class AccountController extends Controller{

    private $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }   

    public function accountPage(){
        $user = Session::get("user");
        $this->render("myAccount", compact("user"));
    }

    public function accountSet(){

        $userForm = new UserForm($_POST);
        $userForm->validate();
        
        if($userForm->getErrors()){
            $this->redirectWithErrors(ACCOUNT, "Les champs rentrés ne sont pas corrects");
        }

        $user = Session::get("user");
        
        $idUser = $user->idUser;

        $postFilter = \array_filter($_POST, function($key){
            return $key != "password-retype";
        }, ARRAY_FILTER_USE_KEY);
        
        $postFilter["password"] = password_hash($postFilter["password"], PASSWORD_BCRYPT);

        $res = $this->userModel->update($postFilter,["idUser" =>$idUser]);

        if($res) {
            $user = $this->userModel->findOne(["idUser"=> $user->idUser]);
            Session::set("user", $user);
            $this->redirect(ACCOUNT); 
        }

        $this->redirectWithErrors("Aucune modification enregistrée", HTTP_BAD_REQ);

        
    }
}