<?php

namespace Core\Database;

use PDO;

class Database {


    /**
     * Database connection
     */
    public static function connect () {
        $pdo =  new PDO("mysql:dbname=".DB_NAME.";host=" . DB_HOST, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        // $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    }
}