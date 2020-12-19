<?php

namespace App\Model;

use Core\Model\Converters\ArrayMapper;
use Core\Model\Model;
use DateTime;

class BetModel extends Model {
        
        const TABLE_NAME = "bets";

        const KEYS = ["betName", "description", "createdAt", "idUser", "availableAt", "unAvailableAt"];

        public function __construct()
        {
            parent::__construct(self::TABLE_NAME);
        }

        /**
         * For inserting many rows to Database
         * 
         * @param array $betDataGroup
         * 
         * @return int (last inserted id)
         */
        public function insert(
                string $betName, 
                string $description, 
                string $createdAt, 
                string $user_id,
                string $availableAt,
                string $unvailableAt
        ) {
           return $this->_insert(self::KEYS, func_get_args());
        }

        /**
         * For getting row(s) from Database
         * 
         * @param array $filters
         * @param array $wantedValues (default : ["*"])
         * @param array $limit [start, offset]
         * @param array $order ["by"=> columnName, "desc"=>bool]
         */
        public function find (array $filters = [], array $wantedValue = ["*"], array $limit = [], array $order = []) {
            return $this->_find($filters, $wantedValue, $limit, $order);
        }

        /**
         * For getting all bets created from a category
         * 
         * @param string $categoryCode
         * @param string $userId (optional)
         * 
         * @return array
         */
        public function findBetsFromCategory (string $categoryCode, string $userId = "") {
            $tableName = self::TABLE_NAME;
            $req = $this->_db->prepare("
            SELECT $tableName.idBet, $tableName.betName, $tableName.description, $tableName.createdAt, $tableName.availableAt, $tableName.unAvailableAt, users.username
            FROM $tableName 
            INNER JOIN bet_categories ON bet_categories.id = $tableName.betCategory
            INNER JOIN users ON users.idUser = $tableName.idOwner
            WHERE bet_categories.code= ? AND $tableName.availableAt < NOW() AND $tableName.unAvailableAt > NOW()" . ( $userId ? " AND $tableName.idOwner = ?" : "")
            );

            $params = $userId ? [$categoryCode, $userId] : [ $categoryCode ];

            $req->execute($params);

            return $req->fetchAll();
        }

        /**
         * 
         * For getting the poll with its questions and answers
         * 
         * @param string $pollId 
         * 
         * @return array
         * 
         */
        public function getPollAndRef(string $pollId) : array {

            $poll = $this->_find(["idPoll" => $pollId]);

            $req = $this->_db->prepare("
            SELECT questions.question, questions.idQuestion, answers.answer, COUNT(`user-answers`.idAnswer) AS nVoter FROM questions 
            INNER JOIN answers ON questions.idQuestion = answers.questionId 
            LEFT JOIN `user-answers` ON `user-answers`.idAnswer = answers.answerId
            WHERE idPoll = :id_poll 
            GROUP BY answers.answerId
            ");
            
            $req->execute(["id_poll"=>$pollId]);
            $questions = $req->fetchAll();
            
            $formatedQuestions = ArrayMapper::groupByPropertyOfSubObject("question", ["answer", "idQuestion" , "nVoter"], $questions);

            return [
                "poll" => $poll[0], 
                "questions" =>  $formatedQuestions
            ];
        }

        public function update(array $data, string $pollId, string $userId) : int {
            return $this->_update($data, ["idPoll" => $pollId, "idUser" => $userId]);
        }
        

    }