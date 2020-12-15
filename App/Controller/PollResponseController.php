<?php 

namespace App\Controller;


use App\Model\PollModel;
use App\Model\QuestionModel;
use App\Model\UserAnswersModel;
use Core\Controller\Controller;
use Core\Tools\Session;


class PollResponseController extends Controller {

    private $user;

    private $pollModel;
    private $userAnswerModel;
    private $questionModel;

    public function __construct()
    {
        $this->pollModel = new PollModel();
        $this->userAnswerModel = new  UserAnswersModel();
        $this->questionModel = new QuestionModel();

        $this->protectPageFor("user", LOGIN);

        $this->user = Session::get("user");

    }

    public function startPage(string $pollId) {

        $poll = $this->pollModel->find(["idPoll" => $pollId]);

        if(!$poll) {
            $this->redirect(POLL_LIST_FRIENDS);
        }

        $this->render("pollResponseStartView", ["poll" => $poll[0]]);

    }

    public function pageForAnswers (string $pollId) {
        $poll = $this->pollModel->find(["idPoll" => $pollId]);

        if(!$poll) {
            $this->redirect(POLL_LIST_FRIENDS);
        }

        $this->render("pollResponseView", ["poll"=>$poll[0]]);
    }

    public function getQuestion($pollId, $questionNumber) {
        
        $this->protectAgainstDoubleAnswers($pollId, $questionNumber - 1);

        $question = $this->questionModel->findQuestionWithAnswers($pollId, $questionNumber - 1);

        if($question) {
            $this->renderJson($question, HTTP_GOOD_REQ);
        }
        else {
            $this->renderJson("Plus de question disponible", HTTP_NOT_FOUND);
        }
        
    }

    public function recieveAnswer ($pollId, $questionOrder) {
      
        $this->protectAgainstDoubleAnswers($pollId, $questionOrder - 1);

        $this->userAnswerModel->saveUserAnswer($_POST["poll-answer"], $this->user->idUser, $_POST["idQuestion"]);

        $nextQuestion = $this->questionModel->isExist(["idPoll" => $pollId, "questionOrder" => $questionOrder]);

        $this->renderJson(
        [
            "message"=>"Answer created",
            "nextQuestion" => $nextQuestion ?  $questionOrder + 1 : "" 
        ]
        , HTTP_CREATED);
              
   
    }

    private function protectAgainstDoubleAnswers($pollId, $questionOrder) {
        $answerAlreadyExist = $this->userAnswerModel->alreadyAnswered( $pollId, $questionOrder, $this->user->idUser);

        if($answerAlreadyExist) {
            $this->renderJson("L'utilisateur a déjà répondu à cette question", HTTP_BAD_REQ);
        }
    }

}