<?php
require_once './fonctions.php';
require_once './header.php';


[$mail, $mdp] = index();


$methode = $_SERVER["REQUEST_METHOD"];
if($methode == "POST") {

    $mail = filter_input(INPUT_POST, "mail");
    $mdp = filter_input(INPUT_POST, "mdp");

    var_dump($nom, $prenom);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
</head>
<body>
    <h1>Bienvenue sur WeTransfert</h1>
    <h2>Connectez-vous pour envoyer vos fichiers</h2>
    <section>
    <form action="index.php" method="post">
    <label for="mail">Adresse mail</label>
            <input type="text" id="mail" name="mail">
                            
                <label for="mdp">Mot de passe</label>
                <input type="text" id="mdp" name="motdepasse">

                <input type="submit" value="Envoyer" name="submit">
            </form>
            <p>Pas encore de compte ? <a href="creation-compte.php">Créez-en un</a></p>

    </section>

<?php
    require_once './footer.php';
?>
</body>
</html>
