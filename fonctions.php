
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
        $upload_ok = 1;
        $file_type = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
        //$target_file = $target_dir . uniqid() . '.' . $file_type; Pour avoir un nom de fichier différents
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if ( $target_file == "uploads/") {
            return $upload_ok = 0;
        } else{
            // Verifie si le fichier existe déjà
            if (file_exists($target_file)) {
                $errorMessage = "Le fichier existe déjà.";
                $upload_ok = 0;
            }

            // Verifie la taille du fichier pour qu'elle ne depasse pas 20mo
            if ($_FILES["fileToUpload"]["size"] > 20000000) {
                $errorMessage = "Taille de fichier supérieur à 20mo.";
                $upload_ok = 0;
            }

            // Refuse les fichier en .php
            if($file_type == "php" ) {
                $errorMessage = "Les fichiers en .php ne sont pas autorisés.";
                $upload_ok = 0;
            }

            // Si $uploadOk est égal à 0, le fichier n'est pas enregistré
            if ($upload_ok == 0) {
                $errorMessage = "Le fichier ne peut pas être enregistré. " . $errorMessage;
            // Sinon on enregistre le fichier
            } else {
                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                    $confirmationMessage = "Le fichier : " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " a bien été enregistré.";
                } else {
                    $errorMessage = "Il y a eu une erreur pendant l'enregistrement du fichier.";
                }
            }
        }
        return array($errorMessage, $confirmationMessage);
    }
}

// fonction supprimer un fichier
function supprimerFichier($fileName) {
    $filePath = './uploads/' . $fileName;
    // On vérifie si le fichier existe avant de le supprimer
    if (file_exists($filePath)) {
        //unlink() supprime un fichier
        unlink($filePath);
        return "Le fichier a été supprimé avec succès.";
    } else {
        return "Le fichier n'existe pas.";
    }
}

function downloadFile($fileName) {
    $filePath = './uploads/' . $fileName;
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        return "Le fichier n'existe pas.";
    }
}

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