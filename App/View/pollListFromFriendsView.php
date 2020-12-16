<?php

use Core\View\Template\Template;

ob_start()

?>

    <section class="px-1">
            <header class="flex justify--center py-1">
                <h1>Liste des sondages de vos amis</h1>
            </header>


            <?php 

                if($polls) :  
                    foreach ($polls as $poll):
                
            ?>

            <article class="card col3" >

                <header class="card--header">
                    <h2 class="card--title"><?= $poll->pollName ?></h2>
                </header>

                <div class="card--content">

                    <span class="">Créé le : <?= $poll->createdAt ?></span>
                    <p class="py-1"><?= $poll->description ?></p>
                    
                    <a href="<?= MAIN_PATH . POLL_RESPONSE_START . "/" . $poll->idPoll ?>" class="cta">Répondre</a>
                    <div class="d-flex flex-row justify-content-between">
                        <p class="py-1">
                            Disponible jusqu'à : <span><?= $poll->unAvailableAt ?></span>
                        </p>
                        <blockquote>
                            <p>Crée par <strong><?= $poll->username ?></strong></p>
                        </blockquote>
                    </div>
                </div>
            </article>

            <?php 
                    endforeach;
                else :
                    
            ?>
            <div class="d-flex justify-content-center align-items-center">
                <div class="alert alert-warning">
                        Vous n'avez pas encore de sondage proposé !
                </div> 
            </div>
            
            <?php endif; ?>


    </section>

<?php
$content = ob_get_clean();
$temp = new Template("Sondages de vos amis", [], ["index"]);
$temp->render($content);