<?php
require_once './fonctions.php';
require_once './header.php';
session_start();

$mail = filter_input(INPUT_GET, "adressemail");
$mdp = filter_input(INPUT_GET, "mdpuser");
$identifiant = [$mail, $mdp] = index();
$mail = filter_input(INPUT_COOKIE, "adressemail");  

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adressemail']) && isset($_POST['mdpuser'])) {
        $mail = filter_input(INPUT_POST, "adressemail", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $mdp = filter_input(INPUT_POST, "mdpuser", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $utilisateurs = file("utilisateurs.txt", FILE_IGNORE_NEW_LINES);
        $authentifie = false;

        foreach ($identifiant as $id) {
            if ($identifiant["mail"] === $id && $identifiant["mdp"] === $mdp) {
                $authentifie = true;
                $_SESSION["identifiant"] = $id; //le mail sert d'identifiant
                $_SESSION["connecte"] = true;
                header("Location: dashboard.php"); // Redirection après connexion
                exit();
            }
        }
    }

    if (!isset($_SESSION["connecte"]) || $_SESSION["connecte"] !== true) {
        header("Location: dashboard.php");
        exit();
    }

    if (!$authentifie) {
        $message = "Identifiants incorrects. Veuillez réessayer.";
    }
?>

<body>
    <h1>Bienvenue sur WeTransfert</h1>

    <section>
        <h2>Connexion</h2>
            <form action="POST">
                <label for="mail">Adresse mail</label>
                <input type="text" id="mail" name="adressemail">

                <label for="mdp">Mot de passe</label>
                <input type="text" id="mdp" name="motdepasse">

                <input type="submit" value="Envoyer" name="submit">
            </form>
    </section>

    
</body>

<?php   
require_once './footer.php';
?>