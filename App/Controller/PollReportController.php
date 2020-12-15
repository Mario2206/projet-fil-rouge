<?php 

namespace App\Controller;

use App\Model\PollModel;
use Core\Controller\Controller;

class PollReportController extends Controller {

    private $pollModel;

    public function __construct()
    {
        $this->pollModel = new PollModel();
    }

    public function getPollReport( string $idPoll) {

        $dataPoll = $this->pollModel->getPollAndRef($idPoll);
        $poll = $dataPoll["poll"];  
        $questions = $dataPoll["questions"];

        $this->render("poll-report", compact("poll", "questions"));

    }

}