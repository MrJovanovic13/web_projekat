<?php
require_once "../controller/user.php";
require_once "../controller/cartL.php";
require_once "../connection/connection.php";

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
session_start();

if ($action == 'checkout') {
    if (isset($_SESSION['userObj'])) {

        $date_info = getdate();
        $year = $date_info['year'];
        $month = $date_info['mon'];
        $day = $date_info['wday'];

        $date = $year . "-" . $month . "-" . $day;
        $user = unserialize($_SESSION['userObj']);
        $user_id = $user->id;

        $q = "INSERT INTO `orders`(`date`,`user_id`) 
        VALUES ('$date', '$user_id')";

        $result = $conn->query($q);
        $order_id = $conn->insert_id;

        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            $product_id = $_SESSION['cart'][$i]->id;
            $quantity = $_SESSION['cart'][$i]->quantity;

            $q = "INSERT INTO `items`(`order_id`,`product_id`,`amount`) 
                VALUES ('$order_id', '$product_id', '$quantity')";
            $result = $conn->query($q);
        }
        unset($_SESSION['cart']);
        
        header("Location: orders/");
    } else {
        header("Location: ../login/");
    }
} else {
    if (isset($_SESSION['userObj'])){
        header("Location: dashboard/");
    } else {
        header("Location: ../login/");
    }
}
