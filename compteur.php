<?php

// <?php
// session_start(); //pour récuperer les données de la session
// On vérifie si la personne est connectée
//


// Durée de vie du cookie
$expiration = time(); // Par défaut, le cookie expire à la fin de la session

// Vérifier si le cookie compteur existe
if (isset($_COOKIE['compteur_visites'])) {
    $compteur = $_COOKIE['compteur_visites'] + 1;
} else {
    $compteur = 1; // Première visite
}

// Mettre à jour le cookie
setcookie('compteur_visites', $compteur, $expiration);

// Réinitialisation du compteur si le paramètre reset est présent
if (isset($_GET['reset'])) {
    setcookie('compteur_visites', '', time() - 3600); // Expiration du cookie
    header("Location: compteur.php"); // Redirection pour éviter d'afficher le paramètre dans l'URL
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compteur de visites</title>
</head>
<body>
    <h1>Compteur de visites</h1>
    <p>Vous avez visité cette page <strong><?php echo $compteur; ?></strong> fois.</p>
    <a href="compteur.php?reset=1">Réinitialiser le compteur</a>
</body>
</html>
