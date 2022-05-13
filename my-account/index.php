<?php
require_once "../connection/connection.php";

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
session_start();

if(isset($_SESSION['userObj'])){
    if($action=='checkout') {
        


    }
    header("Location: orders/");
} else {
    header("Location: ../login/");
}


?>