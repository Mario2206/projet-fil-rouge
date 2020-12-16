<?php

use Core\View\Template\Template;

ob_start();
?>

<header class="d-flex flex-column align-items-center">
    <h1 class="text-center"><?= $poll->pollName ?></h1>
    <p class="text-center py-3">
        <?= $poll->description ?>
    </p>
    <div class="d-flex justify-content-center py-3">
        <div class="d-flex flex-column align-items-center">
            <p>
                Disponible le
            </p>
            <span class="border border-black mx-3 p-2">
                <?= $poll->availableAt ?>
            </span>  
        </div>
        <div class="d-flex flex-column align-items-center">
            <p>
                Indisponible le
            </p>
            <span  class="border border-black mx-3 p-2">
                <?= $poll->unAvailableAt ?>
            </span>
        </div>
    </div>
    <div class="py-2">

        <p>Situation actuelle :</p>

        <?php 
            require_once(ROOT . "\App\View\inc\disponibility-state.php");
            disponibilitySate($currentDate, $poll->availableAt, $poll->unAvailableAt);
        ?>

    </div>
</header>
<section class="d-flex flex-column align-items-center">
   
    <?php
        require_once(ROOT . "\App\View\inc\modal-disponibility-date.php");
        ModalDisponibilityDate($poll->idPoll);
    ?>

    <!-- CONTAINER RESULTS -->
    <div class="d-flex flex-column align-items-center" id="container-results">
         <input type="hidden" value="<?= $poll->idPoll ?>" id="poll-id"/>
    </div>

    <section class="py-3 my-5 h-50 w-100 border border-dark">

        <header>

            <h3>Messages en temps réel</h3>

        </header>

        <div id="poll-chat" class="border overflow-auto" style="height:50vh"></div>
        <form action="<?= MAIN_PATH . POLL_CHAT_MESSAGE . "/" . $poll->idPoll  ?>" class="d-flex justify-content-center py-3 " id="poll-chat-form">
            <input type="text" placeholder="Envoyer un message" class="p-2" name="poll-message">
            <button type="submit" class="btn btn-primary mx-3">Envoyer</button>
        </form>

    </section>

    <footer class="d-flex justify-content-center">
       
        <?php
            require_once(ROOT . "\App\View\inc\disponibility-btn.php");
            disponibilityBtn($poll->idPoll, $currentDate, $poll->availableAt , $poll->unAvailableAt);
        ?>

    </footer>
</section>

<?php
$content = ob_get_clean();
$temp = new Template($poll->pollName, ["poll-chat", "poll-report"]);
$temp->render($content);