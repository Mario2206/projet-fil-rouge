<?php

namespace App\Controller;

use Core\Controller\Controller;

class HomeController extends Controller{

    public function homepage() {
        $this->render("homeView");   
    }    

}