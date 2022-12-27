<?php
require_once "../Models/User.db.php";
$user = new User();
if (isset($_POST["usertodb"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $user->register($username, $email, $password);
    header("location:../index.php");
}
