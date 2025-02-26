<?php
// Fonction de connexion
function deconnexion() {
    // Suppression des cookies
    setcookie('mail', '', time() - 3600);
    setcookie('mot_de_passe', '', time() - 3600);
    // Redirection vers la page d'accueil
    header('Location: index.php');
}

// Fonction lister les fichier
function listerFichiers() {
    $fichiers = [
        [
            "fichier1" => "Premier fichier",
            "fichier2" => "Deuxième fichier",
            "fichier3" => "Troisième fichier",
        ]  

    ];
    return $fichiers;
}

// fonction télécharger un ficher
function telechargerFichier() {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Verifie si le fichier existe déjà
    if (file_exists($target_file)) {
    echo "Le fichier existe déjà.";
    $uploadOk = 0;
    }

    // Verifie la taille du fichier pour qu'elle ne depasse pas 20mo
    if ($_FILES["fileToUpload"]["size"] > 20000000) {
    echo "taille de fichier supérieur à 20mo.";
    $uploadOk = 0;
    }

    // Allow certain file formats
    if($FileType == "php" ) {
    echo "les fichier en .php ne sont pas autorisés.";
    $uploadOk = 0;
    }

    // Si $uploadOk est égal à 0, le fichier n'est pas enregistré
    if ($uploadOk == 0) {
    echo "Le fichier ne peut pas être enregistré.";
    // Sinon on enregistre le fichier
    } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Le fichier : ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " a bien été enregistrer.";
    } else {
        echo "Il y a eu une erreur pendant l'enregistrement du fichier.";
    }
    }

    return $uploadOk;
}
?>