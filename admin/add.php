<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livre</title>
</head>

<body>
    <?php
    require_once '../connexion.php';
    include './header-admin.php';
    session_start();

    if (isset($_POST['submit'])) {
        $ISBN = addslashes($_POST['ISBN']);
        $image = addslashes($_POST['image']);
        $title = addslashes($_POST['title']);
        $author = addslashes($_POST['author']);
        $editor = addslashes($_POST['editor']);
        $collection = addslashes($_POST['collection']);
        $publication_date = addslashes($_POST['publication_date']);
        $genre = addslashes($_POST['genre']);
        $id_category = addslashes($_POST['id_category']);
        $summary = addslashes($_POST['summary']);

        $addreq = $db->prepare("INSERT INTO `book`(`ISBN`,`image`, `title`, `author`, `editor`, `collection`, `publication_date`, `genre`, `id_category`, `summary`) VALUES (':ISBN',':image',':title',':author',':editor',':collection',':publication_date',':genre',':id_category',':summary')");
        $addreq->bindParam('ISBN', $ISBN, PDO::PARAM_STR);
        $addreq->bindParam('image', $image, PDO::PARAM_STR);
        $addreq->bindParam('title', $title, PDO::PARAM_STR);
        $addreq->bindParam('author', $author, PDO::PARAM_STR);
        $addreq->bindParam('editor', $editor, PDO::PARAM_STR);
        $addreq->bindParam('collection', $collection, PDO::PARAM_STR);
        $addreq->bindParam('publication_date', $publication_date, PDO::PARAM_STR);
        $addreq->bindParam('genre', $genre, PDO::PARAM_STR);
        $addreq->bindParam('id_category', $id_category, PDO::PARAM_INT);
        $addreq->bindParam('summary', $summary, PDO::PARAM_STR);
        $addreq->execute();

        $_SESSION['sucess'] = "Produit ajouté avec succès !";
        header('Location: article.php');
        exit();
    }
    ?>
    <h1 class="multiTitre">formulaire ajout de livre</h1>

    <form id="formulaire" action="#" method="POST">

        <div id="gauche">
            <div class="titre-auteur">
                <form id="formulaire" action="#" method="POST">
                    <div class="titre-auteur">

                        <label for="title"></label>
                        <input type="text" name="title" id="title" placeholder="TITRE">

                        <label for="author"></label>
                        <input type="text" name="author" id="author" placeholder="Auteur">

                        <label for="ISBN"></label>
                        <input type="text" name="ISBN" id="ISBN" placeholder="ISBN">
                        <label for="ISBN"></label>
                        <input type="text" name="ISBN" id="ISBN" placeholder="ISBN">

                    </div>
            </div>

            <div class="edition-date">
                <div class="edition-date">

                    <label for="editor"></label>
                    <input type="text" name="editor" id="editor" placeholder="Éditeur">

                    <input class="date" type="date" name="publication_date" id="publication_date" placeholder="Éditeur">
                    <label class="publication" for="publication_date">Publication </label>

                </div>

                <div class="select">

                    <label for="id_category">Catégorie</label>
                    <select name="id_category" id="id_category">
                        <option value="BD">b.d</option>
                        <option value="Comics">comics</option>
                        <option value="Documentaire">documentaire</option>
                        <option value="Jeunesse">Jeunesse</option>
                        <option value="Mangas">mangas</option>
                        <option value="Poésie">poésie</option>
                        <option value="Romans">romans</option>
                        <option value="Théatre">théatre</option>
                    </select>

                    <label for="genre">Genre</label>
                    <select type="text" name="genre" id="genre">
                        <option value="action">action</option>
                        <option value="aventure">aventure</option>
                        <option value="drame">drame</option>
                        <option value="fantasie">fantasie</option>
                        <option value="historique">historique</option>
                        <option value="horreur">horreur</option>
                        <option value="policier">policier</option>
                        <option value="romance">romance</option>
                        <option value="science-fiction">science-fiction</option>
                        <option value="thriller">thriller</option>
                    </select>

                    <label for="collection">Collection</label>
                    <select type="text" name="collection" id="collection" placeholder="">
                        <option value="collection1">collection 1</option>
                        <option value="collection2">collection 2</option>
                        <option value="collection3">collection 3</option>
                        <option value="collection4">collection 4</option>
                        <option value="collection5">collection 5</option>
                    </select>

                    <label for="image">Couverture</label>
                    <input type="file" name="image" id="image">

                </div>

                <div class="resume">

                    <label for="summary">Résumé</label>
                    <textarea type="text" name="summary" id="summary"> </textarea>

                </div>

                <a href="#"><img src="../image/envoiFormulaireLivre.png" alt="icone du dashboard"> </a>
    </form>

    <?php include './includeClose.php'  ?>