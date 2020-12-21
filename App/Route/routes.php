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

    $router->get(BET_RESPONSE_START . "/:idBet", "BetResponseController", "startPage");

    $router->post(PLAY_POINTS . "/:idBet", "ParticipationController", "userPayment");

    $router->get(BET_RESPONSE . "/:idBet", "BetResponseController", "pageForAnswers");

    $router->get(BET_RESPONSE . "/:idBet/:currentQuestion", "BetResponseController", "getQuestion");

    $router->post(BET_RESPONSE . "/:idBet/:currentQuestion", "BetResponseController", "recieveAnswer");

    $router->get(BET_RESULTS, "BetResultController", "getResults");

    $router->get(BET_RESULTS . "/:idParticipation", "BetResultController", "getResult");

    $router->get(BET_LIST_PRIVATE, "BetCategoryController", "showPrivateCategories");

    $router->get(BET_LIST_PRIVATE . "/:category", "BetListController", "ownBetListFromCategory");

    $router->get(BET_REPORT . "/:betId", "BetManagerController", "getBetReport");

    $router->get(BET_REPORT_DETAILS . "/:betId", "BetManagerController", "getResultsOfbet");

    $router->post(BET_CLOSE . "/:betId", "BetManagerController", "closeBet");

    $router->post(BET_OPEN . "/:betId", "BetManagerController", "openBet");

    $router->get(BET_CREATION, "CreateBetController", "createBetPage");

    $router->post(BET_CREATION, "CreateBetController", "createBet");


    //USER ROUTES

    $router->get(REGISTER, "RegisterController", "registerPage");

    $router->post(REGISTER, "RegisterController", "register");

    $router->get(LOGIN, "LoginController", "loginPage");

    $router->post(LOGIN, "LoginController", "login");

    $router->get(ACCOUNT, "AccountController", "accountPage");

    $router->post(ACCOUNT, "AccountController", "accountSet");

    $router->get(LOG_OUT, "LoginController", "logout");

    //CHAT ROUTE 

    $router->get(CHAT . "/:idFriend", "ChatController", "chatPage");

    $router->get(CHAT_MESS . "/:idFriend", "ChatController", "getMessages");

    $router->post(CHAT_MESS . "/:idFriend", "ChatController", "postMessage");

    // FRIENDS
    $router->get(FRIENDS, "FriendsController", "friendsPage");

    $router->post(FRIENDS, "FriendsController", "addFriend");

    $router->get(FRIENDS_REJECT . "/:friendId", "FriendsController", "removeFriend");

    $router->get("/404", "NotFoundController", "displayError");

    $router->parse();
   
} 
catch(Exception $e) {
    echo "<strong>Error : $e</strong>";
}

