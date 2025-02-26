<!--createLogin-->
<?php
    require_once 'config.php';
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (login, password) VALUES ('$login', '$password')";
    $result = $conn->query($sql);
    if ($result) {
        echo "Votre compte a bien été créé";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    ?>