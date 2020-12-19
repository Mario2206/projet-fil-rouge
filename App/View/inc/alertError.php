<?php

function alertError($error) {

    $displayErrors = $error;

    if(gettype($displayErrors) === "array") :
?>
    <div class='alert--error'>
        <ul>
            <?php foreach($displayErrors as $err) : ?>
                <li><?= $err ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php else : ?>
    <div class='alert--error'>
        <p>
            <?= $displayErrors ?>
        </p>
    </div>
    
 <?php endif;  
}