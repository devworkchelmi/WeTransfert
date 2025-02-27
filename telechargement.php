<?php
require_once './header.php';
require_once './fonctions.php';
//récupérer les fichiers dans un tableau:
$fichiers = scandir("./uploads");
// récuperer les message d'erreur ou de confirmation et enregistrer les fichiers
$errorMessage = "";
$confirmationMessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        list($errorMessage, $confirmationMessage) = uploadFichier();
        // Recharger la liste des fichiers après upload
        $fichiers = scandir("./uploads");
    } elseif (isset($_POST['delete'])) {
        $confirmationMessage = supprimerFichier($_POST['delete']);
        // Recharger la liste des fichiers après suppression
        $fichiers = scandir("./uploads");
    } elseif (isset($_POST['download'])) {
        downloadFile($_POST['download']);
    }
}

?>

<h1>Téléchargement</h1>

<h2>Vos Fichier :</h2>

<ul id="fileList">
<?php if(!empty($fichiers)): ?>
        <?php foreach($fichiers as $fichier): ?>
            <?php if ($fichier !== '.' && $fichier !== '..'): ?>
                <li>
                    <?= $fichier ?>
                    <button onclick="deleteFile('<?= $fichier ?>')">Supprimer</button>
                    <input type="hidden" name="download" value="<?= $fichier ?>">
                    <button type="submit">Télécharger</button>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
        <?php else: ?>
    <p> Il n'y a aucun fichier disponible.</p>
<?php endif; ?>
</ul>

<form id="uploadForm" action="telechargement.php" method="POST" enctype="multipart/form-data">
    <br>
    <br>
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


