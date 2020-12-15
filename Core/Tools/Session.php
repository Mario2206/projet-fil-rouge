<?php 

namespace Core\Tools;

class Session  {


    public static function set ($key, $data) {
        $_SESSION[$key] = $data;
    }

    public static function get(string $key) {
        return isset($_SESSION[$key]) ?  $_SESSION[$key] : null;
    }

    public static function clean (string $key) {
        unset($_SESSION[$key]);
    }

    public static function setError(string $error) {
        self::set("error",$error);
    }

    /**
     * For getting error from session and clean once it's done
     * 
     * @return string | null 
     */
    public static function getError() {
        $error = self::get("error");
        self::clean("error");
        return $error;
    }

}