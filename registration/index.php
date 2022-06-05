<?php
require "../vendor/autoload.php";
$database = new Database();

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";


if ($_SERVER['REQUEST_METHOD'] == "GET") {
    include("../view/registration.php");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $validation = new UserValidator($_POST);

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
        if ($_POST['submit'] == "Sign Up") {
            $errors = $validation->validateForm();
            if (count($errors) > 0) {
                $addUser = new LoggedUser(0, $name, $surname, $email, $username, $password, $telephone, $address, $location, 0, $postcode, $dob);
                include_once('../view/registration.php');
            } else {
                $password = sha1($password);
                $q = "INSERT INTO `users`(`name`,`surname`, `email`, `username`, `password`, `phone_number`, `address`, `location`, `user_level`, `postcode`, `dob`) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?, ?)";
                $stmt = $database->prepareQuery($q);
                $stmt->bind_param('ssssssssss', $name, $surname, $email, $username, $password, $telephone, $address, $location, $postcode, $dob);
                $stmt->execute();
                header("Location: ../login");
            }
        }
    } else {
        $addUser = new LoggedUser(0, $name, $surname, $email, $username, $password, $telephone, $address, $location, 0, $postcode, $dob);
        include_once('../view/registration.php');
    }
} else {
    header("Location: 404.php");
    die();
}
