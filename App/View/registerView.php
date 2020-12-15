<?php

use Core\View\Template\Template;

ob_start();
?>
<section class="flex justify--center flex-fulfill py-3">
        <form class="form col6 flex--column align--center">
            <h1 class="form--title self--start">
                Inscription
            </h1>
            <div class="form--input-wrapper">
                <label for="firstname">
                    <img src="<?= MAIN_PATH ?>/img/user.svg" title="Nom d'utilisateur" />
                </label>
                <input type="text" placeholder="Prénom" id="firstname" required class="form--input" name="firstname"/>
            </div>
            <div class="form--input-wrapper">
                <label for="lastname">
                    <img src="<?= MAIN_PATH ?>/img/user.svg" title="Nom d'utilisateur" />
                </label>
                <input type="text" placeholder="Nom de famille" id="lastname" required class="form--input" name="lastname"/>
            </div>
            <div class="form--input-wrapper">
                <label for="username">
                    <img src="<?= MAIN_PATH ?>/img/user.svg" title="Nom d'utilisateur" />
                </label>
                <input type="text" placeholder="Nom d'utilisateur" id="username" required class="form--input" name="firstname"/>
            </div>
            <div class="form--input-wrapper">
                <label for="mail">
                    <img src="<?= MAIN_PATH ?>/img/mail.svg" title="Nom d'utilisateur" />
                </label>
                <input type="text" placeholder="E-mail" id="mail" required class="form--input" name="mail"/>
            </div>
            <div class="form--input-wrapper">
                <label for="password">
                    <img src="<?= MAIN_PATH ?>/img/lock.svg" title="Mot de passe"/>
                </label>
                <input type="password" placeholder="Mot de passe" required class="form--input" name="password" id="password"/>
            </div>
            <div class="form--input-wrapper">
                <label for="password_retype">
                    <img src="<?= MAIN_PATH ?>/img/lock.svg" title="Mot de passe"/>
                </label>
                <input type="password" placeholder="Mot de passe" required class="form--input" name="password_retype" id="password_retype"/>
            </div>
            <a href="<?= MAIN_PATH . LOGIN?>" title="Inscription" class="py-1"> Déjà un compte ? Se connecter</a>
            <button type="submit" class="cta">
                S'inscrire
            </button>
        </form> 
</section>

<?php 
$content = ob_get_clean();
$temp = new Template("S'inscrire", [], ["index"]);
$temp->render($content);