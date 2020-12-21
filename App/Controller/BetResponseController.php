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

        $answerAlreadyExist = $this->userAnswerModel->alreadyAnswered( $betId, 0, $this->user->idUser);

        if($answerAlreadyExist) {
            
            $this->redirectWithErrors(BET_LIST, "L'utilisateur a déjà participé au pari");
        }

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
     * @param string $questionOrder
     */
    public function getQuestion($betId, $questionOrder) {
        
        $answerAlreadyExist = $this->userAnswerModel->alreadyAnswered( $betId, $questionOrder - 1, $this->user->idUser);

        if($answerAlreadyExist) {
            
            $this->renderJson("L'utilisateur a déjà participé à ce pari", HTTP_BAD_REQ);
        }

        $question = $this->questionModel->findQuestionWithAnswers($betId, $questionOrder - 1);

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
      
        $answerAlreadyExist = $this->userAnswerModel->alreadyAnswered( $betId, $questionOrder - 1, $this->user->idUser);

        if($answerAlreadyExist) {
            
            $this->renderJson("L'utilisateur a déjà participé à ce pari", HTTP_BAD_REQ);
        }

        $this->userAnswerModel->saveUserAnswer($_POST["bet-answer"], $this->user->idUser, $_POST["idQuestion"]);

        $nextQuestion = $this->questionModel->isExist(["idbet" => $betId, "questionOrder" => $questionOrder]);

        $this->renderJson(
        [
            "message"=>"Answer created",
            "nextQuestion" => $nextQuestion ?  $questionOrder + 1 : "" 
        ]
        , HTTP_CREATED);
              
   
    }

}