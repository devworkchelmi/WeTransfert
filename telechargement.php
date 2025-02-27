<?php
require_once './header.php';
require_once './fonctions.php';
//récupérer les fichiers dans un tableau:
$fichiers = scandir("./uploads");
// récuperer les message d'erreur ou de confirmation et enregistrer les fichiers
$errorMessage = "";
$confirmationMessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    list($errorMessage, $confirmationMessage) = uploadFichier();
}
?>

<h1>Téléchargement</h1>

<h2>Vos Fichier :</h2>

<ul id="listFichiers">
<?php if(!empty($fichiers)): ?>
    <ul>
        <?php foreach($fichiers as $fichier): ?>
            <li><?= "$fichier"?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p> Il n'y a aucun fichier disponible.</p>
<?php endif; ?>
</ul>
<form id="uploadForm" action="telechargement.php" method="POST" enctype="multipart/form-data">
    <input type="button" value="Télécharger" onclick="">
    <input type="button" value="Supprimer" onclick="">
    <br>
    <br>
    <label for="file"> Enregistrer un nouveau fichier </label>
    <br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload File" name="submit">
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

<script src="telechargement.js"></script>   
