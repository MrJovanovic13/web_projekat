<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../../connection/connection.php";

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$id = isset($_GET['productId']) ? $_GET['productId'] : "";

if (!isset($_SESSION['userObj']))
{
    header("Location: ../../login"); 
    die();
} else {
    if($action=='deleteProduct'){
        $q = "DELETE FROM `products` WHERE `id`=".$id;
        $result = $conn->query($q);
        header("Location: ../products"); 
    } else {
        include("../view/products.php");
    }
}
?>