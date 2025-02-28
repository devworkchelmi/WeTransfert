<?php
require_once './fonctions.php';
require_once './header.php';
session_start();

$identifiant = [$mail, $mdp] = index();

/*

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
        */

        // Vérification des identifiants après soumission du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["identifiant"], $_POST["motdepasse"])) {
    $identifiant = filter_input(INPUT_POST, "identifiant", FILTER_SANITIZE_STRING);
    $motdepasse = filter_input(INPUT_POST, "motdepasse", FILTER_SANITIZE_STRING);

    // Lire les utilisateurs stockés (fichier texte)
    $utilisateurs = file("utilisateurs.txt", FILE_IGNORE_NEW_LINES);

    foreach ($utilisateurs as $ligne) {
        list($nom, $prenom, $email, $date_naissance, $hash_stocke) = explode(";", $ligne);

        // Vérifier si l'email correspond et si le mot de passe est correct
        if ($email === $identifiant && password_verify($motdepasse, $hash_stocke)) {
            $_SESSION["connecte"] = true;
            $_SESSION["identifiant"] = $email;
            $_SESSION["nom"] = $nom;
            $_SESSION["prenom"] = $prenom;
            header("Location: /telechargement.php");
            exit();
        }
    }

    // Si aucune correspondance trouvée
    echo "Identifiants incorrects. <a href='creation-compte.php'>Retour</a>";
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