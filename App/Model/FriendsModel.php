<?php

namespace App\Model;

use Core\Model\Converters\ArrayMapper;
use Core\Model\Model;
use PDO;

class FriendsModel extends Model{

    const TABLE_NAME = "friends";

    const KEYS = ["idUser", "idFriend"];
    



    public function __construct(){
        parent::__construct(self::TABLE_NAME);
    }

    public function find (array $filters = [], array $wantedValue = ["*"], array $limit = [], array $order = []) {
        return $this->_find($filters, $wantedValue, $limit, $order);
    }

    public function getOneFriend(string $userId, string $friendId = "") {
        $friends = $this->getFriends($userId, $friendId);
        return $friends ? $friends[0] : null; 
    }

    public function getFriends(string $userId, string $friendId = ""){

        $req = $this->_db->prepare('
        SELECT users.username, friends.idFriend, friends.idUser AS idFriend FROM `friends`
        INNER JOIN users ON users.idUser = friends.idUser 
        WHERE friends.idFriend = ?
        ' . ($friendId ? " AND friends.idUser = ?" : "")
        );
        $req->execute($friendId ? [$userId, $friendId] : [$userId]);
        return $req->fetchAll();
    }

    public function alreadyFriend(string $userId, string $friendId){
        
        $friend = $this->_find(["idUser"=>$userId, "idFriend" => $friendId]);

        return count($friend) > 0;
    }

    public function addFriend(string $userId, string $friendId){
        return $this->_insertMany(["idUser", "idFriend"],[[$userId, $friendId],[$friendId, $userId]]);

    }

    public function deleteFriend(string $userId, string $friendId){

        return [
            $this->_delete("friends", ["idFriend" => $friendId, "idUser" => $userId]),
            $this->_delete("friends", ["idFriend" => $userId, "idUser" => $friendId])
        ];


    }

}