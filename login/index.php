<?php
require_once "../connection/connection.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    include("../view/login.php");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $q = "SELECT * FROM users WHERE email = '$email'";

        $result = $conn->query($q);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $dbPass = $row['password'];
            if ($dbPass != sha1($password)) {
                $msg = "Incorrect login info!";
                include_once("../view/login.php");
            } else {
                require_once '../controller/user.php';

                $_SESSION['loggedIn'] = $email;

                $userObj = new LoggedUser($row['id'], $row['name'], $row['surname'], $row['email'], $row['username'], $row['password'],$row['phone_number'], $row['address'], $row['location'], $row['user_level'], $row['postcode'], $row['dob']);

                $_SESSION['userObj'] = serialize($userObj);
                $_SESSION['role'] = $row['user_level'];
                $_SESSION['userId'] = $row['id'];

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
