<?php 

namespace App\Controller;

use App\Model\BetModel;
use App\Model\QuestionModel;
use App\Model\UserAnswersModel;
use Core\Controller\Controller;
use Core\Tools\Session;


class BetResponseController extends Controller {

    private $user;

    private $betModel;
    private $userAnswerModel;
    private $questionModel;

    public function __construct()
    {
        $this->betModel = new BetModel();
        $this->userAnswerModel = new  UserAnswersModel();
        $this->questionModel = new QuestionModel();

        $this->protectPageFor("user", LOGIN);

        $this->user = Session::get("user");

    }

    /**
     * (GET) Starting page to play a bet
     * 
     * @param string $betId
     */
    public function startPage(string $betId) {

        $bet = $this->betModel->find(["idBet" => $betId]);

        if(!$bet) {
            $this->redirectWithErrors(BET_LIST, "Le pari n'existe pas");
        }

        $this->render("betResponseStartView", ["bet" => $bet[0]]);

    }

    /**
     * (GET) Answer page
     * 
     * @param string $betId
     */
    public function pageForAnswers (string $betId) {
        $bet = $this->betModel->find(["idbet" => $betId]);

        if(!$bet) {
            $this->redirect(BET_LIST, "Le pari n'existe pas");
        }

        $this->render("betResponseView", ["bet"=>$bet[0]]);
    }

    /**
     * (GET) For getting specific question (JSON FORMAT)
     * 
     * @param string $betId
     * @param string $questionNumber
     */
    public function getQuestion($betId, $questionNumber) {
        
        $this->protectAgainstDoubleAnswers($betId, $questionNumber - 1);

        $question = $this->questionModel->findQuestionWithAnswers($betId, $questionNumber - 1);

        if($question) {
            $this->renderJson($question, HTTP_GOOD_REQ);
        }
        else {
            $this->renderJson("Plus de question disponible", HTTP_NOT_FOUND);
        }
        
    }

    /**
     * (POST) For persisting answer in database
     * 
     * @param string $betId 
     * @param int $questionOrder
     */
    public function recieveAnswer (string $betId, int $questionOrder) {
      
        $this->protectAgainstDoubleAnswers($betId, $questionOrder - 1);

        $this->userAnswerModel->saveUserAnswer($_POST["bet-answer"], $this->user->idUser, $_POST["idQuestion"]);

        $nextQuestion = $this->questionModel->isExist(["idbet" => $betId, "questionOrder" => $questionOrder]);

        $this->renderJson(
        [
            "message"=>"Answer created",
            "nextQuestion" => $nextQuestion ?  $questionOrder + 1 : "" 
        ]
        , HTTP_CREATED);
              
   
    }

    /**
     * For protecting against double answers by the same user
     * 
     * @param string $betId
     * @param int $questionOrder
     */
    private function protectAgainstDoubleAnswers($betId, $questionOrder) {
        $answerAlreadyExist = $this->userAnswerModel->alreadyAnswered( $betId, $questionOrder, $this->user->idUser);

        if($answerAlreadyExist) {
            $this->renderJson("L'utilisateur a déjà participé à ce pari", HTTP_BAD_REQ);
        }
    }

}