<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue !</title>
    <link rel="stylesheet" href="<?= MAIN_PATH ?>/style/css/index.css">
</head>
<body>
    <header class="full-screen flex--column">
        <div class="top-bar">
            <span class="top-bar--logo">
                CLAIRVOYANCE
            </span>
            <button class="burger-btn">
                <span></span>
            </button>
            <nav class="top-bar--nav"></nav>
        </div>
        <section class="flex-fill flex align--center justify--center bg--blue">
            <h1 class="f-white">
                Bienvenue sur clairvoyance
            </h1>
        </section>
    </header>
    <main class="flex--column align--center pb-3">
        <section class="flex--column col11">
            <article class="flex align--stretch col9 py-4">
                <img src="<?= MAIN_PATH ?>/img/poll.jpg" alt="Poll image" title="Poll" width="250" class="col2"/>
                <div class="col7 flex--column justify--around">
                    <h2>
                        Qu'est qu'un sondage ?
                    </h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Non quas autem laborum dignissimos? Illo ad hic at vero modi maiores voluptate, doloribus asperiores ullam quae, nemo dolorum error nihil excepturi.
                    </p>
                </div>
            </article>
            <article class="flex justify--end align--stretch col9 self--end py-4">
                <div class="col7 flex--column justify--around">
                    <h2>
                        Qu'est qu'un sondage ?
                    </h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Non quas autem laborum dignissimos? Illo ad hic at vero modi maiores voluptate, doloribus asperiores ullam quae, nemo dolorum error nihil excepturi.
                    </p>
                </div>
                <img src="<?= MAIN_PATH ?>/img/poll.jpg" alt="Poll image" title="Poll" width="250" class="col2"/>
            </article>
            <article class="flex align--stretch col9 py-4">
                <img src="<?= MAIN_PATH ?>/img/poll.jpg" alt="Poll image" title="Poll" width="250" class="col2"/>
                <div class="col7 flex--column justify--around">
                    <h2>
                        Qu'est qu'un sondage ?
                    </h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Non quas autem laborum dignissimos? Illo ad hic at vero modi maiores voluptate, doloribus asperiores ullam quae, nemo dolorum error nihil excepturi.
                    </p>
                </div>
            </article>
        </section>
        <section class="flex justify--around py-3">
            <article class="card col2">
                <header class="card--header">
                    <h2 class="card--title">
                         Commencez <br> maintenant !
                    </h2>

                </header>
                <div class="card--content">
                    <h3 class="card--title--dark py-3">
                        Bonus
                    </h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium molestias exercitationem esse porro maxime ducimus optio eaque quae dignissimos? Autem provident sint omnis placeat doloremque mollitia, aliquam labore facilis veniam?
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque error quam aliquam temporibus ex possimus soluta vero aliquid aperiam laboriosam! Accusamus harum voluptas ad dolor illo. Et totam minus est?Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed beatae aliquid consequatur quasi assumenda cumque pariatur reiciendis, ab, doloremque dicta est. Doloribus repellendus ipsum earum autem distinctio id reprehenderit tempora.
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non temporibus eum pariatur doloremque ipsa rem qui aperiam mollitia fuga! Libero, dicta delectus dolores nobis error necessitatibus animi aspernatur! Eos, nihil. 
                    </p>  
                </div>
                
            </article>
            <article class="card col2">
                <header class="card--header">
                    <h2 class="card--title">
                         Parrainez
                    </h2>
                   
                </header>
                <div class="card--content">
                    <h3 class="card--title--dark py-3">
                        Offert
                    </h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium molestias exercitationem esse porro maxime ducimus optio eaque quae dignissimos? Autem provident sint omnis placeat doloremque mollitia, aliquam labore facilis veniam?
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque error quam aliquam temporibus ex possimus soluta vero aliquid aperiam laboriosam! Accusamus harum voluptas ad dolor illo. Et totam minus est?Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed beatae aliquid consequatur quasi assumenda cumque pariatur reiciendis, ab, doloremque dicta est. Doloribus repellendus ipsum earum autem distinctio id reprehenderit tempora.
                        <br>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non temporibus eum pariatur doloremque ipsa rem qui aperiam mollitia fuga! Libero, dicta delectus dolores nobis error necessitatibus animi aspernatur! Eos, nihil. 
                    </p>  
                </div>
            </article>
        </section>
        <div>
            <a href="<?= MAIN_PATH . LOGIN ?>" title="Se connecter" class="cta">
                Rejoignez-nous
            </a>
        </div>
    </main>
</body>
</html>