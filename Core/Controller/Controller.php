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
        $user = Session::get("user");
        $error = Session::getError();
        $success = Session::get("success");
        Session::clean("success");
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
    protected function redirect (string $path, string $successMessage = "") {
        Session::set("success", $successMessage);
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
     * @return any
     */
    protected function protectPageFor (string $role, string $redirectionRoute) {
        $entity = Session::get($role);
        if(!$entity) {
            $this->redirect($redirectionRoute);
        }

        return $entity;
    }

}