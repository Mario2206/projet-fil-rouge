<?php

namespace App\Model;

use Core\Model\Converters\TypeConverter;
use Core\Model\Model;
use DateTime;

class MessagesModel extends Model {

    const TABLE_NAME = "tchatmessages";

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    /**
     * For saving one message in database 
     * 
     * @param string $message
     * @param string $userId 
     * @param string $idFriend
     * 
     * @return int (last id inserted)
     */
    public function saveMessage(string $message, string $userId, string $idFriend) {
        $date = TypeConverter::stringifyDate( new DateTime() );
        $this->_insert(["message", "idUser", "idFriend", "createdAt"], [$message, $userId, $idFriend, $date]);
    }

    /**
     * For finding all messages between the current user (represented by the user id) and his friend (represented by the friend id)
     * 
     * @param string $idUser 
     * @param string $idFriend  
     * 
     * @return array
     */
    public function findAllMessages(string $idUser, string $idFriend) {
        $tableName = self::TABLE_NAME;

        $req = $this->_db->prepare("
        SELECT $tableName.message, $tableName.createdAt, users.username FROM $tableName 
        INNER JOIN users ON users.idUser = $tableName.idUser 
        WHERE $tableName.idFriend = ? AND $tableName.idUser = ? OR $tableName.idFriend = ? AND $tableName.idUSer = ?
        ORDER BY $tableName.createdAt 
        ");

        $req->execute([$idFriend, $idUser, $idUser, $idFriend]);

        return $req->fetchAll();

    } 

}