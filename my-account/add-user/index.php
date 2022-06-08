<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$logController = new LogController();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $addUser = new LoggedUser(0, "", "", "", "", "", "", "", "", "", "", "");
    include("../view/add-user.php");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $validation = new AddUserValidator($_POST);

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
    if (isset($_POST['submit'])) {
        if ($_POST['submit'] == "Add user") {
            $errors = $validation->validateForm();
            if (count($errors) > 0) {
                $addUser = new LoggedUser(0, $name, $surname, $email, $username, $password, $telephone, $address, $location, $userLevel, $postcode, $dob);
                include_once('../view/add-user.php');
            } else {
                $password = sha1($password);
                $q = "INSERT INTO `users`(`name`,`surname`, `email`, `username`, `password`, `phone_number`, `address`, `location`, `user_level`, `postcode`, `dob`) 
                                         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $database->prepareQuery($q);
                $stmt->bind_param('ssssssssiss', $name, $surname, $email, $username, $password, $telephone, $address, $location, $userLevel, $postcode, $dob);
                $stmt->execute();
                $message = "Succesfully added user with ID:" . $database->lastInsertedId();
                $logController->log($message);
                header("Location: ../users");
            }
        }
    } else {
        $addUser = new LoggedUser(0, $name, $surname, $email, $username, $password, $telephone, $address, $location, $userLevel, $postcode, $dob);
        include_once('../view/add-user.php');
    }
} else {
    header("Location: 404.php");
    die();
}
