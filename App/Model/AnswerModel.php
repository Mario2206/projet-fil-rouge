<?php

namespace App\Model;

use Core\Model\Model;

class AnswerModel extends Model {

    const TABLE_NAME = "answers";

    const KEYS = ["answer", "questionId"];

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
            return [$item, $questionId];
        }, $answers);

        return $this->_insertMany(self::KEYS, $data);
    }

}