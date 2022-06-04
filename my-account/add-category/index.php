<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

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

            $result = $database->executeQuery($q);

            if($result->num_rows != 0) {
                $nameErr = "Category already exists!";
            }
        }

        if (isset($nameErr)) {
            include_once('../view/add-category.php');
        } else {
            $q = "INSERT INTO `category`(`name`) 
                            VALUES ('$name')";
            $result = $database->executeQuery($q);
            header("Location: ../categories/");
        }
    }
} else {
    header("Location: ../../login/");
}
