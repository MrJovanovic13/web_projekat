<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../../connection/connection.php";
require_once "../../controller/user.php";
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
        $result = $conn->query($q);
    }
    if ($user->user_level==0){
        header("Location: ../account-info/");
    } else {
        $users = array();
        $highlightCounter = 0;
        $q = "SELECT `id`, `name`, `email`
        FROM `users`";

        $result = $conn->query($q);
        while ($row = $result->fetch_assoc()) {
            $userObj = new LightUser($row['id'], $row['name'], $row['email']);
            $users[] = $userObj;
        }
        include("../view/users.php");
    }
}
?>