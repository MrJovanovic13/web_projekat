<?php
require "../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$database = new Database();
$logController = new LogController();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if ($action == "logOut") {
            session_unset();
            session_destroy();
            header("Location: ../login/");
        }
    include("../view/login.php");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $q = "SELECT * FROM users WHERE email = '$email'";

        $result = $database->executeQuery($q);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $dbPass = $row['password'];
            if ($dbPass != sha1($password)) {
                $msg = "Incorrect login info!";
                include_once("../view/login.php");
            } else {
                $_SESSION['loggedIn'] = $email;

                $userObj = new LoggedUser($row['id'], $row['name'], $row['surname'], $row['email'], $row['username'], $row['password'],$row['phone_number'], $row['address'], $row['location'], $row['user_level'], $row['postcode'], $row['dob']);

                $_SESSION['userObj'] = serialize($userObj);

                $message = 'Logged in successfully';
                $logController->log($message);

                header("Location: ../my-account/");
            }
        } else {
            $msg = "Incorrect login info!";
            include_once("../view/login.php");
        }
    } else {
        $msg = "Fields must not be empty!";
        include_once("../view/login.php");
    }
} else {
    header("Location: test.php");
    die();
}
