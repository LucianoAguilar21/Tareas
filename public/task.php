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
$taskModel = new Task($db);

if (!isset($_GET["id"])) {
    echo "Tarea no encontrada";
    exit;
}

$task = $taskModel->getById($_GET["id"], $_SESSION["user_id"]);

if (!$task) {
    echo "No tienes permiso para ver esta tarea.";
    exit;
}
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detalle de Tarea</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">
    <div class="max-w-xl w-full bg-white shadow-lg rounded-xl p-6">
       

        <h1 class="text-2xl font-bold text-gray-800 mb-4">Detalle de la Tarea</h1>

        <?php if(isset($task)): ?>
            <div class="space-y-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Título:</h2>
                    <p class="text-gray-900 text-lg"><?= htmlspecialchars($task['title']); ?></p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-700">Descripción:</h2>
                    <p class="text-gray-700 whitespace-pre-line">
                        <?= nl2br(htmlspecialchars($task['description'])); ?>
                    </p>
                </div>

                <div class="flex items-center space-x-2">
                    <h2 class="text-xl font-semibold text-gray-700">Estado:</h2>
                    <span class="px-3 py-1 text-sm rounded-full
                        <?= $task['status'] === 'Completado' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800'; ?>">
                        <?= $task['status']; ?>
                    </span>
                </div>

                <!-- Botones -->
                <div class="flex gap-3 mt-6">
                    <a href="edit_task.php?id=<?= $task['id']; ?>" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                        Editar
                    </a>

                  

                    <form method="POST" action="task_status.php">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <select name="status" class="border p-2">
                            <option value="Pendiente" <?= $task['status']=='Pendiente'?'selected':'' ?>>Pendiente</option>
                            <option value="Completado" <?= $task['status']=='Completado'?'selected':'' ?>>Completado</option>
                        </select>
                        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">Cambiar estado</button>
                    </form>

                    <form action="task_delete.php" method="POST"  onsubmit="return confirm('¿Eliminar tarea?');">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">

                        <button 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">                       
                            Eliminar
                        </button>
                    </form>
                </div>

                <a href="tasks.php" class="block mt-6 text-blue-600 hover:underline">← Volver a mis tareas</a>
            </div>
        <?php else: ?>
            <p class="text-red-600">La tarea no existe o no tienes permiso para verla.</p>
        <?php endif; ?>
    </div>
</body>
</html>
