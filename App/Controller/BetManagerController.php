<?php 

namespace App\Controller;

use App\Form\OpenBetForm;
use App\Model\AnswerModel;
use App\Model\BetModel;
use App\Model\UserAnswersModel;
use Core\Controller\Controller;
use Core\Model\Converters\TypeConverter;
use Core\Tools\Session;
use DateTime;

class BetManagerController extends Controller {

    private $betModel;
    private $userAnswerModel;
    private $answerModel;
    private $user;

    public function __construct()
    {
        $this->user = Session::get("user");
        $this->protectPageFor("user", LOGIN);
        $this->betModel = new BetModel();
        $this->userAnswerModel = new UserAnswersModel();
        $this->answerModel = new AnswerModel();
        
    }



    /**
     * (GET) display bet report page
     * 
     * @param string $idbet
     */

    public function getBetReport( string $idbet) {

        $this->protectAgainstCheat($idbet);

        $bet = $this->betModel->find(["idBet"=>$idbet]);
        $currentDate = TypeConverter::stringifyDate(new DateTime());
        
        $this->render("betReportView", ["bet" => $bet[0], "currentDate" => $currentDate]);

    }

    /**
     * (GET) For sending results of one bet (JSON FORMAT)
     * 
     * @param string $idBet
     */
    public function getResultsOfbet(string $idbet) {
        $this->protectAgainstCheat($idbet);

        $databet = $this->betModel->getbetAndRef($idbet);
        $bet = $databet["bet"]; 
        $questions = $databet["questions"];
        $currentDate = TypeConverter::stringifyDate(new DateTime());

        $this->renderJson(["bet" => $bet, "questions" => $questions, "currentDate" =>$currentDate], HTTP_GOOD_REQ);


    }

    /**
     * (GET) Close bet and distributing points to winners 
     * 
     * @param string $betId
     */
    public function closeBet(string $betId) {
        
        $this->protectAgainstCheat($betId);

        if(!isset($_POST["response"])) {
            $this->redirectWithErrors(BET_REPORT . "/" . $betId,'Erreur lors de la fermeture du pari');
        }
        
        $this->answerModel->setCorrectForSomeAnswers($_POST["response"]);

        $closeDate = TypeConverter::stringifyDate(new DateTime());
    
        $res = $this->betModel->update(["unAvailableAt" => $closeDate], $betId, $this->user->idUser);

        if($res) {
            $this->redirect(BET_LIST_PRIVATE, "Le pari a été correctement clôturé");
        }
        else 
        {
            $this->redirectWithErrors(BET_LIST_PRIVATE, "Le pari n'a pas pu être clôturé");
        }
    }

    /**
     * (POST) Open bet
     * 
     * @param string $betId
     */
    public function openBet(string $betId) {

        $this->protectAgainstCheat($betId);

        $openbetForm = new OpenBetForm($_POST);
        $openbetForm->validate();
       
        $res = $this->betModel->update(
            ["availableAt"=>$_POST["availableAt"], "unAvailableAt" => $_POST["unAvailableAt"]],
            $betId,  
            $this->user->idUser
         );

         if($res) {
             $this->redirect(BET_LIST_PRIVATE, "Le sondage a correctement été ouvert");
         }
         
         $this->redirectWithErrors(BET_LIST_PRIVATE, "Erreur lors de l'ouverture du sondage");


    }

    /**
     * For blocking a lambda user who tries to modify a bet 
     * (redirect on bet list route)
     * 
     * @param string $betId
     */

    private function protectAgainstCheat(string $betId) {
        $bet = $this->betModel->find(["idBet" => $betId, "idOwner"=>$this->user->idUser]);

        if(!$bet) {
            $this->redirectWithErrors(BET_LIST, "Vous n'avez pas l'autoristation de modifier ce sondage");
        }
    }

}