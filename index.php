<?php
require_once './fonctions.php';
require_once './header.php';
session_start();

$mail = filter_input(INPUT_GET, "adressemail");
$mdp = filter_input(INPUT_GET, "mdpuser");
$identifiant = [$mail, $mdp] = index();

$mail = filter_input(INPUT_COOKIE, "adressemail");  //le mail sert d'identifiant

setcookie($mail, $mdp); // maj de cookie pour un utilisateur

    if (isset ($_POST['adressemail'] &&$_POST['mdpuser'])){
        $mail = filter_input(INPUT_POST, "adressemail");
        $mdp = filter_input(INPUT_POST, "mdpuser");

        $_SESSION['adressemail'] = $mail ;
        $_SESSION['mdpuser'] = $mdp ;

        $_SESSION["connecte"] = true;

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