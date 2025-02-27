<?php
require_once './fonctions.php';
require_once './header.php';
require_once './footer.php';


[$nom, $prenom, $mail, $mdp] = index();


$methode = $_SERVER["REQUEST_METHOD"];
if($methode == "POST") {

    $nom = filter_input(INPUT_POST, "nom");
    $prenom = filter_input(INPUT_POST, "prenom");
    $mail = filter_input(INPUT_POST, "mail");
    $mdp = filter_input(INPUT_POST, "mdp");

    var_dump($nom, $prenom);
}
?>


    <section>
        <form action="POST">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="lenom">
                
                <label for="prenom">Prenom</label>
                <input type="text" id="prenom" name="leprenom">
                
                <label for="mdp">Mot de passe</label>
                <input type="text" id="mdp" name="motdepasse">

                <input type="submit" value="Envoyer" name="submit">
            </form>
    </section>

    

