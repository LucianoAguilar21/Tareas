<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

require "../vendor/autoload.php";


use App\Config\Database;
use App\Models\Task;

$db = (new Database)->connect();
$task = new Task($db);

if ($_POST) {
    $task->create($_SESSION["user_id"], $_POST["title"], $_POST["description"]);
}

$tasks = $task->getTasksByUser($_SESSION["user_id"]);
?>

<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Mis tareas</title>
</head>

<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow-md rounded-2xl p-6 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Mis Tareas</h1>
            <a href="index.php" class="text-indigo-600 hover:underline">Volver</a>
        </div>


        <div class="bg-white shadow-md rounded-2xl mt-6 p-6">
            <h2 class="text-xl font-semibold mb-4">Crear nueva tarea</h2>
            <form method="POST" class="grid gap-4">
                <input name="title" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300" placeholder="Título" />
                <textarea name="description" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300" placeholder="Descripción"></textarea>
                <button class="bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">Agregar tarea</button>
            </form>
        </div>


        <div class="mt-6 bg-white shadow-md rounded-2xl p-6">
            <h2 class="text-xl font-semibold mb-4">Lista de tareas</h2>
            <hr>

            <ul class="space-y-3">
         

                <?php foreach ($tasks as $t): ?>
                    <li>
                        <p class="font-semibold" href="task.php?id=<?= $t['id'] ?>">
                            <strong><?= $t["title"] ?></strong>
                        </p>

                         
                         <p class="text-sm text-gray-600">Estado: <?= $t["status"] ?></p>
                         <a href="task.php?id=<?= $t['id']?>" class="text-indigo-600 hover:underline">Ver</a>
                    </li>
                    <hr>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>

</html>