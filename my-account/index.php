<?php
require "../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$database = new Database();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";


if ($action == 'checkout') {
    if (isset($_SESSION['userObj'])) {

        $date_info = getdate();
        $year = $date_info['year'];
        $month = $date_info['mon'];
        $day = $date_info['mday'];

        $date = $year . "-" . $month . "-" . $day;
        $user = unserialize($_SESSION['userObj']);
        $user_id = $user->id;

        $q = "INSERT INTO `orders`(`date`,`user_id`) 
        VALUES ('$date', '$user_id')";

        $result = $database->executeQuery($q);
        $order_id = $database->lastInsertedId();

        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            $product_id = $_SESSION['cart'][$i]->id;
            $quantity = $_SESSION['cart'][$i]->quantity;

            $q = "INSERT INTO `items`(`order_id`,`product_id`,`amount`) 
                VALUES ('$order_id', '$product_id', '$quantity')";
            $result = $database->executeQuery($q);
        }

        $time = date('H:i:s', time());
        $q = "INSERT INTO `order_status`(`date`,`time`,`order_id`,`status_id`) 
        VALUES ('$date', '$time','$order_id',1)";
        $result = $database->executeQuery($q);

        unset($_SESSION['cart']);
    
        header("Location: orders/");
    } else {
        header("Location: ../login/");
    }
} else {
    if (isset($_SESSION['userObj'])){
        header("Location: orders/");
    } else {
        header("Location: ../login/");
    }
}
