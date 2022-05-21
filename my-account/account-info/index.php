<?php
require_once "../../connection/connection.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$id = isset($_GET['userId']) ? $_GET['userId'] : "";

if (!isset($_SESSION['userObj'])) {
    header("Location: ../../login");
    die();
} else {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if ($action == 'editUser') {
            $q = "SELECT `id`, `name`, `surname`, `email`, `username`, `password`, `phone_number`, `address`, `location`, `user_level`, `postcode`, `dob`
            FROM `users`
            WHERE `id`=" . $id;
            $result = $conn->query($q);
            $row = $result->fetch_assoc();
        }
        include("../view/account-info.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $userId = $_POST["userId"];

        // email validation
        if (empty($_POST["email"])) {
            $emailErr = "You must input this field";
        } else {
            $email = test_input($_POST["email"]);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email adress";
            }

            $q = "SELECT `id` 
                    FROM `users` 
                    WHERE `email` = '$email'
                    AND `id` != $userId";

            $result = $conn->query($q);

            if ($result->num_rows > 0) {
                $emailErr = "Email already in use";
            }
        }

        //Password validation
        if (empty($_POST["password"])) {
            $passwordErr = "You must input this field";
        } else {
            $password = test_input($_POST["password"]);
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);

            if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                $passwordErr = 'Password must be longer than 8 characters and it must contain at least 1 uppercase,1 lowercase character and 1 numberr';
            }
        }

        //Password  repeat validation
        if (empty($_POST["retypePassword"])) {
        } else {
            $password = test_input($_POST["password"]);
            $retypepassword = test_input($_POST["retypePassword"]);

            if ($password != $retypepassword) {
                $retypePasswordErr = "Passwords don't match!";
            }
        }

        //First name validation
        if (empty($_POST["name"])) {
            $nameErr = "You must input this field";
        } else {
            $name = test_input($_POST["name"]);
        }

        //Surname validation
        if (empty($_POST["surname"])) {
            $surnameErr = "You must input this field";
        } else {
            $surname = test_input($_POST["surname"]);
        }

        //Username validation
        if (empty($_POST["username"])) {
            $usernameErr = "You must input this field";
        } else {
            $username = test_input($_POST["username"]);

            $q = "SELECT `id` 
                    FROM `users` 
                    WHERE `username` = '$username'
                    AND `id` != $userId";

            $result = $conn->query($q);

            if ($result->num_rows > 0) {
                $emailErr = "Username already in use";
            }
        }
        //telephone name validation
        if (empty($_POST["telephone"])) {
            $telephoneErr = "You must input this field";
        } else {
            $telephone = test_input($_POST["telephone"]);
        }

        //city name(location) validation
        if (empty($_POST["location"])) {
            $locationErr = "You must input this field";
        } else {
            $location = test_input($_POST["location"]);
        }

        //Postcode name validation
        if (empty($_POST["postcode"])) {
            $postcodeErr = "You must input this field";
        } else {
            $postcode = test_input($_POST["postcode"]);
            if (!is_numeric($postcode))
                $zipCodeErr = "Invalid Postcode";
        }

        //address validation
        if (empty($_POST["address"])) {
            $addressErr = "You must input this field";
        } else {
            $address = test_input($_POST["address"]);
        }

        //dob validation
        if (empty($_POST["dob"])) {
            $dobErr = "You must input this field";
        } else {
            $dob = test_input($_POST["dob"]);
        }

        if (empty($_POST["userLevel"])) {
            $userLevelErr = "You must input this field";
        } else {
            $userLevel = test_input($_POST["userLevel"]);
        }

        if (isset($nameErr) || isset($surnameErr) || isset($emailErr) || isset($locationErr) || isset($passwordErr) || isset($retypePasswordErr) || isset($telephoneErr) || isset($usernameErr)|| isset($addressErr)|| isset($postcodeErr)|| isset($dobErr)) {
            include_once('../view/account-info.php');
        } else {
            $password = sha1($password);

            $q = "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `email` = '$email', `username` = '$username', `password` = '$password', `phone_number` = '$telephone', `address` = '$address', `location` = '$location', `user_level` = '$userLevel', `postcode` = '$postcode', `dob` = '$dob'
            WHERE `id` = $userId";
            $conn->query($q);
            header("Location: ../../my-account");
        }
    }
}
