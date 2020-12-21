<?php

namespace App\Model;

use Core\Model\Converters\ArrayMapper;
use Core\Model\Model;
use DateTime;

class BetModel extends Model {
        
        const TABLE_NAME = "bets";

        const KEYS = ["betName", "description", "createdAt", "idOwner", "availableAt", "unAvailableAt", "betCategory"];

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
                string $unvailableAt, 
                string $betCategory
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
         * @param bool $onlyAvailable
         * 
         * @return array
         */
        public function findBetsFromCategory (string $categoryCode, string $userId = "", bool $onlyPublicBet = true) {
            $tableName = self::TABLE_NAME;
            $query = "
            SELECT $tableName.idBet, $tableName.betName, $tableName.description, $tableName.createdAt, $tableName.availableAt, $tableName.unAvailableAt, users.username
            FROM $tableName 
            INNER JOIN bet_categories ON bet_categories.id = $tableName.betCategory
            INNER JOIN users ON users.idUser = $tableName.idOwner
            WHERE bet_categories.code= ?  " . ($onlyPublicBet ? "AND $tableName.availableAt < NOW() AND $tableName.unAvailableAt > NOW() AND $tableName.idOwner <> ?" : "" ). ( $onlyPublicBet ? "" : " AND $tableName.idOwner = ?");

        
            $req = $this->_db->prepare($query);
         
            $params =  [$categoryCode, $userId];

            $req->execute($params);

            return $req->fetchAll();
        }

        /**
         * 
         * For getting the bet with its questions and answers
         * 
         * @param string $betId 
         * 
         * @return array
         * 
         */
        public function getBetAndRef(string $betId) : array {

            $bet = $this->_find(["idBet" => $betId]);

            $req = $this->_db->prepare("
            SELECT questions.question, questions.idQuestion, answers.answer, answers.answerId, COUNT(`user_answers`.idAnswer) AS nVoter FROM questions 
            INNER JOIN answers ON questions.idQuestion = answers.questionId 
            LEFT JOIN `user_answers` ON `user_answers`.idAnswer = answers.answerId
            WHERE idBet = :id_bet 
            GROUP BY answers.answerId
            ");
            
            $req->execute(["id_bet"=>$betId]);
            $questions = $req->fetchAll();
            
            $formatedQuestions = ArrayMapper::groupByPropertyOfSubObject("question", ["answer", "idQuestion" , "nVoter", "answerId"], $questions);

            return [
                "bet" => $bet[0], 
                "questions" =>  $formatedQuestions
            ];
        }

        public function update(array $data, string $betId, string $userId) : int {
            return $this->_update($data, ["idbet" => $betId, "idOwner" => $userId]);
        }
        

    }