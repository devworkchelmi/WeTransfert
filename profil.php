<?php
require_once './header.php';
?>

<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true) {
    header("Location: creation-compte.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    <h1>Bienvenue, <?= htmlspecialchars($_SESSION["identifiant"]); ?> !</h1>
    <p>Vous êtes connecté.</p>
    <a href="logout.php">Se déconnecter</a>

    <?php
require_once './footer.php';
?>
</body>
</html>


