<?php

namespace App\Model;

use Core\Model\Converters\ArrayMapper;
use Core\Model\Model;

class CategoryModel extends Model {

    const TABLE_NAME = "bet_categories";

    public function __construct()
    {
        parent::__construct(self::TABLE_NAME);
    }

    /**
     * For finding a category by code
     * 
     * @param string $code 
     * 
     * 
     */
    public function findByCode(string $code) 
    {
        $res = $this->_find(["code"=>$code]);
        return $res ? $res[0] : null;
    }

    public function getAllCategories() {
        return $this->_find();
    }

    public function getOnlyPrivateCategories(string $userId) {
        $tableName = self::TABLE_NAME;
        $req = $this->_db->prepare("
            SELECT $tableName.name, $tableName.miniature, $tableName.code FROM $tableName
            LEFT JOIN bets ON $tableName.id = bets.betCategory
            WHERE bets.idOwner = ?
        ");
        $req->execute([$userId]);
        $categories = $req->fetchAll();
        return ArrayMapper::mergeSubObjectItemByProperty($categories, "name");
    }
}