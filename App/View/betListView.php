<?php

use Core\View\Template\Template;

ob_start()

?>

    <section class="px-1">
            <header class="flex justify--center py-1">
                <h1>Liste des sondage de la catégorie : <?= $category->name ?></h1>
            </header>


            <?php 

                if($bets) :  
                    foreach ($bets as $bet):
                
            ?>

            <article class="card col3" >

                <header class="card--header">
                    <h2 class="card--title"><?= $bet->betName ?></h2>
                </header>

                <div class="card--content">

                    <span class="">Créé le : <?= $bet->createdAt ?></span>
                    <p class="py-1"><?= $bet->description ?></p>
                    
                    <a href="<?= MAIN_PATH . BET_RESPONSE_START . "/" . $bet->idBet ?>" class="cta">Répondre</a>
                    <div class="d-flex flex-row justify-content-between">
                        <p class="py-1">
                            Disponible jusqu'à : <span><?= $bet->unAvailableAt ?></span>
                        </p>
                        <blockquote>
                            <p>Crée par <strong><?= $bet->username ?></strong></p>
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