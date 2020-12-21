<?php

use Core\View\Template\Template;

ob_start()

?>
    <div class="p-1">
        <div>
            <img src="<?= MAIN_PATH ?>/img/trophy.svg" alt="trophy"/>
            <span>
                <?= $user->points ?> pts
            </span>
        </div>
    </div>
    <section class="px-1">
            <header class="flex justify--center py-1">
                <h1>Résultats</h1>
            </header>

            <div class="flex">
            <?php 

                if($results) :  
                    foreach ($results as $result):
                
            ?>
           
                <article class="card col3 mx-1" >

                    <header class="card--header">
                        <h2 class="card--title"><?= $result->betName ?></h2>
                    </header>

                    <div class="card--content">
                        <a href="<?= MAIN_PATH . BET_RESULTS . "/" . $result->idParticipation ?>" class="cta">Voir le résultat</a>

                        </div>
                    </div>
                </article>             
            

            <?php 
                    endforeach;
                else :
                    
            ?>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <div class="alert alert-warning">
                        Aucun pari en cours ... Revenez plus tard !
                </div> 
            </div>
            
            <?php endif; ?>


    </section>

<?php
$content = ob_get_clean();
$temp = new Template("Vos résultats de pari", [], ["index"]);
$temp
    ->setContextVars(compact("error", "success", "user"))
    ->render($content);