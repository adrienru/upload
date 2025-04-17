<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['file']) && isset($_POST['new_name'])) {
    $filePath = $_GET['file'];
    $newName = dirname($filePath) . '/' . $_POST['new_name'];

    if (file_exists($filePath) && !file_exists($newName)) {
        rename($filePath, $newName);
        echo "Archivo renombrado correctamente.";
    } else {
        echo "No se pudo renombrar el archivo.";
    }

    // Redireccionar a la página anterior
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

// Obtener el directorio anterior
$dir = isset($_GET['dir']) ? $_GET['dir'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renombrar Archivo</title>
    <style>
        .retroceder-button {
            margin-top: 10px;
            display: inline-block;
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .retroceder-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Renombrar Archivo</h2>
    <form method="POST">
        <label for="new_name">Nuevo nombre:</label>
        <input type="text" name="new_name" required>
        <input type="submit" value="Renombrar">
    </form>
    <br>
    <a href="?dir=<?php echo urlencode($dir); ?>" class="retroceder-button">Regresar</a>
</body>
</html>
