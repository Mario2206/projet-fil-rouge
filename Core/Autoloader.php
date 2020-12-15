<?php

namespace Core;

class Autoloader {

    public static function start() {
        spl_autoload_register([__CLASS__, "autoload"]);
    }

    private static function autoload($class) {
        $path= ROOT."/".str_replace("\\", "/", $class).".php";
        require($path);
    }
}
