<?php
// on démarre une session PHP
session_start();
// protection pour empêcher d'accéder à l'url
if (isset($_SESSION["admin"])) {
    header("location: dashboard-admin.php");
    exit;
}

// on vérifie si le formulaire a été envoyé
if (!empty($_POST)) {
    // le formulaire a été envoyé
    // on vérifie que tous les champs requis sont remplis
    if (isset($_POST["mail"], $_POST["password"]) && !empty($_POST["mail"]) && !empty($_POST["password"])) {
        // on vérifie que l'email est valide
        if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
            die("Ce n'est pas un email");
        }
        // on va se connecter à la BDD
        require_once "../front/connect.php";

        $sqlAdmin = "SELECT `mail` FROM `admin` WHERE `mail` = :mail";
        $queryAdmin = $db->prepare($sqlAdmin);
        $queryAdmin->bindParam("mail", $_POST["mail"], PDO::PARAM_STR);
        $queryAdmin->execute();
        $admin = $queryAdmin->fetch(PDO::FETCH_ASSOC);

        // si l'administrateur existe
        if ($admin) {
            // on vérifie le mot de passe
            if (!password_verify($_POST["password"], $admin["password"])) {
            }
            // on stocke dans $_SESSION les informations de l'administrateur
            $_SESSION["admin"] = [
                "username" => $admin["username"],
                "mail" => $admin["mail"]
            ];
            // on peut rediriger vers la page de profil (par exemple)
            header("location: ./dashboard-admin.php");
        }
    }

    // ajoutez ici tous les contrôles souhaités 
}

// on inclut le header 

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <title>connexion Admin</title>
    <link rel="stylesheet" href="../css/style-admin.css">


</head>

<body>

    
    <aside id="side-bar">
        <div id="logo">
            <img src="../image/logoAdmin.png" alt="logo du site bouquine">
        </div>


    </aside>

<div class="corp">
    <header id="headerDashboard">

    </header>


 <form class="connexion" action="" method="post">
                <h1 class="Titre">connexion</h1>
                <div id="mail" >
                    <label for="mail"></label>
                    <input type="email" name="mail" id="mail" placeholder="entrez votre mail" >
                </div>
                <div id="pass" >
                    <label for="password"></label>
                    <input type="password" name="password" id="password" placeholder="entrez votre mot de passe"  >
                </div>
                <div id="connect" >
                    <button type="submit">connect</button>
                </div>

            </form>


      

        
           




















    
</div>
</body>

</html>