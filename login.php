<?php
session_start();

// Redirigir al usuario si ya ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit;
}

// Definir usuarios y contraseñas válidos
$usuarios_validos = [
    'adrian' => 'Virgo',
    'usuario2' => 'contraseña2',
    'deepweb' => '12',
    'utphacker' => '12',
    '12' => '12'
];

// Manejar el envío del formulario
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    // Validar credenciales
    if (isset($usuarios_validos[$usuario]) && $usuarios_validos[$usuario] === $contraseña) {
        $_SESSION['loggedin'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Consola</title>
    <style>
        /* Estilos mínimos para que w3m pueda leerlo */
        body {
            font-family: "Courier New", Courier, monospace;
            background-color: #0a0a0a;
            color: #00FF00;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }
        .console-container {
            background-color: #1e1e1e;
            padding: 20px;
            border: 1px solid #00FF00;
            width: 400px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 0 10px #00FF00;
            position: relative;
            z-index: 10;
        }
        h2 {
            font-size: 2rem;
            color: #FF6347;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        .error {
            color: #FF6347;
            font-weight: bold;
            margin-bottom: 10px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            color: #00FF00;
            font-size: 1.1rem;
            margin-bottom: 5px;
        }
        input {
            padding: 8px;
            font-size: 1rem;
            background-color: #333;
            color: #00FF00;
            border: 1px solid #00FF00;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            font-size: 1rem;
            background-color: #444;
            color: #00FF00;
            border: 1px solid #00FF00;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<div class="console-container">
    <h2>Console Login</h2>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    
    <form method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" name="contraseña" id="contraseña" required>
        
        <button type="submit">Iniciar sesión</button>
    </form>
</div>

</body>
</html>