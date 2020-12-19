<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach($templateStyles as $style) : ?>
       <link rel="stylesheet" href="<?= MAIN_PATH ?>/style/css/<?=$style?>.css">
    <?php endforeach; ?>
    <title><?= $templateTitle ?></title>
</head>
<body>

    <?php
        require(ROOT . "/App/View/inc/header.php");
        require(ROOT . "/App/View/inc/alertError.php");
        require(ROOT . "/App/View/inc/alertSuccess.php");
        
        if(isset($error) && $error) {
            alertError($error);
        }

        if(isset($success) && $success) {
            alertSuccess($success);
        }
    ?>

    <main>
       <?= $content ?> 
    </main>
    
    <script>const MAIN_PATH = "<?= MAIN_PATH ?>"</script>
    <script src="https://code.jquery.com/jquery-git.min.js"></script>
    <?= array_reduce($templateScripts, function ($acc , $script) {
        return $acc .= '<script src="'. MAIN_PATH . '/js/' . $script . '.js"></script>';
    }) 
    ?>
</body>
</html>