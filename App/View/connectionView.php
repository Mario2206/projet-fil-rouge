<?php

use Core\View\Template\Template;

ob_start();
?>
<section class="flex justify--center flex-fulfill py-3">
        <form class="form col6 flex--column align--center" action="<?= MAIN_PATH . LOGIN ?>" method="POST">
            <h1 class="form--title self--start">
                Connexion
            </h1>
            <div class="form--input-wrapper">
                <label for="username">
                    <img src="<?= MAIN_PATH ?>/img/user.svg" title="Nom d'utilisateur" />
                </label>
                <input type="text" placeholder="Nom d'utilisateur" id="username" required class="form--input" name="username"/>
            </div>
            <div class="form--input-wrapper">
                <label>
                    <img src="<?= MAIN_PATH ?>/img/lock.svg" title="Mot de passe"/>
                </label>
                <input type="password" placeholder="Mot de passe" required class="form--input" name="password"/>
            </div>
            <a href="<?= MAIN_PATH . REGISTER?>" title="Inscription" class="py-1"> Pas de compte ? S'inscrire</a>
            <button type="submit" class="cta">
                Se connecter
            </button>
        </form> 
</section>

<?php 
$content = ob_get_clean();
$temp = new Template("Connexion", [], ["index"]);
$temp->setContextVars(compact("error", "success"));
$temp->render($content);