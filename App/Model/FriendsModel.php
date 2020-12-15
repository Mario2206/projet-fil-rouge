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

    public function getFriends(string $userId){

        $req = $this->_db->prepare('SELECT users.username, friends.accepted, friends.idFriend FROM `friends` INNER JOIN users WHERE friends.idFriend = users.idUser AND friends.idUser = :id_user');
        $req->execute(["id_user" => $userId]);
        $friends = $req->fetchAll();

        return $friends;
    }

    public function findFriendId(string $friendUsername){

        $req = $this->_db->prepare('SELECT idUser FROM users WHERE username = :friend_username');
        $req->execute(["friend_username" => $friendUsername]);
        $friendId = $req->fetchAll();

        
        return $friendId;
    }

    public function friendsYet(string $userId, string $friendId){

        $req = $this->_db->prepare('SELECT idFriend FROM friends WHERE idUser = :id_user AND idFriend = :id_friend');
        $req->execute(["id_user" => $userId, "id_friend" => $friendId]);
        
        $friend = $req->fetchAll();

        return count($friend) > 0;
    }

    public function addFriend(string $userId, string $friendId){
        return $this->_insertMany(["idUser", "idFriend", "accepted"],[[$userId, $friendId, 1],[$friendId, $userId, 0]]);

    }

    public function rejectFriend(string $userId, string $friendId){

        return [
            $this->_delete("friends", ["idFriend" => $friendId, "idUser" => $userId]),
            $this->_delete("friends", ["idFriend" => $userId, "idUser" => $friendId])
        ];


    }

    public function acceptFriend(string $userId, string $friendId){

        $this->_update(["accepted" => 1], ["idUser" => $userId, "idFriend" => $friendId]);

    }

}