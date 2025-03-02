<?php
require_once './header.php';
require_once './fonctions.php';

//verifications de la connexion
if (!isset($_SESSION['connecte']) || $_SESSION['connecte'] !== true) {
    // Redirigez l'utilisateur vers la page de connexion
    header('Location: index.php');
    exit();
}

$userEmail = $_SESSION['identifiant'];

//récupérer les fichiers dans un tableau:
$fichiers = scandir("./uploads");
// récuperer les message d'erreur ou de confirmation et enregistrer les fichiers
$errorMessage = "";
$confirmationMessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        list($errorMessage, $confirmationMessage) = uploadFichier($userEmail);
        // Recharger la liste des fichiers après upload
        $fichiers = scandir("./uploads");
    } elseif (isset($_POST['delete'])) {
        $confirmationMessage = supprimerFichier($_POST['delete']);
        // Recharger la liste des fichiers après suppression
        $fichiers = scandir("./uploads");
    } elseif (isset($_POST['download'])) {
        downloadFile($_POST['download']);
        exit;
    }
}

$userFiles = getUserFiles($userEmail);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Téléchargement</h1>

<h2>Vos Fichier :</h2>

<ul id="fileList">
<?php if(!empty($fichiers)): ?>
        <?php foreach($userFiles as $file): ?>
            <?php if ($file !== '.' && $file !== '..'): ?>
                <li>
                <a href="<?= $file; ?>" download><?= basename($file); ?></a>
                    <button onclick="deleteFile('<?= $fichier ?>')">Supprimer</button>
                    <form action="telechargement.php" method="POST" style="display:inline;">
                        <input type="hidden" name="download" value="<?= $fichier ?>">
                        <button type="submit">Télécharger</button>
                    </form>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
        <?php else: ?>
    <p> Il n'y a aucun fichier disponible.</p>
<?php endif; ?>
</ul>

<form id="uploadForm" action="telechargement.php" method="POST" enctype="multipart/form-data">
    <label for="file"> Enregistrer un nouveau fichier </label>
    <br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="enregistrer" name="submit">
    <?php if (!empty($errorMessage)): ?>
        <p style="color: red;"><?= $errorMessage ?></p>
    <?php endif; ?>
    <?php if (!empty($confirmationMessage)): ?>
        <p style="color: green;"><?= $confirmationMessage ?></p>
    <?php endif; ?>
</form>

<?php
require_once './footer.php';
?>
</body>
</html>