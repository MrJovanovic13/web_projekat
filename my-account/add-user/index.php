<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    $addUser = new LoggedUser(0, "", "", "", "", "", "", "", "", "", "", "");
    include("../view/add-user.php");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Email validation
    if (empty($_POST["email"])) {
        $emailErr = "You must input this field!";
    } else {
        $email = test_input($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email adress!";
        }

        $q = "SELECT `id` 
                    FROM `users` 
                    WHERE `email` = '$email'";

        $result = $database->executeQuery($q);


        if ($result->num_rows > 0) {
            $emailErr = "Email already in use!";
        }
    }

    //Password validation
    if (empty($_POST["password"])) {
        $passwordErr = "You must input this field!";
    } else {
        $password = test_input($_POST["password"]);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            $passwordErr = 'Password must be longer than 8 characters and it must contain at least 1 uppercase,1 lowercase character and 1 number!';
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
        $nameErr = "You must input this field!";
    } else {
        $name = test_input($_POST["name"]);
    }

    //Surname validation
    if (empty($_POST["surname"])) {
        $surnameErr = "You must input this field!";
    } else {
        $surname = test_input($_POST["surname"]);
    }

    //Username validation
    if (empty($_POST["username"])) {
        $usernameErr = "You must input this field!";
    } else {
        $username = test_input($_POST["username"]);

        $q = "SELECT `id` 
                    FROM `users` 
                    WHERE `username` = '$username'";

        $result = $database->executeQuery($q);


        if ($result->num_rows > 0) {
            $usernameErr = "Username already in use!";
        }
    }


    //telephone name validation
    if (empty($_POST["telephone"])) {
        $telephoneErr = "You must input this field!";
    } else {
        $telephone = test_input($_POST["telephone"]);
    }

    //city name(location) validation
    if (empty($_POST["location"])) {
        $locationErr = "You must input this field!";
    } else {
        $location = test_input($_POST["location"]);
    }

    //Postcode name validation
    if (empty($_POST["postcode"])) {
        $postcodeErr = "You must input this field!";
    } else {
        $postcode = test_input($_POST["postcode"]);
        if (!is_numeric($postcode))
            $zipCodeErr = "Invalid Postcode!";
    }

    //address validation
    if (empty($_POST["address"])) {
        $addressErr = "You must input this field!";
    } else {
        $address = test_input($_POST["address"]);
    }

    //userLevel validation
    if (!isset($_POST["userLevelUser"])) {
        $userLevelUserErr = "You must input this field!";
    } elseif ($_POST['userLevel'] != 0 && $_POST['userLevelUser'] != 1 && $_POST['userLevelUser'] != 2) {
        $userLevelUserErr = "Invalid user level!";
    } else {
        $userLevelUser = test_input($_POST["userLevelUser"]);
    }

    //dob validation
    if (empty($_POST["dob"])) {
        $dobErr = "You must input this field!";
    } else {
        $dob = test_input($_POST["dob"]);
    }

    if (isset($nameErr) || isset($surnameErr) || isset($emailErr) || isset($locationErr) || isset($passwordErr) || isset($retypePasswordErr) || isset($telephoneErr) || isset($usernameErr) || isset($addressErr) || isset($postcodeErr) || isset($dobErr) || isset($userLevelUserErr)) {

        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $surname = isset($_POST['surname']) ? $_POST['surname'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
        $username = isset($_POST['username']) ? $_POST['username'] : "";
        $address = isset($_POST['address']) ? $_POST['address'] : "";
        $location = isset($_POST['location']) ? $_POST['location'] : "";
        $postcode = isset($_POST['postcode']) ? $_POST['postcode'] : "";
        $dob = isset($_POST['dob']) ? $_POST['dob'] : "";
        $userLevelUser = isset($_POST['userLevelUser']) ? $_POST['userLevelUser'] : "";
        $password = isset($_POST['password']) ? $_POST['password'] : "";
        $retypePassword = isset($_POST['retypePassword']) ? $_POST['retypePassword'] : "";

        $addUser = new LoggedUser(0, $name, $surname, $email, $username, $password, $telephone, $address, $location, $userLevelUser, $postcode, $dob);

        include_once('../view/add-user.php');
    } else {
        $password = sha1($password);
        $q = "INSERT INTO `users`(`name`,`surname`, `email`, `username`, `password`, `phone_number`, `address`, `location`, `user_level`, `postcode`, `dob`) 
                        VALUES ('$name', '$surname', '$email', '$username', '$password', '$telephone', '$address', '$location', '0', '$postcode', '$dob')";
        $result = $database->executeQuery($q);
        header("Location: ../users");
    }
} else {
    header("Location: 404.php");
    die();
}
