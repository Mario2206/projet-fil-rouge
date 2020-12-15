<?php

namespace App\Model;

use Core\Model\Model;

class UserModel extends Model{

    const TABLE_NAME = "users";

    public function __construct(){
        parent::__construct(self::TABLE_NAME);
    }

    public function checkUnique (array $filters) : bool {
        $user = $this->_find($filters, ["*"], [], [], false, "OR");
        return $user ? false : true;
    }

    public function findOne(array $filters, array $wantedValues=["*"]){
        $user = $this->_find($filters, $wantedValues);
        return $user ? $user[0] : [];
    }

    public function save(string $pseudo, string $email, string $password, string $firstName, string $lastName){
        return $this->_insert(["username", "email", "password", "firstName", "lastName"],[$pseudo, $email, $password, $firstName, $lastName]);
    }

    public function update(array $data, array $filters){
        return $this->_update($data, $filters);
    }



}