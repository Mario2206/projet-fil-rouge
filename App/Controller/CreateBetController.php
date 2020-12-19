<?php

namespace App\Controller;

use App\Form\BetForm;
use App\Model\AnswerModel;
use App\Model\BetModel;
use App\Model\CategoryModel;
use App\Model\betModel;
use App\Model\QuestionModel;
use Core\Controller\Controller;
use Core\Model\Converters\TypeConverter;
use Core\Tools\Cleaner;
use Core\Tools\Session;
use DateTime;

class CreateBetController extends Controller {

    private $user;
    private $categoryModel;


    public function __construct()
    {
        $this->user = Session::get("user");
        $this->categoryModel = new CategoryModel();
        $this->protectPageFor("user", "/login");
    }
    
    public function createBetPage () {
        $categories = $this->categoryModel->getAllCategories();
        $this->render("createBetView", compact("categories"));
    }

    public function confirmCreatebetPage () {
        $this->render("confirmView", ["message" => "Le sondage a correctement été crée !"]);
    }

    public function createBet() {
        
      
        $betForm = new BetForm($_POST);

        $betForm->validate();

        if($betForm->getErrors()) {
            $this->redirectWithErrors(BET_CREATION, "Erreur lors de la création du sondage, certains champs ne sont pas correctement complétés" );
        }

        $date = TypeConverter::stringifyDate(new DateTime());
        $betName = Cleaner::cleanHtml($_POST["bet_name"]);
        $betDescription = Cleaner::cleanHtml($_POST['bet_description']);
        $betAvailableDate =  $_POST["bet_available"];
        $betUnAvailableDate = $_POST["bet_unavailable"];

        
        $betQuestions = Cleaner::cleanArray( $_POST["bet_questions"]);
        $betResponses = Cleaner::cleanArray( array_values($_POST["bet_responses"]));

    
        $betModel = new BetModel();
        $betId = $betModel->insert($betName, $betDescription, $date, $this->user->idUser, $betAvailableDate, $betUnAvailableDate);

        if($betId) {

            $questionModel = new QuestionModel();
            $answerModel = new AnswerModel();

            foreach($betQuestions as $k=>$question) {

                $qId = $questionModel->insert($betId, htmlspecialchars( $question ), $k);

                if($qId) {
                    
                    
                  $answerModel->insertMany($betResponses[$k],$qId);

                }
                else 
                {
                    throw new \Exception("The question hasn't been created"); 
                }
                
            }
            $this->redirect(\BET_CREATED);
        } 
        else {
            throw new \Exception("The bet hasn't been created");
        }

    }

}