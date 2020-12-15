<?php 

namespace App\Controller;

use App\Form\OpenPollForm;
use App\Model\PollModel;
use Core\Controller\Controller;
use Core\Model\Converters\TypeConverter;
use Core\Tools\Session;
use DateTime;

class PollManagerController extends Controller {

    private $pollModel;
    private $user;

    public function __construct()
    {
        $this->user = Session::get("user");
        $this->protectPageFor("user", "/login");
        $this->pollModel = new PollModel();
        
    }

    /**
     * GET : display poll report page
     * 
     * @param string $idPoll
     */

    public function getPollReport( string $idPoll) {

        $this->protectAgainstCheat($idPoll);

        $poll = $this->pollModel->find(["idPoll"=>$idPoll]);
        $currentDate = TypeConverter::stringifyDate(new DateTime());
        
        $this->render("poll-report", ["poll" => $poll[0], "currentDate" => $currentDate]);

    }

    public function getResultsOfPoll(string $idPoll) {
        $this->protectAgainstCheat($idPoll);

        $dataPoll = $this->pollModel->getPollAndRef($idPoll);
        $poll = $dataPoll["poll"]; 
        $questions = $dataPoll["questions"];
        $currentDate = TypeConverter::stringifyDate(new DateTime());

        $this->renderJson(["poll" => $poll, "questions" => $questions, "currentDate" =>$currentDate], HTTP_GOOD_REQ);


    }

    /**
     * GET : Close poll
     * 
     * @param string $pollId
     */
    public function closePoll(string $pollId) {

        $this->protectAgainstCheat($pollId);
        
        $closeDate = TypeConverter::stringifyDate(new DateTime());
        $res = $this->pollModel->update(["unAvailableAt" => $closeDate], $pollId, $this->user->idUser);

        if($res) {
            $this->redirect(POLL_LIST);
        }
        else 
        {
            $this->redirectWithErrors(POLL_LIST, "Le sondage n'a pas pu être clôturé");
        }
    }

    /**
     * POST : Open poll
     * 
     * @param string $pollId
     */
    public function openPoll(string $pollId) {

        $this->protectAgainstCheat($pollId);

        $openPollForm = new OpenPollForm($_POST);
        $openPollForm->validate();
       
        $res = $this->pollModel->update(
            ["availableAt"=>$_POST["availableAt"], "unAvailableAt" => $_POST["unAvailableAt"]],
            $pollId,  
            $this->user->idUser
         );

         if($res) {
             $this->redirect(POLL_LIST);
         }
         
         $this->redirectWithErrors(POLL_LIST, "Erreur lors de l'ouverture du sondage");


    }

    /**
     * For blocking a lambda user who tries to modify a poll which isn't his
     * (redirect on poll list route)
     * 
     * @param string $pollId
     */

    private function protectAgainstCheat(string $pollId) {
        $poll = $this->pollModel->find(["idPoll" => $pollId, "idUser"=>$this->user->idUser]);

        if(!$poll) {
            $this->redirect(POLL_LIST);
        }
    }

}