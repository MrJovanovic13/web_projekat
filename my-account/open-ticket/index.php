<?php
require_once "../../connection/connection.php";
require_once "../../controller/message.php";
require_once "../../controller/ticket.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$deleteErr;


if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        include("../view/open-ticket.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }


        if (empty($_POST['title'])) {
            $titleErr = "Title cannot be empty!";
        } else {
            $title = test_input($_POST['title']);
        }

        if (empty($_POST['messageContent'])) {
            $messageErr = "Message cannot be empty!";
        } else {
            $messageContent = test_input($_POST['messageContent']);
        }

        if (isset($messageErr)||isset($titleErr)) {
            include_once('../view/open-ticket.php');
        } else {
            $date = date('Y-m-d H:i:s');
            $userId = $_POST['userId'];

            $q = "INSERT INTO `tickets`(`name`,`user_sender`,`is_open`) 
            VALUES ('$title','$userId','1')";
            $conn->query($q);
            $ticketId = $conn->insert_id;

            $q = "INSERT INTO `message`(`user_id`,`message_content`,`date_time`,`ticket_id`) 
                            VALUES ('$userId','$messageContent','$date','$ticketId')";
            $conn->query($q);
            header("Location: ../tickets/");
        }
    }
} else {
    header("Location: ../../login/");
}
