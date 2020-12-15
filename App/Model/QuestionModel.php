<?php
namespace App\Model;

use Core\Model\Converters\ArrayMapper;
use Core\Model\Model;

class QuestionModel extends Model {

    const TABLE_NAME = "questions";
    const KEYS = ["idPoll","question", "questionOrder"];

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    public function isExist($filters) {
        $req = $this->_find($filters, ["COUNT(*) AS response"]);

        return $req[0]->response ? true : false;
    }

    public function insert(string $idPoll, string $questionValue, int $questionOrder) {
        return $this->_insert(self::KEYS, func_get_args());
    }

    /**
     * For finding question with its answers
     * 
     * @param $idPoll
     * @param $questionOrder
     * 
     * @return array
     */
    public function findQuestionWithAnswers($idPoll, $questionOrder) {

        $req = $this->_db->prepare("SELECT * FROM questions INNER JOIN answers ON answers.questionId = questions.idQuestion WHERE questions.idPoll = :idPoll AND questions.questionOrder = :questionOrder");

        $req->execute(["idPoll" => $idPoll, "questionOrder" => $questionOrder]);

        $question = $req->fetchAll();

        $formatedQuestions = ArrayMapper::groupByPropertyOfSubObject("question", ["answer", "answerId", "idQuestion"],  $question);
        
        return $formatedQuestions ;
    }



}