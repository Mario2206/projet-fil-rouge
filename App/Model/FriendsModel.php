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

    /**
     * For getting one friend 
     * 
     * @param string $userId 
     * @param string $friendId
     * 
     * @return Stdclass | null
     */
    public function getOneFriend(string $userId, string $friendId = "") {
        $friends = $this->getFriends($userId, $friendId);
        return $friends ? $friends[0] : null; 
    }

    /**
     * For getting some friends
     * 
     * @param string $userId 
     * @param string $friendId (optional)
     * 
     * @return array
     * 
     */
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

    /**
     * For checking if two users are already friend
     * 
     * @param string $userId 
     * @param string $friendId
     * 
     * @return bool
     */
    public function alreadyFriend(string $userId, string $friendId){
        
        $friend = $this->_find(["idUser"=>$userId, "idFriend" => $friendId]);

        return count($friend) > 0;
    }

    /**
     * For adding a friend relation
     * 
     * @param string $userId 
     * @param string $friendId 
     * 
     * @return int last inserted id
     */
    public function addFriend(string $userId, string $friendId){
        return $this->_insertMany(["idUser", "idFriend"],[[$userId, $friendId],[$friendId, $userId]]);
    }

    /**
     * For removing a friend relation 
     * 
     * @param string $userId 
     * @param string $friendId 
     * 
     * @return array
     */
    public function deleteFriend(string $userId, string $friendId){

        return [
            $this->_delete("friends", ["idFriend" => $friendId, "idUser" => $userId]),
            $this->_delete("friends", ["idFriend" => $userId, "idUser" => $friendId])
        ];


    }

}