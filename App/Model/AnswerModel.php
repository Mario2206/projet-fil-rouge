<?php

namespace App\Model;

use Core\Model\Model;

class AnswerModel extends Model {

    const TABLE_NAME = "answers";

    const KEYS = ["answer", "questionId", "isCorrect"];

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    /**
     * For inserting many answers in answers table 
     * 
     * @param array $answers
     * @param string $questionId
     * 
     * @return int (last inserted id)
     */
    public function insertMany (array $answers, string $questionId) {
        $data = array_map(function ($item) use ($questionId) {
            return [$item, $questionId, 0];
        }, $answers);

        
        return $this->_insertMany(self::KEYS,  $data );
    }

    /**
     * For setting "isCorrect" to true for some answers 
     * 
     * @param array 
     */
    public function setCorrectForSomeAnswers(array $anwsersId) {
        $tablename = self::TABLE_NAME;
        $filter = array_map(function ($answer) {
            return "answerId = ?";
        }, $anwsersId);
        
        $query = "UPDATE $tablename SET isCorrect = 1 WHERE " . implode(" OR ", $filter );
       
        $req = $this->_db->prepare($query);
        return $req->execute(array_values($anwsersId));
    }

}