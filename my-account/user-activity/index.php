<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$database = new Database();
$logController = new LogController();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$deleteErr;
$user = unserialize($_SESSION['userObj']);
$userLevel = $user->userLevel;
$userId = isset($_REQUEST["userId"]) ? $_REQUEST["userId"] : "";
$activitiesOrders = array();
$activitiesTickets = array();


if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        $q = "SELECT `orders`.`date`,`orders`.`id` FROM `orders` WHERE `user_id`=? ORDER BY `date` ASC";

        $stmt = $database->prepareQuery($q);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $activityObj = new Activity("User placed new order with ID:" . $row['id'], $row['date']);
            $activitiesOrders[] = $activityObj;
        }

        $q = "SELECT `tickets`.`id`, `name`, `is_open`, `message`.`date_time`
        FROM `tickets`
        LEFT JOIN message ON `tickets`.`id` = `message`.`ticket_id`
        WHERE `user_sender`=? GROUP BY `tickets`.`id` ORDER BY `date_time` ASC ";
        $stmt = $database->prepareQuery($q);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $activityObj = new Activity("User opened ticket with ID:" . $row['id'], $row['date_time']);
            $activitiesTickets[] = $activityObj;
        }

        include("../view/user-activity.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        header("Location: ../user-activity.php/");
    }
} else {
    header("Location: ../../login/");
}
