<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$orders = array();
$database = new Database();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$counter = 0;
$orderCounter = 0;
$pageCounter = 1;
$i = 1;
$currentPageUser = isset($_POST['page']) ? $_POST['page'] : "1";

function returnOrdersFromPage($page, $arrayOfOrders)
{
    $orders = array();
    foreach ($arrayOfOrders as $order) {
        if ($order->page == $page) {
            $orders[] = $order;
        }
    }
    return $orders;
}

if ($action == 'removeOrder') {
    $q = "DELETE FROM `items` WHERE `order_id`=" . $_GET['orderId'];
    $result = $database->executeQuery($q);
    $q = "DELETE FROM `order_status` WHERE `order_id`=" . $_GET['orderId'];
    $result = $database->executeQuery($q);
    $q = "DELETE FROM `orders` WHERE `id`=" . $_GET['orderId'];
    $result = $database->executeQuery($q);
}

$orderTotal = 0;

$user = unserialize($_SESSION['userObj']);
if ($user->userLevel == 0) {

    $q = "SELECT `id`, `date`, `user_id`
            FROM `orders`
            WHERE `user_id`=" . $user->id;

    $result = $database->executeQuery($q);
    $order_total = 0;

    while ($row = $result->fetch_assoc()) {

        $q1 = "SELECT `product_id`, `amount`
            FROM `items`
            WHERE `order_id`=" . $row['id'];
        $result1 = $database->executeQuery($q1);
        while ($row1 = $result1->fetch_assoc()) {
            $q2 = "SELECT `price` 
                FROM `products`
                WHERE `products`.`id`=" . $row1['product_id'];
            $result2 = $database->executeQuery($q2);
            while ($row2 = $result2->fetch_assoc()) {
                $orderTotal += $row2['price'] * $row1['amount'];
            }
        }

        $q3 = "SELECT `date`,`time`, `status`.`name` FROM `order_status` 
            INNER JOIN `status` ON `order_status`.`status_id` = `status`.`id`
            WHERE `order_status`.`order_id`=" . $row['id'] . "
            ORDER BY `date` DESC, `time` DESC";

        $result3 = $database->executeQuery($q3);
        $row3 = $result3->fetch_assoc();

        $orderObj = new AdminMenuOrder($row['id'], $row['date'], $orderTotal, $row3['name'], $row['user_id'], $pageCounter);
        $orderTotal = 0;
        $orders[] = $orderObj;
        if (!$orderCounter++ == 0 && $orderCounter % 8 == 0) {
            $orderCounter++;
        }
    }

    include("../view/orders-user.php");
} else {

    $q = "SELECT `id`, `date`, `user_id`
        FROM `orders`";

    $result = $database->executeQuery($q);

    while ($row = $result->fetch_assoc()) {

        $q1 = "SELECT `product_id`, `amount`
            FROM `items`
            WHERE `order_id`=" . $row['id'];
        $result1 = $database->executeQuery($q1);
        while ($row1 = $result1->fetch_assoc()) {
            $q2 = "SELECT `price` 
                FROM `products`
                WHERE `products`.`id`=" . $row1['product_id'];
            $result2 = $database->executeQuery($q2);
            while ($row2 = $result2->fetch_assoc()) {
                $orderTotal += $row2['price'] * $row1['amount'];
            }
        }

        $q3 = "SELECT `date`,`time`, `status`.`name` FROM `order_status` 
            INNER JOIN `status` ON `order_status`.`status_id` = `status`.`id`
            WHERE `order_status`.`order_id`=" . $row['id'] . "
            ORDER BY `date` DESC, `time` DESC";

        $result3 = $database->executeQuery($q3);
        $row3 = $result3->fetch_assoc();

        $orderObj = new AdminMenuOrder($row['id'], $row['date'], $orderTotal, $row3['name'], $row['user_id'], $pageCounter);
        $orderTotal = 0;
        $orders[] = $orderObj;
        if (!$orderCounter++ == 0 && $orderCounter % 8 == 0) {
            $pageCounter++;
        }
    }
    include("../view/orders.php");
}
