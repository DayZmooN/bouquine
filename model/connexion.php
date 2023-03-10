<?php
//on démarre une session PHP
session_start();
//protection pour empeche d'acceder a url
if (isset($_SESSION["user"])) {
    header("location: ../front/dashboarduser.php");
    exit;
}

//on verifie si le formulaire a été envoyé
if (!empty($_POST)) {
    // le formulaire a été envoyer 
    // on verifie que tous le champ sont requis sont remplis 
    if (
        isset($_POST["mail"], $_POST["password"])
        && !empty($_POST["mail"]) && !empty($_POST["password"])
    ) {
        //On verifie que email en est un 
        if (!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
            die("Ce n'est pas un email");
        }
        // On va se connecter a la bdd
        require_once "../front/connect.php";


        //on recherche dans la table user 
        $sql = "SELECT * FROM `user` WHERE `mail`= :mail";
        $query = $db->prepare($sql);
        $query->bindValue(":mail", $_POST["mail"], PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header('locatin ../front/connexion.php');
            // die("L'email et/ou le mot de passe est incorrect.");
        }

        //ici le l'utilisateur et le mot de passe son correcte
        //on va pouvoir "connecter" l'utilisateur
        if ($user) {
            // ici on a un user existant, on peut vérifier le mot de passe 
            if (!password_verify($_POST["password"], $user["password"])) {
            }

            //on stocke dans $_SESSION LES information de l'utilisateur
            $_SESSION["user"] = [
                "id" => $user["id_user"],
                "username" => $user["username"],
                "mail" => $user["mail"],
                "lastname" => $user["lastname"],
                "phone" => $user["phone"],
                "birthdate" => $user["birthdate"],
                "roles" => $user["roles"]
            ];
            header("location: ./dashboarduser.php");
        }
    }

    //Ajoutez ici tous les controles souhaités exemple double verifiacation de la sassie du mot de passe

}
