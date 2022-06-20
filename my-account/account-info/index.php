<?php
require "../../vendor/autoload.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$logController = new LogController();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$id = isset($_GET['userId']) ? $_GET['userId'] : "";
$user = unserialize($_SESSION['userObj']);
$userLevel = $user->userLevel;

if (!isset($_SESSION['userObj'])) {
    header("Location: ../../login");
    die();
} else {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $user = unserialize($_SESSION['userObj']);
        include("../view/account-info.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        $userId = $_POST["userId"];

        $validation = new AccountInfoValidator($_POST);

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
    
        $errors = [];

        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == "Edit user") {
                $errors = $validation->validateForm();
                if (count($errors) > 0) {
                    $user = new LoggedUser($userId, $name, $surname, $email, $username, $password, $telephone, $address, $location, 0, $postcode, $dob);
                    include_once('../view/account-info.php');
                } else {
                    $password = sha1($password);
                    $q = "UPDATE `users` SET `name` = ?, `surname` = ?, `email` = ?, `username` = ?, `password` = ?, `phone_number` = ?, `address` = ?, `location` = ?, `postcode` = ?, `dob` = ?
                    WHERE `id` =?";
                    $stmt = $database->prepareQuery($q);
                    $stmt->bind_param('ssssssssssi', $name, $surname, $email, $username, $password, $telephone, $address, $location, $postcode, $dob,$userId);
                    $stmt->execute();

                    $userObj = new LoggedUser($userId, $name, $surname, $email, $username, $password, $telephone, $address, $location, $userLevel, $postcode, $dob);

                    $_SESSION['userObj'] = serialize($userObj);

                    $message = "Succesfully changed own user data";
                    $logController->log($message);
                    header("Location: ../orders/");
                }
            }
        } else {
            $user = new LoggedUser(0, $name, $surname, $email, $username, $password, $telephone, $address, $location, 0, $postcode, $dob);
            include_once('../view/account-info.php');
        }
    }
}
