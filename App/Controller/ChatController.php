<?php

namespace App\Controller;

use App\Form\MessagesForm;
use App\Model\FriendsModel;
use App\Model\MessagesModel;
use Core\Controller\Controller;
use Core\Tools\Session;


class ChatController extends Controller {

    private $user;
    private $friendsModel;
    private $messagesModel;

    public function __construct()
    {
        $this->protectPageFor("user", FRIENDS);
        $this->user = Session::get("user");
        $this->messagesModel = new MessagesModel();
        $this->friendsModel = new FriendsModel();
    }

    /**
     * (GET) Chat page
     * 
     * @param string $idFriend 
     */
    public function chatPage (string $idFriend) {

        $friend = $this->friendsModel->getOneFriend($this->user->idUser, $idFriend);
        if(!$friend) {
            $this->redirectWithErrors(FRIENDS, "L'utilisateur ne fait pas parti de vos amis");
        }

        $this->render("chatView", compact("friend"));
    }

    /**
     * (GET) For sending message
     * 
     * @param string $idFriend
     */
    public function getMessages( string $idFriend) {
        $messages = $this->messagesModel->findAllMessages($this->user->idUser,$idFriend);
        $this->renderJson($messages, HTTP_GOOD_REQ);
    }

    /**
     * (POST) For persisting messages in database
     * 
     * @param string $idFriend
     */
    public function postMessage(string $idFriend) {

        $messageForm = new MessagesForm($_POST);
        $messageForm->validate();

        if($messageForm->getErrors()) {
            $this->renderJson("Le message n'est pas conforme", HTTP_BAD_REQ);
        }

        $this->messagesModel->saveMessage($_POST["message"], $this->user->idUser, $idFriend);

        $this->renderJson("Message created", HTTP_CREATED);

    }

}