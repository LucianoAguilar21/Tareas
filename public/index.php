<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
?>
<html lang="es">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
</head>

<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-2xl p-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            <h4>Hola <?= $_SESSION['user_name'] ?></h4>
            <a href="logout.php" class="text-red-600 hover:underline">Cerrar sesión</a>
        </div>


        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="tasks.php" class="bg-white shadow rounded-xl p-6 hover:shadow-lg transition block">
                <h2 class="text-xl font-semibold">Mis Tareas</h2>
                <p class="text-gray-600">Ver, crear y gestionar tus tareas.</p>
            </a>
        </div>
    </div>
</body>

</html>