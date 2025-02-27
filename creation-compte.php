<?php
require_once './header.php';
session_start();

// Liste des comptes autorisés (à terme, à stocker en BDD)
$comptes = [
    ["login" => "admin", "mdp" => "admin"],
    ["login" => "modo", "mdp" => "modo"]
];

$message = ""; // Message d'erreur ou de succès

// Vérification des identifiants après soumission du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["identifiant"], $_POST["motdepasse"])) {
    $identifiant = filter_input(INPUT_POST, "identifiant", FILTER_SANITIZE_STRING);
    $motdepasse = filter_input(INPUT_POST, "motdepasse", FILTER_SANITIZE_STRING);

    // Vérifier si le login et le mot de passe correspondent à un compte existant
    $authentifie = false;
    foreach ($comptes as $compte) {
        if ($compte["login"] === $identifiant && $compte["mdp"] === $motdepasse) {
            $authentifie = true;
            $_SESSION["connecte"] = true;
            $_SESSION["identifiant"] = $identifiant;
            header("Location: dashboard.php"); // Redirection après connexion
            exit();
        }
    }

    // Si aucune correspondance n'est trouvée
    if (!$authentifie) {
        $message = "Identifiants incorrects. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion et Création de compte</title>
</head>
<body>
    <h1>Connexion</h1>
    
    <?php if ($message) : ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>
    
    <form action="creation-compte.php" method="post">
        <label for="identifiant">Nom d'utilisateur :</label>
        <input type="text" id="identifiant" name="identifiant" required>
        <br>
        <label for="motdepasse">Mot de passe :</label>
        <input type="password" id="motdepasse" name="motdepasse" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>

    <h1>Création de compte</h1>
    <?php if (isset($_SESSION["connecte"]) && $_SESSION["connecte"]): ?>
        <h2>Bienvenue, <?= htmlspecialchars($_SESSION["identifiant"]); ?> !</h2>
        <a href="logout.php">Se déconnecter</a>
    <?php else: ?>

        <form action="traitement-creation.php" method="post">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" required>

            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="date_naissance">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>

            <label for="password2">Confirmer le mot de passe</label>
            <input type="password" name="password2" id="password2" required>

            <input type="submit" value="Créer">
        </form>
    <?php endif; ?>

    <?php require_once './footer.php'; ?>
</body>
</html>
