<?php
require_once "../../connection/connection.php";
require_once "../../controller/user.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
            WHERE `id`=" . $id;
            $result = $conn->query($q);
            $row = $result->fetch_assoc();

            $addUser = new LoggedUser($row['id'], $row['name'], $row['surname'], $row['email'], $row['username'], "", $row['phone_number'], $row['address'], $row['location'], $row['user_level'], $row['postcode'], $row['dob']);
            include("../view/edit-user.php");
        }
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

        //userLevel validation
        if (!isset($_POST["userLevelUser"])) {
            $userLevelUserErr = "You must input this field!";
        } elseif ($_POST['userLevelUser'] != 0 && $_POST['userLevelUser'] != 1 && $_POST['userLevelUser'] != 2) {
            $userLevelUserErr = "Invalid user level!";
        } else {
            $userLevelUser = test_input($_POST["userLevelUser"]);
        }

        if (empty($_POST["userLevel"])) {
            $userLevelErr = "You must input this field";
        } else {
            $userLevel = test_input($_POST["userLevel"]);
        }

        if (isset($nameErr) || isset($surnameErr) || isset($emailErr) || isset($locationErr) || isset($telephoneErr) || isset($usernameErr) || isset($addressErr) || isset($postcodeErr) || isset($dobErr) || isset($userLevelUserErr)) {

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
    
            $addUser = new LoggedUser(0, $name, $surname, $email, $username, $password,$telephone, $address, $location, $userLevelUser, $postcode, $dob);
            include_once('../view/edit-user.php');
        } else {
            $password = sha1($password);

            $q = "UPDATE `users` SET `name` = '$name', `surname` = '$surname', `email` = '$email', `username` = '$username', `phone_number` = '$telephone', `address` = '$address', `location` = '$location', `user_level` = '$userLevel', `postcode` = '$postcode', `dob` = '$dob'
            WHERE `id` = $userId";
            $conn->query($q);
            header("Location: ../users");
        }
    }
}
