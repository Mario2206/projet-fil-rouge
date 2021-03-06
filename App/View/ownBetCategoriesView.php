<?php

use Core\View\Template\Template;

ob_start();
?>
<section class="px-1">

    <header class="flex--column align--center py-1">
        <h1>
            Liste de vos paris créés 
        </h1>
        <a class="cta self--end" href="<?= MAIN_PATH . BET_CREATION ?>">
            Créer un pari
        </a>
    </header>
    <div class="flex--row">
        <?php 

            if($categories) :  
                foreach ($categories as $category):
            
        ?>
        <a class="col3 my-1" href="<?= MAIN_PATH . BET_LIST_PRIVATE . "/" . $category->code ?>">
            <article class="card col12" >
                <header class="card--header">
                    <h2 class="card--title"><?= $category->name ?></h2>
                </header>
                <img src="<?= MAIN_PATH ."/img/" . $category->miniature ?>" title="<?= $category->name ?>" alt="<?= $category->name ?>" class="col12" />
            </article> 
        </a>
        

        <?php 
                endforeach;
            else :
                
        ?>
    </div>
    
    <div class="d-flex justify-content-center align-items-center">
        <div class="alert alert-warning ">
                Vous n'avez pas encore de sondage créé !
        </div> 
    </div>

    <?php endif; ?>
</section>    
<?php 
$content = ob_get_clean();
$temp = new Template("Catégories de paris", [], ["index"]);
$temp
    ->setContextVars(compact("error", "success", "user"))
    ->render($content);