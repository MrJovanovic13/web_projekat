<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$logController = new LogController();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $date_info = getdate();
    $year = $date_info['year'];
    $month = $date_info['mon'];
    $day = $date_info['mday'];

    $date = $year . "-" . $month . "-" . $day;
    $time = date('H:i:s', time());

    $orderId = isset($_POST['orderId']) ? $_POST['orderId'] : "";
    $orderStatus = isset($_POST['orderStatus']) ? $_POST['orderStatus'] : "";

    $q = "SELECT `status_id` FROM `order_status` WHERE `order_id`=? ORDER BY `date` DESC, `time` DESC LIMIT 1 ";
    $stmt = $database->prepareQuery($q);
    $stmt->bind_param('i', $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($row['status_id'] != $orderStatus) {
        $q = "INSERT INTO `order_status`(`date`,`time`,`order_id`,`status_id`) 
        VALUES ('$date', '$time', '$orderId', '$orderStatus')";

        $result = $database->executeQuery($q);
        $message = "Succesfully edited order with ID:" . $orderId;
        $logController->log($message);
    }

    header("Location: ../orders");
}
