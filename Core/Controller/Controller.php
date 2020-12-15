<?php

namespace Core\Controller;

use Core\Tools\Session;

class Controller {


    /**
     * For rendering a view
     * 
     * @param string $pageName
     * @param array $vars (variables to pass to view)
     */
    protected function render (string $pageName, array $vars = []) {
        extract($vars);
        $error = Session::getError();
        require(__DIR__ . "/../../App/View/$pageName.php");
    }
    
    /**
     * For sending json data to the client 
     * 
     * @param $content 
     * @param int $statusCode
     */
    protected function renderJson ($content, int $statusCode) {
        http_response_code($statusCode);
        echo json_encode($content);
        die();
    }

    /**
     * For redirecting to path
     * 
     * @param string $path
     */
    protected function redirect (string $path) {
        header("Location:" . MAIN_PATH . $path);
        die();
    }

    /**
     * For redirecting to path with error
     * 
     * @param string $path 
     * @param string | string[] $error 
     */
    protected function redirectWithErrors (string $path, $error) {
        Session::setError($error);
        $this->redirect($path);
    }

    /**
     * For protecting page for specific role
     * 
     * @param string $role 
     * @param string $redirectionRoute
     * 
     */
    protected function protectPageFor (string $role, string $redirectionRoute) {
        if(!Session::get($role)) {
            $this->redirect($redirectionRoute);
        }
    }

}