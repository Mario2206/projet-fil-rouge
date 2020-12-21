<?php

use Core\View\Template\Template;

ob_start();

?>

<section class="flex--column align--center">
    <h1 class="txt--center py-1">
        Mes amis 
    </h1>
    <form action="<?= MAIN_PATH . FRIENDS?>" method="POST">
        <input type="text" name="username" />
        <button>
            Ajouter
        </button>
    </form>
    <table class="py-1 col8">
        <thead>
            <tr>
                <th>
                    Username 
                </th>
                <th>
                    Etat
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($friends as $friend) : ?>
                <tr>
                    <td class="txt--center">
                        <?= $friend->username ?>
                    </td>
                    <td class="txt--center">
                        <?= $friend->accepted ? "<span class='f-green'>Accepté</span>" : "<span class='f-orange'>Refusé</span>" ?>
                    </td>
                    <td>
                        <a href="#" class="cta">Chat</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php 
$content = ob_get_clean();
$temp = new Template("Amis", [], ["index"]);
$temp
    ->setContextVars(compact("user", "error", "success"))
    ->render($content);