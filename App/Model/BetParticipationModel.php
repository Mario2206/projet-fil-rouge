<?php 

namespace App\Model;

use Core\Model\Model;

class BetParticipationModel extends Model
{
    const TABLE_NAME = "bet_participation";

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    /**
     * For persisting a participation to database 
     * 
     * @param string $idUser 
     * @param string $idBet 
     * 
     * @return int (last inserted id)
     */
    public function setParticipation(string $idUser, string $idBet, int $payment) {
        return $this->_insert(["idUser", "idBet", "payment", "pass"], [$idUser, $idBet, $payment, 0]);
    }
    
    /**
     * For finding a bet participation from database 
     * 
     * @param string $idUser 
     * @param string $idBet 
     * 
     * @return array
     */
    public function findParticipation(string $idUser, string $idBet) {
        return $this->_find(["idUser" => $idUser, "idBet" => $idBet]);
    }

    /**
     * For getting only bet participation which are over 
     * 
     * @param string $idUSer 
     * 
     * @return array
     */
    public function getResults(string $idUser) {
        $tableName = self::TABLE_NAME;

        $query = "
            SELECT $tableName.idParticipation, bets.betName, bets.idBet FROM $tableName
            INNER JOIN bets ON $tableName.idBet = bets.idBet 
            WHERE bets.unAvailableAt <= NOW() AND $tableName.idUser = ? AND $tableName.pass = 0
        ";

        $req = $this->_db->prepare($query);
        $req->execute([$idUser]);

        return $req->fetchAll();
    }

    /**
     * For getting only bet participation which are over 
     * 
     * @param string $idUSer 
     * 
     * @return StdClass
     */
    public function getOneResult(string $idParticipation, string $idUser) {
        $tableName = self::TABLE_NAME;

        $query = "
            SELECT * FROM $tableName
            INNER JOIN bets ON $tableName.idBet = bets.idBet 
            WHERE bets.unAvailableAt <= NOW() AND $tableName.idUser = ? AND $tableName.pass = 0 AND $tableName.idParticipation = ?
        ";

        $req = $this->_db->prepare($query);
        $req->execute([$idUser, $idParticipation]);

        return $req->fetch();
    }

    public function closeParticipation(string $idParticipation) {
        return $this->_update(["pass" => 1], ["idParticipation" => $idParticipation]);
    }

}