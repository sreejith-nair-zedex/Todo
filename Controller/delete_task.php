<?php
require_once "../Models/Task.db.php";
session_start();
$tid = $_GET["tid"];
$task = new Task();
$task->daleteTask($tid);
header("Location:../task.php");