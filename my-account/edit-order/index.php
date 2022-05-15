<?php
require_once "../../connection/connection.php";
require_once "../../controller/user.php";
require_once "../../controller/cartL.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = isset($_GET['userId']) ? $_GET['userId'] : "";
$order_id = isset($_GET['orderId']) ? $_GET['orderId'] : "";

if (!isset($_SESSION['userObj']))
{
    header("Location: ../../login"); 
    die();
} else {
    $q = "SELECT `id`, `name`, `surname`, `email`, `username`, `password`, `phone_number`, `address`, `location`, `user_level`, `postcode`, `dob`
            FROM `users`
            WHERE `id`=".$id;
    $result = $conn->query($q);
    $row = $result->fetch_assoc();

    $orderUser = new LoggedUser($row['id'], $row['name'], $row['surname'], $row['email'], $row['username'], $row['password'],$row['phone_number'], $row['address'], $row['location'], $row['user_level'], $row['postcode'], $row['dob']);
    $_SESSION['orderUser'] = serialize($orderUser);

    $q = "SELECT `product_id`, `amount`
            FROM `items`
            WHERE `order_id`=".$order_id;
    $result = $conn->query($q);

    $orderCart = array();
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $orderCart[$i] = new CartL($row['product_id'], $row['amount']);
        $i++;
    }

    $_SESSION['orderCart'] = serialize($orderCart);

    include("../view/edit-order.php");
}
?>