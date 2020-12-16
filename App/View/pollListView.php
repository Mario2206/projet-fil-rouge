<?php

use Core\View\Template\Template;
require(ROOT . "/App/View/utils/checker.php");
ob_start();
?>
<section class="px-1">

        <header class="flex justify--center py-1">
            <h1>
                Liste de vos sondages
            </h1>
        </header>

        <?php 

            if($polls) :  
                foreach ($polls as $poll):
            
        ?>

        <article class="card my-1 col3" >
            <header class="card--header">
                <h2 class="card--title"><?= $poll->pollName ?></h2>
            </header>
            
            <div class="card-body p-1 flex--column align--center">
                
                <span class="">Créé le : <?= $poll->createdAt ?></span>
                <p class="py-1"><?= $poll->description ?></p>
                <a href="<?= MAIN_PATH . POLL_REPORT . "/" . $poll->idPoll ?>" class="cta">Go</a>
                <?php   
                    disponibilitySate($currentDate,$poll->availableAt, $poll->unAvailableAt);
                ?>
            </div>
        </article>

        <?php 
                endforeach;
            else :
                
        ?>
        <div class="d-flex justify-content-center align-items-center">
            <div class="alert alert-warning ">
                    Vous n'avez pas encore de sondage créé !
            </div> 
        </div>
        
        <?php endif; ?>
</section>    
    
<?php
$content = ob_get_clean();
$temp = new Template("Liste de sondages", [], ["index"]);
$temp->render($content);