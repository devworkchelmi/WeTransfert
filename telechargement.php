<?php
session_start();
if (!isset($_SESSION['connecte']) || $_SESSION['connecte'] !== true) {
    // Redirigez l'utilisateur vers la page de connexion
    header('Location: index.php');
    exit();
}
require_once './header.php';
require_once './fonctions.php';

// Récupérer l'email de l'utilisateur connecté
$userEmail = $_SESSION['identifiant'];

// Récupérer les fichiers de l'utilisateur
$userFiles = getUserFiles($userEmail);

//Récupérer les fichiers dans un tableau:
$fichiers = scandir("./uploads");

//Récuperer les message d'erreur ou de confirmation et enregistrer les fichiers
$errorMessage = "";
$confirmationMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        list($errorMessage, $confirmationMessage) = uploadFichier($userEmail);
        // Recharger la liste des fichiers après upload
        $userFiles = getUserFiles($userEmail);
    } elseif (isset($_POST['delete'])) {
        $confirmationMessage = supprimerFichier($_POST['delete'], $userEmail);
        // Recharger la liste des fichiers après suppression
        $userFiles = getUserFiles($userEmail);
    } elseif (isset($_POST['download'])) {
        $storedName = $_POST['download'];
        $originalName = '';
        foreach ($userFiles as $file) {
            if ($file['stored'] === $storedName) {
                $originalName = $file['original'];
                break; 
            }
        }
        downloadFile($storedName, $originalName, $userEmail);
        // Recharger la liste des fichiers après téléchargement
        $userFiles = getUserFiles($userEmail);
        exit;
    }
}
?>

<h2>Vos Fichiers :</h2>

<ul id="fileList">
<?php if(!empty($userFiles)): ?>
        <?php foreach($userFiles as $file): ?>
            <li>
                <?= htmlspecialchars($file['original']) ?>
                <form action="telechargement.php" method="POST" style="display:inline;">
                    <input type="hidden" name="delete" value="<?= $file['stored'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
                <form action="telechargement.php" method="POST" style="display:inline;">
                    <input type="hidden" name="download" value="<?= $file['stored'] ?>">
                    <button type="submit">Télécharger</button>
                </form>
                <p>Vous avez téléchargé ce fichier <?= $file['downloads'] ?> fois</p>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Il n'y a aucun fichier disponible.</p>
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
