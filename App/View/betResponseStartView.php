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
    <form action="<?= MAIN_PATH . PLAY_POINTS . "/" . $bet->idBet ?>" method="POST" class="flex--column align--center">
        <div class="flex--column align--center py-2">
            <label class="py-3">Déterminer le nombre de points à mettre en jeu</label>
            <input type="number" name="user_points" value="0" min="0" max="<?= $user->points ?>"/>
        </div>
        <button class="cta">
            Jouer
        </button>
    </form>
<?php
$content = ob_get_clean();
$temp = new Template($bet->betName, [], ["index"]);
$temp   
    ->setContextVars(compact("user", "error"))
    ->render($content);