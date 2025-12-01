<?php
session_start();

require "../vendor/autoload.php";


use App\Config\Database;
use App\Controllers\AuthController;

$db = (new Database)->connect();
$auth = new AuthController($db);

if ($_POST) {
    if ($auth->login($_POST["email"], $_POST["password"])) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Credenciales incorrectas";
    }
}
?>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ToDo App</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Login</h1>
        <form method="POST" class="space-y-4">
            <input name="email" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300" placeholder="Email" />
            <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300" placeholder="Contraseña" />
            <button class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">Ingresar</button>
        </form>
        <p class="text-center mt-4 text-sm">¿No tienes cuenta? <a href="register.php" class="text-indigo-600">Registrarse</a></p>
    </div>
</body>

</html>
<?= isset($error) ? $error : "" ?>