<?php
require_once "../../connection/connection.php";
require_once "../../controller/user.php";
require_once "../../controller/product.php";
require_once "../../controller/cartL.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$id = isset($_GET['userId']) ? $_GET['userId'] : "";
$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : "";

if (!isset($_SESSION['userObj'])) {
    header("Location: ../../login");
    die();
} else {
    $q = "SELECT `id`, `name`, `surname`, `email`, `username`, `password`, `phone_number`, `address`, `location`, `user_level`, `postcode`, `dob`
            FROM `users`
            WHERE `id`=" . $id;
    $result = $conn->query($q);
    $row = $result->fetch_assoc();

    $orderUser = new LoggedUser($row['id'], $row['name'], $row['surname'], $row['email'], $row['username'], $row['password'], $row['phone_number'], $row['address'], $row['location'], $row['user_level'], $row['postcode'], $row['dob']);

    $q = "SELECT `product_id`, `amount`
            FROM `items`
            WHERE `order_id`=" . $orderId;
    $result = $conn->query($q);

    $orderCart = array();
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $orderCart[$i] = new CartL($row['product_id'], $row['amount']);
        $i++;
    }

    $cartTotal = 0;
    $cartProducts = array();
    $status;

    for ($i = 0; $i < count($orderCart); $i++) {
        if (isset($_SESSION['orderCart'][$i])) {
            $cart_item_id = $orderCart[$i]->id;
            $q = "SELECT `id`, `name`, `price`
                FROM `products`
                WHERE `id`=$cart_item_id";
            $result = $conn->query($q);
            $row = $result->fetch_assoc();

            $productObj = new OrderProduct($row['id'],$row['name'],$row['price'],$orderCart[$i]->quantity);
            $cartProducts[] = $productObj;
            $cartTotal += $row['price'] * $orderCart[$i]->quantity;
        }
        $q3 = "SELECT `status`.`id`,`date`,`time`, `status`.`name` FROM `order_status` 
                INNER JOIN `status` ON `order_status`.`status_id` = `status`.`id`
                WHERE `order_status`.`order_id`=" . $orderId . "
                ORDER BY `date` DESC, `time` DESC";
        $result3 = $conn->query($q3);
        $row3 = $result3->fetch_assoc();
        $status = $row3['name'];
    }
    include("../view/edit-order.php");
}
