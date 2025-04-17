<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivos</title>
    <style>
        /* Estilos para el contenedor y el botón */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .icon {
            font-size: 20px;
            margin-right: 10px;
        }
        .file-icon {
            width: 24px; /* Ajusta el ancho aquí */
            height: 24px; /* Ajusta la altura aquí */
            vertical-align: middle; /* Alinea verticalmente el icono con el texto */
            margin-right: 8px; /* Espaciado entre el icono y el texto */
        }
        .retroceder-button {
            margin-bottom: 10px; /* Espaciado */
            display: inline-block; /* Alinea correctamente */
            padding: 5px 10px; /* Relleno del botón */
            background-color: #007BFF; /* Color del botón */
            color: white; /* Color del texto */
            text-decoration: none; /* Sin subrayado */
            border-radius: 5px; /* Bordes redondeados */
        }
        .logout-button {
            margin-bottom: 10px; /* Espaciado */
            display: inline-block; /* Alinea correctamente */
            padding: 5px 10px; /* Relleno del botón */
            background-color: #dc3545; /* Color rojo */
            color: white; /* Color del texto */
            text-decoration: none; /* Sin subrayado */
            border-radius: 5px; /* Bordes redondeados */
            margin-left: 10px; /* Espaciado entre botones */
        }
        .progress-container {
            width: 100%;
            background-color: #f3f3f3;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
        .progress-bar {
            height: 20px;
            background-color: #4CAF50;
            text-align: center;
            color: white;
            width: 0%; /* Inicia en 0 */
        }

        /* Estilos de botones de acción */
        .download-button, .rename-button, .delete-button {
            margin: 0 5px; /* Espaciado entre botones */
            padding: 5px 10px; /* Relleno del botón */
            background-color: #28a745; /* Color verde */
            color: white; /* Color del texto */
            text-decoration: none; /* Sin subrayado */
            border-radius: 5px; /* Bordes redondeados */
        }
        .download-button:hover, .rename-button:hover, .delete-button:hover {
            background-color: #218838; /* Color más oscuro al pasar el mouse */
        }

        /* Estilo del botón de subir archivo */
        input[type="submit"] {
            background-color: #007bff; /* Color azul */
            color: white; /* Color del texto */
            padding: 10px 15px; /* Relleno del botón */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cambia el cursor al pasar el mouse */
        }
        input[type="submit"]:hover {
            background-color: #0056b3; /* Color más oscuro al pasar el mouse */
        }
    </style>
    <script>
        function uploadFile(event) {
            event.preventDefault();
            var fileInput = document.getElementById("fileToUpload");
            var formData = new FormData();
            formData.append("fileToUpload", fileInput.files[0]);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "upload.php?dir=<?php echo isset($_GET['dir']) ? urlencode($_GET['dir']) : 'uploads'; ?>", true);

            xhr.upload.addEventListener("progress", function(e) {
                if (e.lengthComputable) {
                    var percentComplete = (e.loaded / e.total) * 100;
                    document.getElementById("progress-bar").style.width = percentComplete + "%";
                    document.getElementById("progress-bar").innerText = Math.round(percentComplete) + "%";
                }
            });

            xhr.onload = function() {
                if (xhr.status === 200) {
                    alert("Archivo subido con éxito");
                    window.location.reload();
                } else {
                    alert("Error al subir el archivo");
                }
            };

            xhr.send(formData);
        }
    </script>
</head>
<body>
    <h1>Subir un Archivo</h1>
    <form onsubmit="uploadFile(event)">
        <input type="file" name="fileToUpload" id="fileToUpload" required>
        <input type="submit" value="Subir archivo" name="submit">
    </form>
    <div class="progress-container">
        <div id="progress-bar" class="progress-bar">0%</div>
    </div>

    <h2>Archivos Subidos</h2>
    <a href="?dir=<?php echo dirname($_GET['dir']); ?>" class="retroceder-button">Retroceder</a>
    <a href="logout.php" class="logout-button">Cerrar Sesión</a> <!-- Botón de cerrar sesión -->
    
    <ul>
        <?php include 'list_files.php'; ?>
    </ul>
</body>
</html>
