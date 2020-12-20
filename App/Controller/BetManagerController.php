<?php 

namespace App\Controller;

use App\Form\OpenBetForm;
use App\Model\BetModel;
use Core\Controller\Controller;
use Core\Model\Converters\TypeConverter;
use Core\Tools\Session;
use DateTime;

class BetManagerController extends Controller {

    private $betModel;
    private $user;

    public function __construct()
    {
        $this->user = Session::get("user");
        $this->protectPageFor("user", LOGIN);
        $this->betModel = new BetModel();
        
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
     * (GET) Close bet
     * 
     * @param string $betId
     */
    public function closeBet(string $betId) {

        $this->protectAgainstCheat($betId);
        
        $closeDate = TypeConverter::stringifyDate(new DateTime());
        $res = $this->betModel->update(["unAvailableAt" => $closeDate], $betId, $this->user->idUser);

        if($res) {
            $this->redirect(BET_LIST);
        }
        else 
        {
            $this->redirectWithErrors(BET_LIST, "Le sondage n'a pas pu être clôturé");
        }
    }

    /**
     * (POST) Open bet
     * 
     * @param string $betId
     */
    public function openbet(string $betId) {

        $this->protectAgainstCheat($betId);

        $openbetForm = new OpenBetForm($_POST);
        $openbetForm->validate();
       
        $res = $this->betModel->update(
            ["availableAt"=>$_POST["availableAt"], "unAvailableAt" => $_POST["unAvailableAt"]],
            $betId,  
            $this->user->idUser
         );

         if($res) {
             $this->redirect(BET_LIST);
         }
         
         $this->redirectWithErrors(BET_LIST, "Erreur lors de l'ouverture du sondage");


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
            $this->redirect(BET_LIST);
        }
    }

}