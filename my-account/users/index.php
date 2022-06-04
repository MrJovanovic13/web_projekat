<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$user = unserialize($_SESSION['userObj']);
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$id = isset($_GET['userId']) ? $_GET['userId'] : "";

if (!isset($_SESSION['userObj']))
{
    header("Location: ../../login"); 
    die();
} else {
    if($action=='deleteUser'){
        $q = "DELETE FROM `users` WHERE `id`=".$id;
        $result = $database->executeQuery($q);
    }
    if ($user->userLevel==0){
        header("Location: ../account-info/");
    } else {
        $users = array();
        $highlightCounter = 0;
        $q = "SELECT `id`, `name`, `email`
        FROM `users`";

        $result = $database->executeQuery($q);
        while ($row = $result->fetch_assoc()) {
            $userObj = new User($row['id'], $row['name'], $row['email']);
            $users[] = $userObj;
        }
        include("../view/users.php");
    }
}
?>