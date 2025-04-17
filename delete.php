<?php
if (isset($_GET['file'])) {
    $filePath = $_GET['file'];
    if (file_exists($filePath)) {
        unlink($filePath);
        echo "Archivo eliminado correctamente.";
    } else {
        echo "El archivo no existe.";
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
