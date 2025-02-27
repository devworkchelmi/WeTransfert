<?php
require_once './header.php';

?>

<h1>Téléchargement</h1>

<h2>Vos Fichier :</h2>

<ul>
<?php if(!empty($fichiers)): ?>
    <ul>
        <?php foreach($fichiers as $fichier): ?>
            <li><?= $fichier?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p> Il n'y a aucun fichier disponible.</p>
<?php endif; ?>
</ul>
<form action="telechargement.php" method="POST" enctype="multipart/form-data">
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
