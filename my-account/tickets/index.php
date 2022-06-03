<?php
require_once "../../connection/connection.php";
require_once "../../controller/message.php";
require_once "../../controller/ticket.php";
require_once "../../controller/user.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$deleteErr;
$user = unserialize($_SESSION['userObj']);
$userLevel = $user->userLevel;


if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $tickets = array();
        if ($userLevel == 0) {
            $q = "SELECT `id`, `name`, `is_open`
            FROM `tickets`
            WHERE `user_sender`=" . $user->id;
        } else {
            $q = "SELECT `id`, `name`, `is_open`
            FROM `tickets`";
        }
        $result = $conn->query($q);
        while ($row = $result->fetch_assoc()) {
            $tickets[] = new Ticket($row['id'], $row['name'], $row['is_open']);
        }

        include("../view/tickets.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        $q = "UPDATE `tickets` SET `is_open` = '0'
        WHERE `id` =" . $_POST['ticketId'];
        $conn->query($q);
        header("Location: ../tickets/");
    }
} else {
    header("Location: ../../login/");
}
