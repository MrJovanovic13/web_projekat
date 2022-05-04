<?php
require_once "../../connection/connection.php";

session_start();
if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        include("../view/add-product.php");
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
        }

        //Description validation
        if (empty($_POST["description"])) {
            $descriptionErr = "You must input this field!";
        } else {
            $description = test_input($_POST["description"]);
        }

        //Price validation
        if (empty($_POST["price"])) {
            $priceErr = "You must input this field!";
        } else {
            $price = test_input($_POST["price"]);
        }

        //Image location validation
        if (empty($_POST["imgUrl"])) {
            $imgUrlErr = "You must input this field!";
        } else {
            $imgUrl = test_input($_POST["imgUrl"]);
        }

        //Category validation
        if (empty($_POST["category"])) {
            $categoryErr = "You must input this field!";
        } else {
            $category = test_input($_POST["category"]);
        }

        if (empty($_POST["stock"])) {
            $stockErr = "You must select one!";
        } else {
            $in_stock = $_POST["stock"];
        }

        if (empty($_POST["category"])) {
            $categoryErr = "You must select a category!";
        } else {
            $category = $_POST["category"];
        }

        if (isset($nameErr) || isset($descriptionErr) || isset($priceErr) || isset($imgUrlErr) || isset($categoryErr)){
            include_once('../view/add-product.php');
        } else {
            $q = "INSERT INTO `products`(`name`,`description`, `price`, `imgUrl`, `in_stock`, `category_id`) 
                            VALUES ('$name', '$description', '$price', '$imgUrl', '$in_stock', '$category')";
            $conn->query($q);
            header("Location: ../add-product/");
        }
    }
} else {
    header("Location: ../../login/");
}
