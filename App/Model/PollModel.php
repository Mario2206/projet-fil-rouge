<?php

namespace App\Model;

use Core\Model\Converters\ArrayMapper;
use Core\Model\Model;
use DateTime;

class PollModel extends Model {
        
        const TABLE_NAME = "poll";

        const KEYS = ["pollName", "description", "createdAt", "idUser", "availableAt", "unAvailableAt"];

        public function __construct()
        {
            parent::__construct(self::TABLE_NAME);
        }

        /**
         * For inserting many rows to Database
         * 
         * @param array $pollDataGroup
         * 
         * @return int (last inserted id)
         */
        public function insert(
                string $pollName, 
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
         * For getting all poll created by user's friends and which are available
         * 
         * @param string $userId
         * 
         * @return array
         */
        public function findPollFromFriends (string $userId) {
            
            $req = $this->_db->prepare("
            SELECT poll.idPoll, poll.availableAt, poll.unAvailableAt, poll.createdAt, poll.description, poll.pollName, users.username 
            FROM poll 
            INNER JOIN friends ON friends.idFriend = poll.idUser 
            INNER JOIN users ON friends.idFriend = users.idUser
            WHERE friends.idUser = ? AND poll.availableAt < NOW() AND poll.unAvailableAt > NOW()
            ");

            $req->execute([$userId]);

            $polls = $req->fetchAll();

            return $polls;
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