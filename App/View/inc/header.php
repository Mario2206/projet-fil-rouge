<header class="top-bar">
    <a href="<?= MAIN_PATH . HOME ?>" class="top-bar--logo">
        CLAIRVOYANCE
    </a>
    <nav class="top-bar--nav">
        <a href="<?= MAIN_PATH . BET_LIST ?>" class="top-bar--nav--items">Paris disponibles</a>
        <a href="<?= MAIN_PATH . BET_LIST_PRIVATE ?>" class="top-bar--nav--items">Mes paris personnalisés</a>
        <a href="<?= MAIN_PATH . BET_RESULTS ?>" class="top-bar--nav--items">Résultats</a>
    </nav>
    <div>
        <span class="border top-bar--nav--items"><?= $user->username ?></span>
        <a href="<?= MAIN_PATH . FRIENDS ?>" class="top-bar--nav--items">Amis</a>
        <a href="<?= MAIN_PATH . LOG_OUT ?>" class="top-bar--nav--items">Se déconnecter</a>
    </div>
    
</header>
