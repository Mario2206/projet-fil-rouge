<?php 

namespace App\Controller;

use App\Model\BetParticipationModel;
use App\Model\UserAnswersModel;
use App\Model\UserModel;
use Core\Controller\Controller;
use Core\Tools\Session;

class BetResultController extends Controller {

    private $user;
    private $participationModel;
    private $userAnswerModel;
    private $userModel;

    public function __construct()
    {
        $this->user = Session::get("user");
        $this->participationModel = new BetParticipationModel();
        $this->userAnswerModel = new UserAnswersModel();
        $this->userModel = new UserModel();
    }

    /**
     * (GET) For getting all bet results
     * 
     *
     */
    public function getResults() {
        $results = $this->participationModel->getResults($this->user->idUser);
        $this->render("betResultsView", compact("results"));
    }

    /**
     * (GET) For getting one specific result
     * 
     * @param string $idParticipation
     */
    public function getResult(string $idParticipation) {

        $result = $this->participationModel->getOneResult($idParticipation, $this->user->idUser);

        if(!$result) {
            $this->redirectWithErrors(BET_RESULTS, "Résultat introuvable");
        }

        $answers = $this->userAnswerModel->getUserAnswerFromSpecificBet($result->idBet, $this->user->idUser);

        $incorrectAnswer = array_filter($answers, function ($answer) {
            return !$answer->isCorrect;
        });

        $points = $incorrectAnswer ? -$result->payment : $result->payment * 2;

        $this->userModel->updateUserPoints($this->user->points + $points, $this->user->idUser);

        $this->participationModel->closeParticipation($idParticipation);

        $updatedUser = $this->userModel->findOne(["idUser" => $this->user->idUser]);
        
        Session::set("user",$updatedUser);

        if($incorrectAnswer) {
            $this->redirectWithErrors(BET_RESULTS, "Vous avez perdu : " . $points . " points");
        }

        $this->redirect(BET_RESULTS, "Vous avez gagné : " . $points . " points");
    }


}