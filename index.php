<?php
require_once './fonctions.php';

[$nom, $prenom, $mail, $mdp] = index();

$methode = $_SERVER["REQUEST_METHOD"];
if($methode == "POST") {

    $nom = filter_input(INPUT_POST, "nom");
    $prenom = filter_input(INPUT_POST, "prenom");

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
    <h2>Connexion</h2>

    <form action="POST">
        <label for="nom"></label>
        <input type="text" id="prenom" name="leprenom">
        
        <label for="prenom">Nom</label>
        <input type="text" id="nom" name="lenom">
        
        <label for="mdp">Nom</label>
        <input type="text" id="mdp" name="motdepasse">

        <input type="submit" value="Envoyer" name="submit">
    </form>
    
</body>
</html>