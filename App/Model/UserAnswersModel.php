<?php

namespace App\Model;

use Core\Model\Model;

class UserAnswersModel extends Model {


    const TABLE_NAME = "user-answers";


    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }


    /**
     * For checking if the current user has alreddy given a response for a question
     * 
     * @param string $pollId
     * @param int $questionOrder
     * @param string $userId
     * 
     * @return bool
     */

    public function alreadyAnswered ( $pollId,  $questionOrder ,  $userId) {
        $tableName  = self::TABLE_NAME;

        $req = $this->_db->prepare("SELECT COUNT(*) as answerFound FROM `$tableName` INNER JOIN questions ON questions.idQuestion = `$tableName`. idQuestion  WHERE `$tableName`.idUser = ? AND questions.questionOrder = ? AND questions.idPoll = ?" );

        $req->execute([$userId, $questionOrder, $pollId]);

        $res = $req->fetch();
        
        return $res->answerFound > 0 ;
    }

    /**
     * For saving user answer in user answers table
     */
    public function saveUserAnswer($answerId, $userId, $questionId) {
       return  $this->_insert(["idAnswer", "idUser", "idQuestion"], [$answerId, $userId, $questionId]);
    }
}