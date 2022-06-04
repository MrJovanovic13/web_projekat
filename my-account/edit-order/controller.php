<?php
require "../../vendor/autoload.php";
$database = new Database();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $date_info = getdate();
    $year = $date_info['year'];
    $month = $date_info['mon'];
    $day = $date_info['mday'];

    $date = $year . "-" . $month . "-" . $day;
    $time = date('H:i:s', time());

    $orderId = isset($_POST['orderId']) ? $_POST['orderId'] : "";
    $orderStatus = isset($_POST['orderStatus']) ? $_POST['orderStatus'] : "";

    $q = "INSERT INTO `order_status`(`date`,`time`,`order_id`,`status_id`) 
        VALUES ('$date', '$time', '$orderId', '$orderStatus')";

    $result = $database->executeQuery($q);
    header("Location: ../orders");
}
