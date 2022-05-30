<?php
require_once "../../connection/connection.php";
require_once "../../controller/user.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($_SERVER['REQUEST_METHOD']=="GET"){
    if($action=='removeOrder'){
        $q = "DELETE FROM `items` WHERE `order_id`=".$_GET['orderId'];
        $result = $conn->query($q);
        $q = "DELETE FROM `order_status` WHERE `order_id`=".$_GET['orderId'];
        $result = $conn->query($q);
        $q = "DELETE FROM `orders` WHERE `id`=".$_GET['orderId'];
        $result = $conn->query($q);
    }

    $user = unserialize($_SESSION['userObj']);
    if ($user->user_level==0){
        include("../view/orders-user.php");
    } else {
        include("../view/orders.php");
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

} else {
    include("../view/orders.php");
    die();
}
