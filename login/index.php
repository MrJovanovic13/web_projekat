<?php
require "../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$database = new Database();

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
                session_start();
                $_SESSION['loggedIn'] = $email;

                $userObj = new LoggedUser($row['id'], $row['name'], $row['surname'], $row['email'], $row['username'], $row['password'],$row['phone_number'], $row['address'], $row['location'], $row['user_level'], $row['postcode'], $row['dob']);

                $_SESSION['userObj'] = serialize($userObj);
                $_SESSION['role'] = $row['user_level'];
                $_SESSION['userId'] = $row['id'];

                $logs = __DIR__ . "/../logs/";
                $file=fopen($logs.date("Y-m-d").'-'.$_SESSION['userId'].'.log', 'a');
                fwrite($file,'UserID: '.$row['id'].'| name: '.$row['name']. '| Logged in |'.date("h:i:sa")."\n");
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
