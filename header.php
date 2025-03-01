<<<<<<< HEAD
<?php
require_once './fonctions.php';
session_start();
=======
<?php require_once './fonctions.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
>>>>>>> ead7eeb22d0cf5bda09f37df11f541f99c13c7ec
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="création-compte.css">css formulaire création de compte
    <link rel="stylesheet" href="header.css"><!--css du header-->
    <title>WeTransfert</title>
</head>
<body>
    <header>
        <ul id="my-navigation" class="my-navigation">
            <li id="Accueil" class="my-nav"><a href="index.php">Connexion</a></li>
            <li id="profil" class="my-nav"><a href="profil.php">Profil</a></li>
            <li id="creer_compte" class="my-nav"><a href="creation-compte.php">Créer</a></li>
            <li id="telechargement" class="my-nav"><a href="telechargement.php">Téléchargement</a></li>
            <li id="deconnexion" class="my-nav"><a href="#" onclick="deconnexion()">Se déconnecter</a></li>
<<<<<<< HEAD
=======

>>>>>>> ead7eeb22d0cf5bda09f37df11f541f99c13c7ec
        </ul>
    </header>
<main>
