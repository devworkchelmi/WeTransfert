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
<form action=""
<input type="button" value="Télécharger" onclick="">
<input type="button" value="Supprimer" onclick="">
<br>
<br>
<label for="file"> Enregistrer un nouveau fichier </label>
<br>
<input type="file" name="file" id="file">


<?php
require_once './footer.php';
?>
