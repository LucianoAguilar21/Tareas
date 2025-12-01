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

$id = $_POST["id"];

$taskModel->delete($id, $_SESSION["user_id"]);

header("Location: tasks.php");
exit;
