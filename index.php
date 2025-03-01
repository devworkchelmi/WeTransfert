<?php
require_once './fonctions.php';
require_once './header.php';
session_start();

$errorMessage="";

// Vérification des identifiants après soumission du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["identifiant"], $_POST["motdepasse"])) {
    $identifiant = filter_input(INPUT_POST, "identifiant", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $motdepasse = filter_input(INPUT_POST, "motdepasse", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $_SESSION["connecte"] = false;
    // Lire les utilisateurs stockés (fichier texte)
    $utilisateurs = file("utilisateurs.txt", FILE_IGNORE_NEW_LINES);
    foreach ($utilisateurs as $ligne) {
        (list($nom, $prenom, $email, $date_naissance, $hash_stocke) = explode(";", $ligne)) ;

        // Vérifier si l'email correspond et si le mot de passe est correct
        if ($email === $identifiant && $motdepasse) {
            $_SESSION["connecte"] = true;
            $_SESSION["identifiant"] = $email;
            $_SESSION["nom"] = $nom;
            $_SESSION["prenom"] = $prenom;
            header("Location: telechargement.php");
            exit();
        }
    }

    // Si aucune correspondance trouvée
    $errorMessage = "Identifiants incorrects.";
}
?>

<body>
    <h1>Bienvenue sur WeTransfert</h1>

    <section>
        <h2>Connexion</h2>
            <form action="index.php" method="POST">
                <label for="mail">Adresse mail</label>
                <input type="email" id="mail" name="identifiant">

                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="motdepasse">

                <input type="submit" value="Envoyer">
            </form>
            <?php if (!empty($errorMessage)): ?>
              <p style="color: red;"><?= $errorMessage ?></p>
            <?php endif; ?>
            <form action="index.php" method="POST">
                <button type="submit" name="deconnexion">Déconnexion</button>
            </form>
            <?php if (isset($_SESSION["connecte"]) && $_SESSION["connecte"]): ?>
              <p style="color: green;">Vous êtes connecté.</p>
              <?php else: ?>
                <p style="color: red;">Vous êtes deconnecté.</p>
            <?php endif; ?>

    </section>

    
</body>

<?php   
require_once './footer.php';
?>