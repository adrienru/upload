<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

$target_dir = isset($_GET['dir']) ? $_GET['dir'] . '/' : 'uploads/';
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "El archivo " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " ha sido subido correctamente.";
} else {
    echo "Lo siento, hubo un error al subir tu archivo.";
}
?>
