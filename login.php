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
    'utphacker' => '12',
    'deepweb' => '12',
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
        .globe {
            position: absolute;
            right: 20px;
            bottom: 20px;
            width: 200px;
            height: 200px;
            background: url('https://franzpc.com/apps/globo-terrestre-3d/') no-repeat center center;
            background-size: cover;
            animation: spin 10s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .globe::before {
            content: "HACK THE PLANET";
            position: absolute;
            width: 100%;
            height: 100%;
            font-size: 2rem;
            color: #00FF00;
            text-align: center;
            top: 50%;
            transform: translateY(-50%);
        }
        .code-animation {
            position: absolute;
            left: 20px;
            top: 20px;
            color: #00FF00;
            font-size: 1.2rem;
            white-space: pre-line;
            animation: scroll 10s infinite linear;
        }
        @keyframes scroll {
            from { transform: translateY(0); }
            to { transform: translateY(-100%); }
        }
    </style>
</head>
<body>
    <div class="globe"></div>
    <div class="code-animation">www.webprueba.com
192.168.1.1 - root@access
Brute force attempt...
Connecting to server...
Access denied
</div>
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
