<?php
function index(){
    $nom = "nom de l'utilisateur";
    $prenom = "prenom de l'utilisateur";
    $mail = "adresse mail user";
    $mdp = "mot de passe user";

    return [
        $nom, 
        $prenom, 
        $mail,
        $mdp
    ];
}

?>