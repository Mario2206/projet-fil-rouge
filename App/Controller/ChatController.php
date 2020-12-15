<?php

namespace App\Controller;

use App\Form\MessagesForm;
use App\Model\PollMessagesModel;
use App\Model\PollModel;
use Core\Controller\Controller;
use Core\Tools\Session;


class ChatController extends Controller {

    private $user;
    private $pollModel;
    private $messagesModel;

    public function __construct()
    {
        $this->protectPageFor("user", POLL_LIST_FRIENDS);
        $this->user = Session::get("user");
        $this->messagesModel = new PollMessagesModel();
        $this->pollModel = new PollModel();
    }


    public function chatPage ($pollId) {

        $poll = $this->pollModel->find(["idPoll" => $pollId]);
        
        if(!$poll) {
            $this->redirectWithErrors(POLL_LIST_FRIENDS, "Le sondage n'existe pas");
        }

        $this->render("pollChatView", ["poll" => $poll[0]]);
    }

    public function getMessages($idPoll) {
        $messages = $this->messagesModel->findAllMessages($idPoll);
        $this->renderJson($messages, HTTP_GOOD_REQ);
    }

    public function postMessage($idPoll) {

        $messageForm = new MessagesForm($_POST);
        $messageForm->validate();

        if($messageForm->getErrors()) {
            $this->renderJson("Le message n'est pas conforme", HTTP_BAD_REQ);
        }

        $this->messagesModel->insert($_POST["poll-message"], $this->user->idUser, $idPoll);

        $this->renderJson("Message created", HTTP_CREATED);

    }

}