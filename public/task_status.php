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
$status = $_POST["status"];

$taskModel->updateStatus($id, $status, $_SESSION["user_id"]);

header("Location: task.php?id=$id");
exit;
