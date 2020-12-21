<?php

namespace App\Model;

use Core\Model\Model;

class UserModel extends Model{

    const TABLE_NAME = "users";

    public function __construct(){
        parent::__construct(self::TABLE_NAME);
    }

    /**
     * For checking uniqueness according some filters 
     * 
     * @param array $filters (("column name"=> "value which has to be unique") )
     * 
     * @return bool
     */
    public function checkUnique (array $filters) : bool {
        $user = $this->_find($filters, ["*"], [], [], false, "OR");
        return $user ? false : true;
    }

    /**
     * For finding one user 
     * 
     * @param array $filters (["column name" => "value"])
     * @param array $wantedValues 
     * 
     * @return StdClass | null
     * 
     */
    public function findOne(array $filters, array $wantedValues=["*"]){
        $user = $this->_find($filters, $wantedValues);
        return $user ? $user[0] : null;
    }

    /**
     * For saving user in database 
     * 
     * @param string $pseudo 
     * @param string $email
     * @param string $password 
     * @param string $firstName
     * @param string $lastName
     * @param int $points 
     * 
     * @return int (last inserted id)
     */
    public function save(string $pseudo, string $email, string $password, string $firstName, string $lastName, int $points){
        return $this->_insert(["username", "email", "password", "firstName", "lastName", "points"],func_get_args());
    }

    /**
     * For updating user points 
     * 
     * @param int $newPointsQuantity
     * @param string $idUser 
     * 
     * @return int (number of updated rows)
     */
    public function updateUserPoints(int $newPointsQuantity, string $idUser) {
        return $this->_update(["points" => $newPointsQuantity], ["idUser" => $idUser]);
    }

    
    public function update(array $data, array $filters){
        return $this->_update($data, $filters);
    }



}