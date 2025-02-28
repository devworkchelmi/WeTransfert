<?php
function index(){

    $mail = "adressemailuser";
    $mdp = "mdpuser";

    return [
        $mail,
        $mdp
    ];
}

function deconnexion() {
    if (isset($_POST['deconnexion'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}


?>