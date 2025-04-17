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
    <title>E. TEMAS A EVALUAR:</title>
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
        .retroceder-button, .logout-button {
            margin-bottom: 10px;
            display: inline-block;
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-button {
            background-color: #dc3545;
            margin-left: 10px;
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
            width: 0%;
        }
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E. TEMAS A EVALUAR:</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf7ea;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1 {
            text-align: center;
            font-size: 2rem;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 10px;
        }
        h1 span {
            margin: 0 10px;
        }
        h2 {
            background-color: #dff0d8;
            padding: 15px;
            border-radius: 5px;
            font-size: 1.5rem;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            background: #f0f0f0;
            padding: 10px;
            margin: 5px 0;
            border-left: 5px solid #4CAF50;
            border-radius: 5px;
            font-size: 1.2rem;
        }
        .retroceder-button, .logout-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .logout-button {
            background-color: #dc3545;
        }
        .download-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #28a745; /* Verde */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.download-button:hover {
    background-color: #218838; /* Verde más oscuro */
}

.rename-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #ffc107; /* Amarillo */
    color: #333;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.rename-button:hover {
    background-color: #e0a800; /* Amarillo más oscuro */
}

.delete-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #dc3545; /* Rojo */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.delete-button:hover {
    background-color: #c82333; /* Rojo más oscuro */
}
        .delete-button {
             display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px
        }
        .rename-button {
             display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px
        }
        .retroceder-button:hover, .logout-button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h1>
        <span>😁</span>
        <span>🚀</span>
        <span>🏁</span>
        Evaluación de Temas
        <span>👨‍🎓</span>
        <span>🎒</span>
        <span>🏁</span>
        <span>🚀</span>
    </h1>

    <h2>E. TEMAS A EVALUAR:</h2>
    <h2>Razonamiento y Nivelación de Lenguaje:</h2>
    <ul>
        <li>Referentes</li>
        <li>Significado de una frase</li>
        <li>Interpretación de párrafos</li>
        <li>Ordenamiento de ideas</li>
    </ul>

    <h2>Razonamiento y Nivelación de Matemática:</h2>
    <ul>
        <li>Operaciones con números reales</li>
        <li>Leyes y teoría de exponentes</li>
        <li>Razonamiento geométrico</li>
        <li>Términos algebraicos y polinomios</li>
        <li>Productos notables</li>
        <li>División algebraica</li>
        <li>Factorización</li>
        <li>Ecuaciones</li>
    </ul>
    </h2>
    <a href="?dir=<?php echo dirname($_GET['dir']); ?>" class="retroceder-button">Retroceder</a>
    <a href="logout.php" class="logout-button">Cerrar Sesión</a>
    <ul>
        <?php include 'list_files.php'; ?>
    </ul>
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
</body>
</html>
