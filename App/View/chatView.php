<?php

use Core\View\Template\Template;

ob_start();
?>
<section class="flex--column align--center py-1">
        <h1 class="py-1">
            <?= $friend->username ?>
        </h1>
        <div class="chat-box" id="chat-container"></div>
        <form action="<?= MAIN_PATH . CHAT_MESS . "/" . $friend->idFriend ?>" class="py-1" id="chat-form" data-username="<?= $user->username ?>">
            <input type="text" name="message" placeholder="Entrez un message" class="form--input">
            <button class="cta">
                Envoyer
            </button>
        </form>
</section>

<?php 
$content = ob_get_clean();
$temp = new Template("Chat :" . $friend->username, ["chat"], ["index"]);
$temp
    ->setContextVars(compact("error", "success", "user"))
    ->render($content);