<?php
require_once './header.php';
?>
    <h1>Création de compte</h1>
    <form action="creation-compte.php" method="post">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" required>

        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="date_naissance">Date de naissance</label>
        <input type="date" name="date_naissance" id="date_naissance" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" required>

        <label for="password2">Confirmer le mot de passe</label>
        <input type="password" name="password2" id="password2" required>

        <input type="submit" value="Créer">
    </form>
<?php
require_once './footer.php';
?>
