<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$logController = new LogController();

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$id = isset($_GET['userId']) ? $_GET['userId'] : $_POST['userId'];

if (!isset($_SESSION['userObj'])) {
    header("Location: ../../login");
    die();
} else {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if ($action == 'editUser') {
            $q = "SELECT `id`, `name`, `surname`, `email`, `username`, `password`, `phone_number`, `address`, `location`, `user_level`, `postcode`, `dob`
            FROM `users`
            WHERE `id`=?";
            
            $stmt = $database->prepareQuery($q);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $addUser = new LoggedUser($row['id'], $row['name'], $row['surname'], $row['email'], $row['username'], "", $row['phone_number'], $row['address'], $row['location'], $row['user_level'], $row['postcode'], $row['dob']);
            include("../view/edit-user.php");
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

        $validation = new EditUserValidator($_POST);

        $name = isset($_POST['name']) ? $validation->testInput($_POST['name']) : "";
        $surname = isset($_POST['surname']) ? $validation->testInput($_POST['surname']) : "";
        $email = isset($_POST['email']) ? $validation->testInput($_POST['email']) : "";
        $telephone = isset($_POST['telephone']) ? $validation->testInput($_POST['telephone']) : "";
        $username = isset($_POST['username']) ? $validation->testInput($_POST['username']) : "";
        $address = isset($_POST['address']) ? $validation->testInput($_POST['address']) : "";
        $location = isset($_POST['location']) ? $validation->testInput($_POST['location']) : "";
        $postcode = isset($_POST['postcode']) ? $validation->testInput($_POST['postcode']) : "";
        $dob = isset($_POST['dob']) ? $validation->testInput($_POST['dob']) : "";
        $password = isset($_POST['password']) ? $validation->testInput($_POST['password']) : "";
        $retypePassword = isset($_POST['retypePassword']) ? $validation->testInput($_POST['retypePassword']) : "";
        $userLevel = isset($_POST['userLevel']) ? $validation->testInput($_POST['userLevel']) : "";

        $errors = [];

        $userId = $_POST["userId"];

        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == "Edit user") {
                $errors = $validation->validateForm();
                if (count($errors) > 0) {
                    $addUser = new LoggedUser(0, $name, $surname, $email, $username, $password, $telephone, $address, $location, $userLevel, $postcode, $dob);
                    include_once('../view/edit-user.php');
                } else {
                    if (isset($_POST['password']) && isset($_POST['retypePassword'])&&!empty($_POST['password'])) {
                        $passwordValidator =  new passwordOnlyValidator($_POST);
                        $passwordErrors = [];
                        $passwordErrors = $passwordValidator->validateForm();
                        
                        if (count($passwordErrors) > 0) {
                            $addUser = new LoggedUser(0, $name, $surname, $email, $username, $password, $telephone, $address, $location, $userLevel, $postcode, $dob);
                            include_once('../view/edit-user.php');
                        } else {
                            $password = sha1($password);
                            $q = "UPDATE `users` SET `password` = ? WHERE `id` = ?";
                            $stmt = $database->prepareQuery($q);
                            $stmt->bind_param('si', $password, $userId);
                            $stmt->execute();

                            $q = "UPDATE `users` SET `name` = ?, `surname` = ?, `email` = ?, `username` = ?, `phone_number` = ?, `address` = ?, `location` = ?, `user_level` = ?, `postcode` = ?, `dob` = ?
                            WHERE `id` = ?";
                            $stmt = $database->prepareQuery($q);
                            $stmt->bind_param('sssssssissi', $name, $surname, $email, $username, $telephone, $address, $location, $userLevel, $postcode, $dob, $userId);
                            $stmt->execute();
                            header("Location: ../users/");
                        }
                    } else {
                        $q = "UPDATE `users` SET `name` = ?, `surname` = ?, `email` = ?, `username` = ?, `phone_number` = ?, `address` = ?, `location` = ?, `user_level` = ?, `postcode` = ?, `dob` = ?
                        WHERE `id` = ?";
                        $stmt = $database->prepareQuery($q);
                        $stmt->bind_param('sssssssissi', $name, $surname, $email, $username, $telephone, $address, $location, $userLevel, $postcode, $dob, $userId);
                        $stmt->execute();
                        $message = "Succesfully edited user:" . $userId;
                        $logController->log($message);
                        header("Location: ../users/");
                    }
                }
            }
        } else {
            $addUser = new LoggedUser(0, $name, $surname, $email, $username, $password, $telephone, $address, $location, $userLevel, $postcode, $dob);
            include_once('../view/edit-user.php');
        }
    }
}
