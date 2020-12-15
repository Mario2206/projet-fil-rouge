<?php

//SERVER ROOT
$projectDir = "/project/dir/form/server/root";

define("MAIN_PATH", "http://" . $_SERVER['SERVER_NAME'] . $projectDir);

//PROJECT ROOT
define("ROOT", dirname(__DIR__));