<?php
// Fonction de connexion
function deconnexion() {
    // Suppression des cookies
    setcookie('mail', '', time() - 3600);
    setcookie('mot_de_passe', '', time() - 3600);
    // Redirection vers la page d'accueil
    header('Location: index.php');
}

// fonction télécharger un ficher
function uploadFichier() {
    $errorMessage = "";
    $confirmationMessage="";
    if (isset($_POST['submit'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if ( $target_file == "uploads/") {
            return $uploadOk = 0;
        } else{
            // Verifie si le fichier existe déjà
            if (file_exists($target_file)) {
                $errorMessage = "Le fichier existe déjà.";
                $uploadOk = 0;
            }

            // Verifie la taille du fichier pour qu'elle ne depasse pas 20mo
            if ($_FILES["fileToUpload"]["size"] > 20000000) {
                $errorMessage = "Taille de fichier supérieur à 20mo.";
                $uploadOk = 0;
            }

            // Refuse les fichier en .php
            if($FileType == "php" ) {
                $errorMessage = "Les fichiers en .php ne sont pas autorisés.";
                $uploadOk = 0;
            }

            // Si $uploadOk est égal à 0, le fichier n'est pas enregistré
            if ($uploadOk == 0) {
                $errorMessage = "Le fichier ne peut pas être enregistré. " . $errorMessage;
            // Sinon on enregistre le fichier
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $confirmationMessage = "Le fichier : " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " a bien été enregistré.";
                } else {
                    $errorMessage = "Il y a eu une erreur pendant l'enregistrement du fichier.";
                }
            }
        }
        return array($errorMessage, $confirmationMessage);
    }
}

function supprimerFichier($fileName) {
    $filePath = './uploads/' . $fileName;
    if (file_exists($filePath)) {
        unlink($filePath);
        return "Le fichier a été supprimé avec succès.";
    } else {
        return "Le fichier n'existe pas.";
    }
}

?>