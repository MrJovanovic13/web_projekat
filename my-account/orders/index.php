<?php
require_once "../../connection/connection.php";
require_once "../../controller/user.php";
require_once "../../controller/order.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($action == 'removeOrder') {
        $q = "DELETE FROM `items` WHERE `order_id`=" . $_GET['orderId'];
        $result = $conn->query($q);
        $q = "DELETE FROM `order_status` WHERE `order_id`=" . $_GET['orderId'];
        $result = $conn->query($q);
        $q = "DELETE FROM `orders` WHERE `id`=" . $_GET['orderId'];
        $result = $conn->query($q);
    }

    $highlightCounter = 0;
    $orderTotal = 0;

    $user = unserialize($_SESSION['userObj']);
    if ($user->user_level == 0) {

        $q = "SELECT `id`, `date`, `user_id`
            FROM `orders`
            WHERE `user_id`=" . $user->id;

        $result = $conn->query($q);
        $order_total = 0;

        while ($row = $result->fetch_assoc()) {

            $q1 = "SELECT `product_id`, `amount`
            FROM `items`
            WHERE `order_id`=" . $row['id'];
            $result1 = $conn->query($q1);
            while ($row1 = $result1->fetch_assoc()) {
                $q2 = "SELECT `price` 
                FROM `products`
                WHERE `products`.`id`=" . $row1['product_id'];
                $result2 = $conn->query($q2);
                while ($row2 = $result2->fetch_assoc()) {
                    $orderTotal += $row2['price'] * $row1['amount'];
                }
            }

            $q3 = "SELECT `date`,`time`, `status`.`name` FROM `order_status` 
            INNER JOIN `status` ON `order_status`.`status_id` = `status`.`id`
            WHERE `order_status`.`order_id`=" . $row['id'] . "
            ORDER BY `date` DESC, `time` DESC";

            $result3 = $conn->query($q3);
            $row3 = $result3->fetch_assoc();

            $orderObj = new Order($row['id'], $row['date'], $orderTotal, $row3['name'], $row['user_id']);
            $orderTotal = 0;
            $orders[] = $orderObj;
        }

        include("../view/orders-user.php");
    } else {

        $q = "SELECT `id`, `date`, `user_id`
        FROM `orders`";

        $result = $conn->query($q);
        $orders = array();

        while ($row = $result->fetch_assoc()) {

            $q1 = "SELECT `product_id`, `amount`
            FROM `items`
            WHERE `order_id`=" . $row['id'];
            $result1 = $conn->query($q1);
            while ($row1 = $result1->fetch_assoc()) {
                $q2 = "SELECT `price` 
                FROM `products`
                WHERE `products`.`id`=" . $row1['product_id'];
                $result2 = $conn->query($q2);
                while ($row2 = $result2->fetch_assoc()) {
                    $orderTotal += $row2['price'] * $row1['amount'];
                }
            }

            $q3 = "SELECT `date`,`time`, `status`.`name` FROM `order_status` 
            INNER JOIN `status` ON `order_status`.`status_id` = `status`.`id`
            WHERE `order_status`.`order_id`=" . $row['id'] . "
            ORDER BY `date` DESC, `time` DESC";

            $result3 = $conn->query($q3);
            $row3 = $result3->fetch_assoc();

            $orderObj = new Order($row['id'], $row['date'], $orderTotal, $row3['name'], $row['user_id']);
            $orderTotal = 0;
            $orders[] = $orderObj;
        }
        include("../view/orders.php");
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
} else {
    include("../view/orders.php");
    die();
}
