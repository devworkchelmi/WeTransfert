<?php
session_start();
if (!isset($_SESSION['connecte']) || $_SESSION['connecte'] !== true) {
    // Redirigez l'utilisateur vers la page de connexion
    header('Location: index.php');
    exit();
}
require_once './header.php';
?>



<?php
require_once './footer.php';
?>
