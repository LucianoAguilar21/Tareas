<?php
session_start();
require "../vendor/autoload.php";

use App\Config\Database;
use App\Controllers\AuthController;

$db = (new Database)->connect();
$auth = new AuthController($db);

$success = null;
$error = null;

if ($_POST) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if ($auth->register($name, $email, $password)) {
        $success = "Usuario registrado correctamente.";
    } else {
        $error = "Error al registrar usuario (¿email repetido?).";
    }
}
?>


<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registro</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Registro</h1>
        <?php if ($success): ?>
            <p style="color: green"><?= $success ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p style="color: red"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" class="space-y-4">
            <input name="name" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300" placeholder="Nombre completo" />
            <input name="email" type="email" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300" placeholder="Email" />
            <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300" placeholder="Contraseña" />
            <button class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">Registrarse</button>
        </form>
        <p class="text-center mt-4 text-sm">¿Ya tienes cuenta? <a href="login.php" class="text-indigo-600">Iniciar sesión</a></p>
    </div>
</body>

</html>