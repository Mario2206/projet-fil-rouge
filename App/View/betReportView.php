<?php

use Core\View\Template\Template;

ob_start();
?>

<section class="py-1">

    <?php 
        require(ROOT . "\App\View\inc\disponibilityModal.php");
        disponibilityModal($bet->idBet);
    ?>

    <header class="flex--column align--center">
        <h1 class="txt--center"><?= $bet->betName ?></h1>
        <p class="txt--center py-1 style--italic">
            <?= $bet->description ?>
        </p>
        <div class="flex justify--between py-1 col6">
            <div>
                <p>
                    Disponible le
                </p>
                <span class="style--bold">
                    <?= $bet->availableAt ?>
                </span>  
            </div>
            <div class="">
                <p>
                    Indisponible le
                </p>
                <span class="style--bold">
                    <?= $bet->unAvailableAt ?>
                </span>
            </div>
        </div>
        <div class="flex--column align--center">

            <p>Situation actuelle :</p>

            <?php 
                require_once(ROOT . "\App\View\inc\disponibilityState.php");
                disponibilitySate($currentDate, $bet->availableAt, $bet->unAvailableAt);
            ?>

        </div>
    </header>

    <!-- CONTAINER RESULTS -->
    <form action="<?= MAIN_PATH . BET_CLOSE . "/" . $bet->idBet ?>" method="POST"  id="form-result">
        <div class="flex--column align--center" id="container-results">
            <input type="hidden" value="<?= $bet->idBet ?>" id="bet-id"/>
        </div>
        <div class="flex justify--center">
            <?php
                require_once(ROOT . "\App\View\inc\disponibilityBtn.php");
                disponibilityBtn($bet->idBet, $currentDate, $bet->availableAt , $bet->unAvailableAt);
            ?>  
        </div>
       

    </form>

</section>

<?php
$content = ob_get_clean();
$temp = new Template($bet->betName, ["bet-report", "modal"], ["index"]);
$temp
    ->setContextVars(compact("error", "success", "user"))
    ->render($content);