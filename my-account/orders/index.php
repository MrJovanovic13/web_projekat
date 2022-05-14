<?php
require_once "../../connection/connection.php";
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($_SERVER['REQUEST_METHOD']=="GET"){
    if($action=='removeOrder'){
        $q = "DELETE FROM `items` WHERE `order_id`=".$_GET['itemId'];
        $result = $conn->query($q);
        $q = "DELETE FROM `orders` WHERE `id`=".$_GET['itemId'];
        $result = $conn->query($q);
    }
    include("../view/orders.php");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

} else {
    include("../view/orders.php");
    die();
}
