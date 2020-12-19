<?php


use Core\Router\Router;

require(ROOT ."/App/Constant/routes.php");


try {
    
    $router = new Router($_GET["url"]);

    $router->setControllerNameSpace("App\\Controller\\");

    //HOME

    $router->get(HOME, "HomeController", "homepage");

   

    //BET ROUTES

    $router->get(BET_LIST, "BetCategoryController", "showCategories");

    $router->get(BET_LIST . "/:category", "BetListController", "globalBetListFromCategory");

    $router->get(BET_LIST_PRIVATE, "BetCategoryController", "showPrivateCategories");

    $router->get(BET_LIST_PRIVATE . "/:category", "BetListController", "ownBetListFromCategory");

    $router->get(BET_REPORT . "/:betId", "BetReportController", "getBetReport");

    $router->get(BET_CREATION, "CreateBetController", "createBetPage");


    //USER ROUTES

    $router->get(REGISTER, "RegisterController", "registerPage");

    $router->post(REGISTER, "RegisterController", "register");

    $router->get(LOGIN, "LoginController", "loginPage");

    $router->post(LOGIN, "LoginController", "login");

    $router->get(ACCOUNT, "AccountController", "accountPage");

    $router->post(ACCOUNT, "AccountController", "accountSet");

    $router->get(LOG_OUT, "LoginController", "logout");

    // FRIENDS
    $router->get(FRIENDS, "FriendsController", "friendsPage");

    $router->post(FRIENDS, "FriendsController", "addFriend");

    $router->get(FRIENDS_ACCEPT . "/:friendId", "FriendsController", "acceptFriend");

    $router->get(FRIENDS_REJECT . "/:friendId", "FriendsController", "rejectFriend");

    $router->get("/404", "NotFoundController", "displayError");

    $router->parse();
   
} 
catch(Exception $e) {
    echo "<strong>Error : $e</strong>";
}

