<?php
session_start();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    include("../view/registration.php");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['pass'];
        header("Location: ../view/registration.php");
        

} else {
    header("Location: 404.php");
    die();
}
?>