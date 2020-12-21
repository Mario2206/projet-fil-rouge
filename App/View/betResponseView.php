<?php

use Core\View\Template\Template;

ob_start();
?>
    <?php
       require(ROOT . "\App\View\inc\pointsComponent.php");
    ?>
    <h1 class="txt--center py-1">
        <?= $bet->betName ?>
    </h1>
    <section id="content-page" class="flex--column align--center">
        <form action="<?= MAIN_PATH . PLAY_POINTS . "/" . $bet->idBet ?>" method="POST" class="flex--column align--center" id="bet-response-form" data-bet-id="<?= $bet->idBet ?>"></form>
    </section>
    
<?php
$content = ob_get_clean();
$temp = new Template($bet->betName, ["bet-response"], ["index"]);
$temp   
    ->setContextVars(compact("user"))
    ->render($content);