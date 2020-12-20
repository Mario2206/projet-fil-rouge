<?php

namespace App\Controller;


use App\Form\CreateBetForm;
use App\Model\AnswerModel;
use App\Model\BetModel;
use App\Model\CategoryModel;
use App\Model\QuestionModel;
use Core\Controller\Controller;
use Core\Model\Converters\TypeConverter;
use Core\Tools\Cleaner;
use Core\Tools\Session;
use DateTime;

class CreateBetController extends Controller {

    private $user;
    private $categoryModel;
    private $betModel;
    private $questionModel;
    private $answerModel;


    public function __construct()
    {
        $this->user = Session::get("user");
        $this->categoryModel = new CategoryModel();
        $this->betModel = new BetModel();
        $this->questionModel = new QuestionModel();
        $this->answerModel = new AnswerModel();

        $this->protectPageFor("user", LOGIN);
    }
    
    /**
     * (GET) For displaying the create bet page
     */
    public function createBetPage () {
        $categories = $this->categoryModel->getAllCategories();
        $this->render("createBetView", compact("categories"));
    }

    /**
     * (POST) For creating bet 
     */
    public function createBet() {
      
        $betForm = new CreateBetForm($_POST);

        $betForm->validate();

        if($betForm->getErrors()) {
            $this->redirectWithErrors(BET_CREATION, "Erreur lors de la création du sondage, certains champs ne sont pas correctement complétés" );
        }

        $date = TypeConverter::stringifyDate(new DateTime());
        $betName = Cleaner::cleanHtml($_POST["bet_name"]);
        $betDescription = Cleaner::cleanHtml($_POST['bet_description']);
        $betAvailableDate =  $_POST["bet_available"];
        $betUnAvailableDate = $_POST["bet_unavailable"];
        $betCategory = $_POST["bet_category"];

        $betQuestions = Cleaner::cleanArray( $_POST["bet_questions"] );
        $betResponses = Cleaner::cleanArray( array_values($_POST["bet_responses"]));


        $betId = $this->betModel->insert($betName, $betDescription, $date, $this->user->idUser, $betAvailableDate, $betUnAvailableDate, $betCategory);

        if($betId) {

            foreach($betQuestions as $k=>$question) {

                $qId = $this->questionModel->insert($betId, htmlspecialchars( $question ), $k);

                if($qId) {
                    
                  $this->answerModel->insertMany($betResponses[$k],$qId);

                }
                else 
                {
                    throw new \Exception("The question hasn't been created"); 
                }
                
            }
            $this->redirect(\BET_LIST_PRIVATE, "Le pari a correctement été créé");
        } 
        else {
            throw new \Exception("The bet hasn't been created");
        }

    }

}