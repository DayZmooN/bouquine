<?php
// session_start();
require_once './connect.php';
require_once './header-front.php';



$query = $db->prepare('SELECT `id_book`, `ISBN`, `image`, `title`, `author`, `editor`, `collection`, `publication_date`, `genre`, `id_category`, `summary`, `status` FROM `book` ORDER BY RAND() LIMIT 8');
$query->execute();

if (isset($_POST['submit'])) {
    $email = ($_POST['email']);
    $newsreq = $db->prepare("INSERT INTO `newsletter`(`email`) VALUES ('$email')");
    //$newsreq->bindParam('email', $email, PDO::PARAM_STR);
    $newsreq->execute();

    header('location: ./accueil.php');
}
?>

<body>
    <!-- SECTION 1 populaire  -->
    <main>
        <section class="parallax-section">
            <div class="parallax parallax1">
                <h1>Bouquine</h1>
                <p id="explain"> Un lieu de savoir et de <br> découverte qui abrite
                    une vaste <br>collection de documents<br> imprimés
                    ainsi que des<br> ressources numériques pour<br> répondre
                    à tous vos besoins de<br> recherche et de lecture.</p>
            </div>
        </section>
        <section class="populaire">

            <div class="container">
                <h2 class="popular">Les plus populaires </h2>
                <?php foreach ($query as $article) { ?>
                    <div class="item">
                        <a href="./book.php?id=<?= $article['id_book'] ?>"><img src="../image/<?= $article['image'] ?>" alt="<?= $article['title'] ?>"></a>
                        <button id="resume" type="button"><a href="./book.php?id=<?= $article['id_book'] ?>">Résumé</a></button>
                        <p class="title"><?= $article['title'] ?></p><br>
                        <p class="author"><?= $article['author'] ?></p>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- END SECTION POPULAIRES -->


        <!-- SECTION NOUVEAUTES -->
        <?php
        $reqNew = $db->prepare('SELECT `id_book`, `ISBN`, `image`, `title`, `author`, `editor`, `collection`, `publication_date`, `genre`, `id_category`, `summary`, `status` FROM `book` ORDER BY `publication_date` DESC');
        $reqNew->execute();
        ?>
        <section id="new">
            <h2 id="nouveautes">Nouveautés</h2>
            <ul class=slider>

                <li><img src="../image/jeunesse.png" alt></li>
                <li><img src="../image/nature.png" alt></li>
                <li><img src="../image/fantastique.png" alt></li>

            </ul>
        </section>
        <!-- end section nouveautes  -->

        <!-- section genres preferes -->
        <?php
        $reqFav = $db->prepare("SELECT `book`.`id_book`, `book`.`ISBN`, `book`.`image`, `book`.`title`, `book`.`author`, `book`.`editor`, `book`.`collection`, `book`.`publication_date`, `book`.`genre`, `book`.`id_category`, `book`.`summary`, `book`.`status`, `genre`.`id_genre`, `genre`.`libel_genre`, `genre`.`genre_slug`
        FROM `book`
        INNER JOIN `genre_book`
        on `book`.`id_book` = `genre_book`.`id_book`
        INNER JOIN `genre`
        ON `genre_book`.`id_genre` = `genre`.`id_genre`

        WHERE genre.`id_genre` = 5
        LIMIT 4");
        $reqFav->execute();
        ?>
        <section id="gender">
            <div class="genre">
                <h2 id="prefers">Les genres préférés</h2>
                <h3 id="romance">Romance</h3>

                <div class="container1">
                    <?php foreach ($reqFav as $article) { ?>
                        <div class="item1">
                            <a href="./book.php?id=<?= $article['id_book'] ?>"><img src="../image/<?= $article['image'] ?>" alt="<?= $article['title'] ?>"></a>
                            <p class="title-gender"><?= $article['title'] ?></p><br>
                            <p class="author-gender"><?= $article['author'] ?></p>
                        </div>
                    <?php } ?>
                    <button id="see" type="button"><a href="./book.php?id=<?= $article['id_book'] ?>">Voir plus</a></button>

                </div>

                <hr class="gender1">

                <!-- debut genre fantaisie -->
                <div class="genre">
                    <?php
                    $reqFav = $db->prepare("SELECT `book`.`id_book`, `book`.`ISBN`, `book`.`image`, `book`.`title`, `book`.`author`, `book`.`editor`, `book`.`collection`, `book`.`publication_date`, `book`.`genre`, `book`.`id_category`, `book`.`summary`, `book`.`status`, `genre`.`id_genre`, `genre`.`libel_genre`, `genre`.`genre_slug`
        FROM `book`
        INNER JOIN `genre_book`
        on `book`.`id_book` = `genre_book`.`id_book`
        INNER JOIN `genre`
        ON `genre_book`.`id_genre` = `genre`.`id_genre`

        WHERE genre.`id_genre` = 1
        LIMIT 4");
                    $reqFav->execute();
                    ?>
                    <h3 id="fantaisie">Fantaisie</h3>

                    <div class="container2">
                        <?php foreach ($reqFav as $article) { ?>
                            <div class="item2">
                                <a href="./book.php?id=<?= $article['id_book'] ?>"><img src="../image/<?= $article['image'] ?>" alt="<?= $article['title'] ?>"></a>
                                <p class="title-fant"><?= $article['title'] ?></p><br>
                                <p class="author-fant"><?= $article['author'] ?></p>
                            </div>
                        <?php } ?>
                        <button id="see" type="button"><a href="./book.php?id=<?= $article['id_book'] ?>">Voir plus</a></button>
                    </div>

                    <hr class="gender1">

                    <!-- début genre action -->
                    <div class="genre">
                        <?php
                        $reqFav = $db->prepare("SELECT `book`.`id_book`, `book`.`ISBN`, `book`.`image`, `book`.`title`, `book`.`author`, `book`.`editor`, `book`.`collection`, `book`.`publication_date`, `book`.`genre`, `book`.`id_category`, `book`.`summary`, `book`.`status`, `genre`.`id_genre`, `genre`.`libel_genre`, `genre`.`genre_slug`
                        FROM `book`
                        INNER JOIN `genre_book`
                        on `book`.`id_book` = `genre_book`.`id_book`
                        INNER JOIN `genre`
                        ON `genre_book`.`id_genre` = `genre`.`id_genre`

                        WHERE genre.`id_genre` = 7
                        LIMIT 4");
                        $reqFav->execute();
                        ?>
                        <h3 id="action">Action</h3>

                        <div class="container3">
                            <?php foreach ($reqFav as $article) { ?>
                                <div class="item3">
                                    <a href="./book.php?id=<?= $article['id_book'] ?>"><img src="../image/<?= $article['image'] ?>" alt="<?= $article['title'] ?>"></a>
                                    <p class="title-act"><?= $article['title'] ?></p><br>
                                    <p class="author-act"><?= $article['author'] ?></p>
                                </div>
                            <?php } ?>
                            <button id="see" type="button"><a href="./book.php?id=<?= $article['id_book'] ?>">Voir plus</a></button>


                        </div>
        </section>

        <!-- END SECTION GENRE LES PLUS LUS  -->

        <!-- SECTION TEXTE -->
        <section id="text">
            <div class="contain-text">
                <div class="texte">
                    <p class="bouquine">BOUQUINE c’est :</p>
                    <p class="list">
                        <b>La recherche de livres </b>:les utilisateurs peuvent effectuer des recherches
                        en ligne pour trouver des livres disponibles.
                        <br><br>
                        <b>La réservation de livres</b> : possibilité de réserver des livres en ligne
                        pour les emprunter à une date ultérieure.
                        <br><br>
                        <b>Le prêt de livres</b> : possibilité d' emprunter
                        les livres réservés et les retirer à la bibliothèque.
                        <br><br>
                        <b> Le renouvellement de prêts</b> : possibilité renouveler
                        leurs emprunts en ligne pour prolonger la période de prêt.
                        <br><br>
                        <b> La consultation et lecture sur place.</b>
                    </p>
                </div>
                <div class="img">
                    <img class="image" src="../image/femme-livre.png" alt="Retrouvez le plaisir de la lecture avec Bouquine ">
                </div>
            </div>
        </section>

        <!-- END SECTION TEXTE -->

        <!-- SECTION NEWSLETTER -->

        <section class="parallax-section newsletter">
            <div class="parallax parallax1 news">
                <h2 id="titl">Newsletter gratuite</h2>
                <div class="formulaire">

                    <form action="" method="POST">
                        <label for="email">E-mail:</label>
                        <input id="email" name="email" type="email">
                        <input id="send" type="submit" name="submit">
                    </form>
                </div>

                <p class="abonner">N'hésitez pas à vous abonner pour recevoir en exclusivité chaque mois les
                    dernières nouveautés et évènements de la bibliothèque.<br>Nous ne vous enverrons pas de spam
                    ni ne partagerons vos informations.</p>
            </div>
        </section>
        <!-- END SECTION NEWSLETTER -->

        <!-- SECTION CONTACT -->
        <section id="contact">
            <h2 id="us">Contact</h2>
            <div class="container-contact">
                <div class="localisation">
                    <a href="https://goo.gl/maps/jTEf4EwKz4geiEws5"><img src="../image/localisation.png" alt="adresse de bouquine"></a>
                    <p class="adress">21 rue du Calidon<br> 01000 <br>Saint Denis les Bourg</p>
                </div>

                <div class="horaire">
                    <img src="../image/horloge.png" alt="horaire de bouquine">
                    <p class="hour">Du lundi au Samedi <br>de 9h à 18h non stop</p>
                </div>

                <div class="mail">
                    <img src="../image/enveloppe.png" alt="contactez-nous par mail ou tel"></a>
                    <p class="contactus"><a href="tel:+3374212363"> &nbsp; &nbsp; &nbsp;Tél:04.74.21.23.63 </a><br>
                        <a href="mailto:bouquine@orange.fr">Mail:bouquine@orange.fr
                    </p></a>
                </div>
            </div>
        </section>

        <!-- END SECTION CONTACT -->

        <!-- SECTION COMPTEUR -->

        <section class="section compteur">

            <div class="cards-list">

                <div class="card 1">
                    <div class="card_image"> <img src="https://media.giphy.com/media/2gSV1FB89mF2iAvh2v/giphy.gif" /> </div>
                    <div class="card_title title-white">
                        <p>Livres disponibles<br>
                            +4000</p>
                    </div>
                </div>

                <div class="card 2">
                    <div class="card_image">
                        <img src="https://media.giphy.com/media/kC3ME5mgPKS2DuZ7jr/giphy.gif" />
                    </div>
                    <div class="card_title title-white">
                        <p>Livres empruntés<br>
                            1500 livres</p>
                    </div>
                </div>

                <div class="card 3">
                    <div class="card_image">
                        <img src="https://media.giphy.com/media/2gSV1FB89mF2iAvh2v/giphy.gif" />
                    </div>
                    <div class="card_title title-white">
                        <p>Visiteurs<br>
                            3500</p>
                    </div>
                </div>

                <div class="card 4">
                    <div class="card_image">
                        <img src="https://media.giphy.com/media/kC3ME5mgPKS2DuZ7jr/giphy.gif" />
                    </div>
                    <div class="card_title title-white">
                        <p>Satisfaction client <br>
                            4.5/5</p>
                    </div>
                </div>

            </div>

        </section>

        <!-- END SECTION COMPTEUR  -->

        <!-- SECTION AVIS DES LECTEURS  -->
        <section id="lecteur">

            <div class="blog_post">
                <div class="img_pod">
                    <img src="../image/avis1.jpg" alt="photo lectrice">
                </div>
                <div class="container_copy">
                    <h3>12 Septembre 2022</h3>
                    <h1 id="lector">Cécile Randu</h1>
                    <p>La bibliothèque Bouquine est un lieu d'apprentissage formidable pour les
                        enfants. Ma famille et moi-même aimons passer du temps à y lire ensemble. Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                        Perspiciatis quas debitis magni minus totam.
                    </p>
                    .
                </div>
            </div>
            <div class="blog_post">
                <div class="img_pod">
                    <img src="../image/avis2.jpg" alt="photo lectrice">
                </div>
                <div class="container_copy">
                    <h3>5 Février 2023</h3>
                    <h1 id="lector">Cédric Durand</h1>
                    <p>Très bonne bibliothèque, endroit calme, large choix de livres. Idéal pour tous les étudiants.
                        Personnel très compétent et réactif! <br>Je recommande fortement!
                    </p>

                </div>
            </div>
            <div class="blog_post">
                <div class="img_pod">
                    <img src="../image/avis3.jpg" alt="photo lectrice">
                </div>
                <div class="container_copy">
                    <h3>10 Mars 2023</h3>
                    <h1 id="lector">Anaïs Dunand</h1>
                    <p>Réservation en ligne pour plus de rapidité, service et personnel agréable.<br>
                        Je recommande vivement.
                        veniam beatae quaerat facere ad repudiandae cum assumenda.</p>
                </div>
            </div>

        </section>
        <!-- end section avis lecteur  -->
    </main>
    <?php
    require_once './footer-front.php';
    ?>