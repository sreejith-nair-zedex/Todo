<?php
session_start();
require_once "../Models/Task.db.php";
$task = new Task();
if (isset($_POST["addtasktodb"])) {
    $taskName = $_POST["taskName"];
    $userId = (int)$_SESSION["id"];
    // $status = false;

    $task->add_task($taskName, $userId, 0);

    header("Location:../task.php");
}
