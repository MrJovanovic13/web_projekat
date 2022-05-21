<?php
require_once "../../connection/connection.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$id = isset($_GET['userId']) ? $_GET['userId'] : "";

if (!isset($_SESSION['userObj']))
{
    header("Location: ../../login"); 
    die();
} else {
    if($action=='deleteUser'){
        $q = "DELETE FROM `users` WHERE `id`=".$id;
        $result = $conn->query($q);
    }
    include("../view/users.php");
}
?>