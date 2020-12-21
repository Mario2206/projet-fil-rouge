<?php

namespace App\Controller;

use App\Model\FriendsModel;
use App\Model\UserModel;
use Core\Controller\Controller;
use Core\Tools\Session;

class FriendsController extends Controller{

    private $friendsModel;
    private $userModel;
    private $user;

    public function __construct(){
        $this->protectPageFor("user", LOGIN);
        
        $this->friendsModel = new FriendsModel();
        $this->userModel = new UserModel();

        $this->user = Session::get("user");
    }

    /**
     * (GET) Friends page
     */
    public function friendsPage(){

        $idUser = $this->user->idUser;

        $friends = $this->friendsModel->getFriends($idUser);
        $this->render("friendsView", compact("friends"));

    }

    /**
     * (POST) Add friend
     */
    public function addFriend(){

        if(!isset($_POST["username"]) || !$_POST["username"]) {
            $this->redirectWithErrors(FRIENDS, "La requête a échoué");
        }

        $searchedUser = $this->userModel->findOne(["username" => $_POST["username"]]);

        if(!$searchedUser) {
            $this->redirectWithErrors(FRIENDS, "Aucun utilisateur trouvé");
        }

        $alreadyFriend = $this->friendsModel->alreadyFriend($this->user->idUser, $searchedUser->idUser);

        if($alreadyFriend){
            $this->redirectWithErrors(FRIENDS, "Vous ne pouvez pas ajouter un utilisateur qui est déjà dans votre liste d'amis");   
        }

        $this->friendsModel->addFriend($this->user->idUser, $searchedUser->idUser);
        $this->redirect(FRIENDS, "Ami ajouté !");

    }

    /**
     * (GET) Remove friend
     */
    public function removeFriend($friendId){

        $idUser = $this->user->idUser;

        $this->friendsModel->deleteFriend($idUser, $friendId);

        $this->redirect(FRIENDS);
    }

}