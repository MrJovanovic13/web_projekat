<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$deleteErr;

if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {

            $ticketId = $_GET['ticketId'];
            if(isset($_GET['errorMessageFlag'])) {
                $errorMessageFlag = $_GET['errorMessageFlag'];
                $messageErr = "Message cannot be empty!";
            }

            $sideCounter = 0;

            $q = "SELECT `id`, `name`, `is_open`
                FROM `tickets` 
                WHERE `id`=" . $ticketId;
            $result = $database->executeQuery($q);
            $row = $result->fetch_assoc();
            $ticket = new Ticket($row['id'], $row['name'], $row['is_open']);
            $messages = array();
            $q1 = "SELECT `user_id`, `date_time`, `message_content`
                FROM `message`
                WHERE `ticket_id`=". $ticketId;
            $result1 = $database->executeQuery($q1);
            
            while ($row1 = $result1->fetch_assoc()) {

                $q2 = "SELECT `name`, `user_level`
                FROM `users`
                WHERE `id`=". $row1['user_id'];
                $result2 = $database->executeQuery($q2);
                $row2 = $result2->fetch_assoc();

                $time = strtotime($row1['date_time']);
                $timeFormatted = date("m/d/y g:i A", $time);
                $messages[] = new Message($row2['name'], $row1['message_content'],$timeFormatted,$row2['user_level']);
            }

            include("../view/edit-ticket.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (empty($_POST['messageContent'])) {
            $errorMessageFlag = 1;
        } else {
            $errorMessageFlag = 0;
            $messageContent = test_input($_POST['messageContent']);
        }
        $date = date('Y-m-d H:i:s');
        $userId = $_POST['userId'];
        $ticketId = $_POST['ticketId'];

        if (isset($messageErr)) {
            include("../view/edit-ticket.php");
        } else {
            $q = "INSERT INTO `message`(`user_id`,`message_content`,`date_time`,`ticket_id`) 
            VALUES ('$userId','$messageContent','$date','$ticketId')";
            $result = $database->executeQuery($q);
        }
        
        header("Location: ../edit-ticket/?ticketId=".$ticketId."&errorMessageFlag=".$errorMessageFlag);
    }
} else {
    header("Location: ../../login/");
}
