<!-- Ce fichier va : 
✅ Vérifier si tous les champs sont remplis.
✅ Vérifier si les mots de passe correspondent.
✅ Hacher le mot de passe avant de l’enregistrer.
✅ Stocker les informations dans utilisateurs.txt. -->


<?php
session_start();

// Vérifier que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et filtrage des données
    $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $date_naissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);
    $password2 = filter_input(INPUT_POST, "password2", FILTER_DEFAULT);
    
    // Vérification que tous les champs sont remplis
    if (!$nom || !$prenom || !$email || !$date_naissance || !$password || !$password2) {
        die("Tous les champs doivent être remplis.");
    }

    // Vérifier si les mots de passe correspondent
    if ($password !== $password2) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Hachage du mot de passe avant stockage
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si l'email existe déjà
$utilisateurs = [];

if (file_exists("utilisateurs.txt")) {
    $utilisateurs = file("utilisateurs.txt", FILE_IGNORE_NEW_LINES);
}
    foreach ($utilisateurs as $ligne) {
        list($nom_exist, $prenom_exist, $email_exist, $date_naissance_exist, $hash_exist) = explode(";", $ligne);
        if ($email_exist === $email) {
            die("Cet email est déjà enregistré.");
        }
    }

    // Stockage des données dans un fichier texte
    $user_data = "$nom;$prenom;$email;$date_naissance;$hash\n";
    file_put_contents("utilisateurs.txt", $user_data, FILE_APPEND);

    echo "Compte créé avec succès ! <a href='creation-compte.php'>Retour</a>";
}
?>
