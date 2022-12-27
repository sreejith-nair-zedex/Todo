<?php
session_start();

require_once "../Models/User.db.php";
$user = new User();

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $row = $user->getUserByEmail($email);

    if ($row["email"] == $email) {
        if ($row["password"] == $password) {
            $_SESSION["username"] = $row["username"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["id"] = $row["id"];

            header("Location:../task.php");
        } else {
            echo "INVALID PASSWORD";
        }
    } else {
        echo "INVALID EMAIL!";
    }
}
