<?php 

namespace App\Controller;

use App\Model\BetModel;
use Core\Controller\Controller;

class BetReportController extends Controller {

    private $pollModel;

    public function __construct()
    {
        $this->pollModel = new BetModel();
    }

    public function getBetReport( string $idBet) {

        var_dump($idBet);

        // $dataPoll = $this->pollModel->getPollAndRef($idBet);
        // $poll = $dataPoll["poll"];  
        // $questions = $dataPoll["questions"];

        // $this->render("poll-report", compact("poll", "questions"));

    }

}