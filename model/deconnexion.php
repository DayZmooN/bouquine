<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location: ../front/accueil.php");
    exit;
}

//supprime une variable sa supprime que la partie user 
unset($_SESSION["user"]);

header("location:../front/accueil.php");
