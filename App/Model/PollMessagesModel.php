<?php

namespace App\Model;

use Core\Model\Converters\TypeConverter;
use Core\Model\Model;
use DateTime;

class PollMessagesModel extends Model {

    const TABLE_NAME = "tchatmessages";

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }


    public function insert(string $message, string $userId, string $pollId) {
        $date = TypeConverter::stringifyDate( new DateTime() );
        $this->_insert(["message", "idUser", "idPoll", "createdAt"], [$message, $userId, $pollId, $date]);
    }

    public function findAllMessages(string $pollId) {
        $tableName = self::TABLE_NAME;

        $req = $this->_db->prepare("SELECT $tableName.message, $tableName.createdAt, users.username FROM $tableName INNER JOIN users ON users.idUser = $tableName.idUser WHERE $tableName.idPoll = ? ORDER BY $tableName.createdAt ");

        $req->execute([$pollId]);

        return $req->fetchAll();

    } 

}