<?php

use Core\View\Template\Template;

ob_start();
?> 

<section  class="flex--column align--center">
    <h1 class="txt--center py-1">Créer son pari personnalisé</h1>
    <form action="<?=  MAIN_PATH . BET_CREATION ?>" class="col6 flex--column align--center" method="POST">
        <div class="flex--column align--center py-2">
            <label for="bet_name">Titre du pari</label>
            <input type="text" placeholder="Entre 2 et 30 caractères" id="bet_name" name="bet_name" class="p-1">
        </div>
        <div class="flex--column align--center py-2">
            <label for="bet_category">Catégorie du pari</label>
            <select id="bet_category" name="bet_category">
                <?php foreach($categories as $category) : ?>
                    <option value="<?= $category->id ?>">
                        <?= $category->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex justify--around col12">
            <div class="flex--column">
                <label for="bet_available">Disponible le</label>
                <input type="date" name="bet_available" id="bet_available">
            </div>
            <div class="flex--column">
                <label for="bet_unavailable">Indisponible le</label>
                <input type="date" name="bet_unavailable" id="bet_unavailable">
            </div>
        </div>
        <div class="flex--column py-3 col12">
            <label for="bet_description " class="py-1">Description du pari</label>
            <textarea col="30" rows="10" placeholder="Entre 5 et 100 caractères" id="bet_description" name="bet_description"></textarea>
        </div>
        <div class="my-1">
            <button class="btn btn-info add-question">Ajouter une question</button>
        </div>
        <div class="w-100 container-question-response"></div>
        <button type="submit" class="cta bet-validation" class="" disabled>
            Valider
        </button>
    </form> 
</section>

<?php
$content = ob_get_clean();
$temp = new Template("Créer un pari", ["create-bet"], ["index"]);
$temp
    ->setContextVars(compact("error", "success", "user"))
    ->render($content);