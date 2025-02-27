<?php
require_once './header.php';
?>

<?php
session_start();

// Vérification des identifiants après soumission du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["identifiant"], $_POST["motdepasse"])) {
    $identifiant = filter_input(INPUT_POST, "identifiant", FILTER_SANITIZE_STRING);
    $motdepasse = filter_input(INPUT_POST, "motdepasse", FILTER_SANITIZE_STRING);

    // Lire les utilisateurs stockés (fichier simulé ici)
    $utilisateurs = file("utilisateurs.txt", FILE_IGNORE_NEW_LINES);

    foreach ($utilisateurs as $ligne) {
        list($nom, $prenom, $email, $date_naissance, $hash_stocke) = explode(";", $ligne);

        // Vérifier si l'email (ou login) correspond et si le mot de passe est correct
        if ($email === $identifiant && password_verify($motdepasse, $hash_stocke)) {
            $_SESSION["connecte"] = true;
            $_SESSION["identifiant"] = $email;
            header("Location: dashboard.php");
            exit();
        }
    }

    // Si aucune correspondance trouvée
    echo "Identifiants incorrects. Veuillez réessayer.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Création de compte</h1>
    <?php if (isset($_SESSION["connecte"]) && $_SESSION["connecte"]): ?> <!--Vérifie si l'utilisateur est connecté-->
        <h1>Bienvenue <?= $_SESSION["identifiant"] ?></h1>
    <?php else: ?>

        <form action="traitement-creation-compte.php" method="post">
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

    <?php
    require_once './footer.php';
    ?>

</body>

</html>