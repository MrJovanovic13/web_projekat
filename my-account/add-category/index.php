<?php
require_once "../../connection/connection.php";
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";


session_start();
if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {


        include("../view/add-category.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Name validation
        if (empty($_POST["name"])) {
            $nameErr = "You must input this field!";
        } else {
            $name = test_input($_POST["name"]);

            $q = "SELECT `name` 
                FROM `category`
                WHERE `name` = '$name'";

            $result = $conn->query($q);

            if($result->num_rows != 0) {
                $nameErr = "Category already exists!";
            }
        }

        if (isset($nameErr)) {
            include_once('../view/add-category.php');
        } else {
            $q = "INSERT INTO `category`(`name`) 
                            VALUES ('$name')";
            $conn->query($q);
            header("Location: ../categories/");
        }
    }
} else {
    header("Location: ../../login/");
}
