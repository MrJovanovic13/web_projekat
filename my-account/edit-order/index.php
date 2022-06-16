<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$id = isset($_GET['userId']) ? $_GET['userId'] : "";
$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : "";

if (!isset($_SESSION['userObj'])) {
    header("Location: ../../login");
    die();
} else {

    $orderCart = array();
    $cartTotal = 0;
    $cartProducts = array();
    $orderStatus;
    $orderStatusList = array();
    $orderStatusHistory = array();

    $q = "SELECT `id`, `name`, `surname`, `email`, `username`, `password`, `phone_number`, `address`, `location`, `user_level`, `postcode`, `dob`
            FROM `users`
            WHERE `id`=" . $id;
    $result = $database->executeQuery($q);
    $row = $result->fetch_assoc();

    $orderUser = new LoggedUser($row['id'], $row['name'], $row['surname'], $row['email'], $row['username'], $row['password'], $row['phone_number'], $row['address'], $row['location'], $row['user_level'], $row['postcode'], $row['dob']);

    $q = "SELECT `product_id`, `amount`
            FROM `items`
            WHERE `order_id`=" . $orderId;
    $result = $database->executeQuery($q);

    
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $orderCart[] = new CartL($row['product_id'], $row['amount']);
        $i++;
    }

    for ($i = 0; $i < count($orderCart); $i++) {
        $cartItemId = $orderCart[$i]->id;
        $q = "SELECT `id`, `name`, `price`
                FROM `products`
                WHERE `id`=$cartItemId";
        $result = $database->executeQuery($q);
        $row = $result->fetch_assoc();

        $productObj = new OrderProduct($row['id'], $row['name'], $row['price'], $orderCart[$i]->quantity);
        $cartProducts[] = $productObj;

        $cartTotal += $row['price'] * $orderCart[$i]->quantity;
        $q3 = "SELECT `status`.`id`,`date`,`time`, `status`.`name` FROM `order_status` 
                INNER JOIN `status` ON `order_status`.`status_id` = `status`.`id`
                WHERE `order_status`.`order_id`=" . $orderId . "
                ORDER BY `date` DESC, `time` DESC";
        $result3 = $database->executeQuery($q3);
        $row3 = $result3->fetch_assoc();
        $orderStatus = $row3['name'];
    }

    $q = "SELECT `id`, `name` 
    FROM `status`";

    $result = $database->executeQuery($q);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orderStatusList[] = new OrderStatus($row['id'], $row['name']);
        }
    }

    $q = "SELECT `status`.`name`, `order_status`.`date`, `order_status`.`time`
    FROM `order_status`
    LEFT JOIN status
    ON `order_status`.`status_id` = `status`.`id`
    WHERE `order_status`.`order_id`=?
    ORDER BY `date` ASC, `time` ASC";

    $stmt = $database->prepareQuery($q);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $phpdate = strtotime( $row['date'] . $row['time'] );
            $datetime = date( 'Y-m-d H:i:s', $phpdate );

            $orderStatusHistory[] = new OrderStatusHistory($row['name'],$datetime);
        }
    }
    include("../view/edit-order.php");
}
