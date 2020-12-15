<?php

namespace App\Controller;

use App\Form\PollForm;
use App\Model\AnswerModel;
use App\Model\PollModel;
use App\Model\QuestionModel;
use Core\Controller\Controller;
use Core\Model\Converters\TypeConverter;
use Core\Tools\Cleaner;
use Core\Tools\Session;
use DateTime;

class CreatePollController extends Controller {

    private $user;

    public function __construct()
    {
        $this->user = Session::get("user");
        $this->protectPageFor("user", "/login");
    }
    
    public function createPollPage () {
        $this->render("createPollView");
    }

    public function confirmCreatePollPage () {
        $this->render("confirmView", ["message" => "Le sondage a correctement été crée !"]);
    }

    public function createPoll() {
        
      
        $pollForm = new PollForm($_POST);

        $pollForm->validate();

        if($pollForm->getErrors()) {
            $this->redirectWithErrors(POLL_CREATION, "Erreur lors de la création du sondage, certains champs ne sont pas correctement complétés" );
        }

        $date = TypeConverter::stringifyDate(new DateTime());
        $pollName = Cleaner::cleanHtml($_POST["poll_name"]);
        $pollDescription = Cleaner::cleanHtml($_POST['poll_description']);
        $pollAvailableDate =  $_POST["poll_available"];
        $pollUnAvailableDate = $_POST["poll_unavailable"];

        
        $pollQuestions = Cleaner::cleanArray( $_POST["poll_questions"]);
        $pollResponses = Cleaner::cleanArray( array_values($_POST["poll_responses"]));

    
        $pollModel = new PollModel();
        $pollId = $pollModel->insert($pollName, $pollDescription, $date, $this->user->idUser, $pollAvailableDate, $pollUnAvailableDate);

        if($pollId) {

            $questionModel = new QuestionModel();
            $answerModel = new AnswerModel();

            foreach($pollQuestions as $k=>$question) {

                $qId = $questionModel->insert($pollId, htmlspecialchars( $question ), $k);

                if($qId) {
                    
                    
                  $answerModel->insertMany($pollResponses[$k],$qId);

                }
                else 
                {
                    throw new \Exception("The question hasn't been created"); 
                }
                
            }
            $this->redirect(\POLL_CREATED);
        } 
        else {
            throw new \Exception("The poll hasn't been created");
        }

    }

}