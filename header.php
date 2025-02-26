<?php
require_once './fonctions.php';
[$produits] = produit();
[$nom, $prenom, $telephone, $email, $feminin, $masculin, $date] = contact();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site boutique</title>
</head>
<body>
    <header>
        <ul id="my-navigation" class="my-navigation">
            <li id="Accueil" class="my-nav"><a href="index.php">Accueil</a></li>
            <li id="produits" class="my-nav"><a href="produits.php">Produits</a></li>
            <li id="contact" class="my-nav"><a href="contact.php">contact</a></li>
        </ul>
    </header>

    <main>