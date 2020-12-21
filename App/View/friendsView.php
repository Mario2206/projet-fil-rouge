<?php

use Core\View\Template\Template;

ob_start();

?>

<section class="flex--column align--center">
    <h1 class="txt--center py-1">
        Mes amis 
    </h1>
    <form action="<?= MAIN_PATH . FRIENDS?>" method="POST" class="flex--column align--center col2">
        <input type="text" name="username" class="flex-fill form--input"/>
        <button class="cta--success my-1">
            Ajouter
        </button>
    </form>
    
    <div class="flex--column align--center col8">
        <?php foreach($friends as $friend) : ?>
            <div class=" col10 flex justify--between align--center">
                <span class="txt--center">
                    <?= $friend->username ?>
                </span>
                <div>
                    <a href="<?= MAIN_PATH . CHAT . "/" . $friend->idFriend ?>" class="cta">Chat</a>
                    <a href="<?= MAIN_PATH . FRIENDS_REJECT . "/" . $friend->idFriend ?>" class="cta--danger">Supprimer</a>  
                </div>
                
            </div>
        <?php endforeach; ?>
    </div>
   
</section>

<?php 
$content = ob_get_clean();
$temp = new Template("Amis", [], ["index"]);
$temp
    ->setContextVars(compact("user", "error", "success"))
    ->render($content);