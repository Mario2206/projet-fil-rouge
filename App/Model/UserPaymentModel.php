<?php

namespace App\Model;

use Core\Model\Model;

class UserPaymentModel extends Model {

    const TABLE_NAME = "user_payment";

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    public function save(string $idUser, string $idBet, int $payment) {
        return $this->_insert(["idUser", "idBet", "payment"], [$idUser, $idBet, $payment]);
    }

}