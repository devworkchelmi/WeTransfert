
<?php

// fonction télécharger un ficher
function uploadFichier($userEmail) {
    $errorMessage = "";
    $confirmationMessage="";
    if (isset($_POST['submit'])) {
        $target_dir = "uploads/";
        $upload_ok = 1;
        $file_type = strtolower(pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . '.' . $file_type; //Pour avoir un nom de fichier différents
        $initial_name = basename($_FILES["fileToUpload"]["name"]);
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

                    // Ajout du chemin du fichier à utilisateur.txt
                    $filePath = 'utilisateurs.txt';
                    if (file_exists($filePath)) {
                        $fileContent = file_get_contents($filePath);
                        $lines = explode("\n", $fileContent);
                        foreach ($lines as &$line) {
                            if (strpos($line, $userEmail) !== false) {
                                $line = rtrim($line) . ';' .  $initial_name . '|' . $target_file;
                                break;
                            }
                        }
                        $newContent = implode("\n", $lines);
                        file_put_contents($filePath, $newContent);
                    } else {
                        $errorMessage = "Le fichier utilisateur.txt n'existe pas.";
                    }
                } else {
                    $errorMessage = "Il y a eu une erreur pendant l'enregistrement du fichier.";
                }
            }
        }
        /*echo '<pre>';
        print_r($pathInfo);
        echo '</pre>';
        */
        return array($errorMessage, $confirmationMessage, $initial_name);
    }
}

// fonction supprimer un fichier
function supprimerFichier($fileName, $userEmail) {
    $filePath = $fileName;
    // On vérifie si le fichier existe avant de le supprimer
    if (file_exists($filePath)) {
        // unlink() supprime un fichier
        unlink($filePath);

        // Mise à jour de utilisateurs.txt
        $filePath = 'utilisateurs.txt';
        if (file_exists($filePath)) {
            $fileContent = file_get_contents($filePath);
            $lines = explode("\n", $fileContent);
            foreach ($lines as &$line) {
                if (strpos($line, $userEmail) !== false) {
                    // Supprimer le chemin du fichier de la ligne
                    $line = preg_replace('/;[^;]*\|' . preg_quote($fileName, '/') . '/', '', $line);
                    break;
                }
            }
            $newContent = implode("\n", $lines);
            file_put_contents($filePath, $newContent);
        }

        return "Le fichier a été supprimé avec succès.";
    } else {
        return "Le fichier n'existe pas.";
    }
}

function downloadFile($storedName, $originalName) {
    $filePath = $storedName;
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($originalName).'"');
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

// fonction pour récupérer les fichiers uploadés par l'utilisateur
function getUserFiles($userEmail) {
    $filePath = 'utilisateurs.txt';
    if (file_exists($filePath)) {
        $fileContent = file_get_contents($filePath);
        $lines = explode("\n", $fileContent);
        $userFiles = [];

        foreach ($lines as $line) {
            if (strpos($line, $userEmail) !== false) {
                $parts = explode(';', $line);
                // Ignorer les cinq premières données
                $parts = array_slice($parts, 5);
                foreach ($parts as $part) {
                    list($original_name, $stored_name) = explode('|', $part);
                    $userFiles[] = ['original' => $original_name, 'stored' => $stored_name];
                }
                break;
            }
        }
        return $userFiles;
    } else {
        return [];
    }
}

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