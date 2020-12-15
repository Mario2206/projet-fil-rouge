<?php

use App\Controller\CreatePollController;
use App\Exceptions\CreatePollException;
use Core\Router\Router;

require(ROOT ."/App/Constant/routes.php");

try {
    
    $router = new Router($_GET["url"]);

    $router->setControllerNameSpace("App\\Controller\\");

    //HOME

    $router->get(HOME, "HomeController", "homepage");

   

    //POLL ROUTE (SUBMITTER)

    $router->get(POLL_LIST_FRIENDS, "PollListController", "pollListFromFriends");

    $router->get(POLL_RESPONSE_START . "/:poll_id", "PollResponseController", "startPage");

    $router->get(POLL_RESPONSE . "/:poll_id", "PollResponseController", "pageForAnswers");

    $router->get(POLL_RESPONSE . "/:poll_id/:question_number", "PollResponseController", "getQuestion");

    $router->post(POLL_RESPONSE .  "/:poll_id/:question_number", "PollResponseController", "recieveAnswer");

    // POLL ROUTES (OWNER)

    $router->get(POLL_LIST, "PollListController", "pollList");

    $router->get(POLL_CREATION, "CreatePollController", "createPollPage");

    $router->post(POLL_CREATION, "CreatePollController", "createPoll");

    $router->get(POLL_CREATED, "CreatePollController", "confirmCreatePollPage");

    $router->get(POLL_REPORT . "/:poll_id", "PollManagerController", "getPollReport");

    $router->get(POLL_REPORT_DETAILS . "/:poll_id", "PollManagerController", "getResultsOfPoll");

    $router->get(POLL_CLOSE . "/:poll_id", "PollManagerController", "closePoll");

    $router->post(POLL_OPEN . "/:poll_id", "PollManagerController", "openPoll");

    //POLL CHAT

    $router->get(POLL_CHAT . "/:poll_id", "ChatController", "chatPage");

    $router->get(POLL_CHAT_MESSAGE . "/:poll_id", "ChatController", "getMessages");

    $router->post(POLL_CHAT_MESSAGE . "/:poll_id", "ChatController", "postMessage");

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

    $router->parse();
   
} 
catch(Exception $e) {
    echo "<strong>Error : $e</strong>";
}

