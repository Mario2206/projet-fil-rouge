<?php

namespace App\Controller;

use Core\Controller\Controller;

class NotFoundController extends Controller {

    public function displayError() {
        echo "Code 404 : page not found";
    }
}