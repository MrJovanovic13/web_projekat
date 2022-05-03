<?php
require_once "../../connection/connection.php";

session_start();
if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        include("../view/dashboard.php");
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
            $nameErr = "You must input this field";
        } else {
            $name = test_input($_POST["name"]);
        }

        //Description validation
        if (empty($_POST["description"])) {
            $descriptionErr = "You must input this field";
        } else {
            $description = test_input($_POST["description"]);
        }

        //Price validation
        if (empty($_POST["price"])) {
            $priceErr = "You must input this field";
        } else {
            $price = test_input($_POST["price"]);
        }

        //Image location validation
        if (empty($_POST["imgUrl"])) {
            $imgUrlErr = "You must input this field";
        } else {
            $imgUrl = test_input($_POST["imgUrl"]);
        }

        //Category validation
        if (empty($_POST["category"])) {
            $categoryErr = "You must input this field";
        } else {
            $category = test_input($_POST["category"]);
        }

        $in_stock = 1;

        if (isset($nameErr) || isset($descriptionErr) || isset($priceErr) || isset($imgUrlErr) || isset($categoryErr)){
            header("Location: ../dashboard/");
        } else {
            $q = "INSERT INTO `products`(`name`,`description`, `price`, `imgUrl`, `in_stock`, `category_id`) 
                            VALUES ('$name', '$description', '$price', '$imgurl', '1', '1')";
            $conn->query($q);
            header("Location: ../../my-account/");
        }
    }
} else {
    header("Location: ../../login/");
}
