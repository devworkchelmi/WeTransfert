<?php 
require_once './fonctions.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="création-compte.css"><!--css formulaire création de compte-->
    <link rel="stylesheet" href="header.css"><!--css du header-->
    <link rel="stylesheet" href="style.css"><!--css global-->
    <title>WeTransfert</title>
</head>
<body>
    <header>
        <ul id="my-navigation" class="my-navigation">
            <li id="Accueil" class="my-nav"><a href="index.php">Connexion</a></li>
            <li id="profil" class="my-nav"><a href="profil.php">Profil</a></li>
            <li id="creer_compte" class="my-nav"><a href="creation-compte.php">Créer</a></li>
            <li id="telechargement" class="my-nav"><a href="telechargement.php">Téléchargement</a></li>
            <li id="deconnexion" class="my-nav"><a href="logout.php">Se déconnecter</a></li>

        </ul>
    </header>
<main>
