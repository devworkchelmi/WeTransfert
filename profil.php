<?php
session_start();
require_once './header.php';

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true) {
    header("Location: creation-compte.php");
    exit();
}

// Fichier contenant les utilisateurs
$fichier_utilisateurs = "utilisateurs.txt";

// Récupérer l'email de l'utilisateur connecté
$email_utilisateur = $_SESSION["identifiant"];

// Lire les utilisateurs stockés
$utilisateurs = file($fichier_utilisateurs, FILE_IGNORE_NEW_LINES);
$user_data = null;

// Chercher les infos de l'utilisateur
foreach ($utilisateurs as $ligne) {
    $data = explode(";", $ligne);
    if ($data[2] === $email_utilisateur) {
        $user_data = $data;
        break;
    }
}

// Vérifier si les informations existent
if (!$user_data) {
    die("Erreur : Impossible de trouver l'utilisateur.");
}

// Extraire les données utilisateur
list($nom, $prenom, $email, $date_naissance, $mdp_hash) = $user_data;

// Message de confirmation ou d'erreur
$message = "";

// Traitement du formulaire de mise à jour
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nouvel_email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $ancien_password = filter_input(INPUT_POST, "ancien_password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nouveau_password = filter_input(INPUT_POST, "nouveau_password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmation_password = filter_input(INPUT_POST, "confirmation_password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Vérification si l'email existe déjà dans la liste des utilisateurs
    foreach ($utilisateurs as $ligne) {
        $data = explode(";", $ligne);
        if (isset($data[2]) && trim($data[2]) === trim($nouvel_email) && $nouvel_email !== $email_utilisateur) {
            $message = "<p style='color: red;'>Erreur : Cet email est déjà utilisé.</p>";
            break;
        }
    }

    // Vérification du mot de passe actuel avant modification
    if (!empty($ancien_password) && !password_verify($ancien_password, $mdp_hash)) {
        $message = "<p style='color: red;'>Erreur : L'ancien mot de passe est incorrect.</p>";
    }

    // Vérification que les nouveaux mots de passe correspondent
    if (!empty($nouveau_password) && $nouveau_password !== $confirmation_password) {
        $message = "<p style='color: red;'>Erreur : Les nouveaux mots de passe ne correspondent pas.</p>";
    }

    // Si aucun message d'erreur, mise à jour des informations
    if (empty($message)) {
        // Hachage du nouveau mot de passe s'il a été modifié
        $nouveau_mdp_hash = !empty($nouveau_password) ? password_hash($nouveau_password, PASSWORD_DEFAULT) : $mdp_hash;

        // Mise à jour des données utilisateur
        $nouvelle_ligne = "$nom;$prenom;$nouvel_email;$date_naissance;$nouveau_mdp_hash\n";

        // Réécriture du fichier avec les nouvelles informations
        $nouveau_contenu = "";
        foreach ($utilisateurs as $ligne) {
            $data = explode(";", $ligne);
            if ($data[2] === $email_utilisateur) {
                $nouveau_contenu .= $nouvelle_ligne; // Remplace l'ancienne ligne
            } else {
                $nouveau_contenu .= $ligne . "\n";
            }
        }

        // Sauvegarde des nouvelles informations
        file_put_contents($fichier_utilisateurs, $nouveau_contenu);

        // Mettre à jour la session avec le nouvel email
        $_SESSION["identifiant"] = $nouvel_email;

        $message = "<p style='color: green;'>Vos informations ont été mises à jour avec succès.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Tableau de bord</title>
</head>

<body>
    <h1>Bienvenue, <?= htmlspecialchars($_SESSION["prenom"]) . " " . htmlspecialchars($_SESSION["nom"]); ?> !</h1>
    <p>Vous êtes connecté.</p>

    <?= $message; ?> <!-- Affichage des messages d'erreur ou de succès -->

    <h2>Modifier vos informations</h2>
    <form action="" method="POST">
        <label for="email">Nouvel email :</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($email); ?>" required>

        <label for="ancien_password">Ancien mot de passe :</label>
        <input type="password" name="ancien_password" id="ancien_password" required>

        <label for="nouveau_password">Nouveau mot de passe (laisser vide si inchangé) :</label>
        <input type="password" name="nouveau_password" id="nouveau_password">

        <label for="confirmation_password">Confirmer le nouveau mot de passe :</label>
        <input type="password" name="confirmation_password" id="confirmation_password">

        <input type="submit" value="Mettre à jour">
    </form>

    <?php require_once './footer.php'; ?>
</body>

</html>