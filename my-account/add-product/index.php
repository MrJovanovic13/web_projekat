<?php
require_once "../../connection/connection.php";

session_start();
if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $switchUpdate = 'Add product';
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
        } elseif($_POST["category"]==1) {
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
            $name = isset($_POST['name']) ? $_POST['name'] : "";
            $description = isset($_POST['description']) ? $_POST['description'] : "";
            $price = isset($_POST['price']) ? $_POST['price'] : "";
            $imgUrl = isset($_POST['imgUrl']) ? $_POST['imgUrl'] : "";
            $category = isset($_POST['category']) ? $_POST['category'] : "";
            $switchUpdate = 'Add product';
            include_once('../view/add-product.php');
        } else {
            if($_POST['updateType']=='Add product'){
                $q = "INSERT INTO `products`(`name`,`description`, `price`, `imgUrl`, `in_stock`, `category_id`) 
                VALUES ('$name', '$description', '$price', '$imgUrl', '$in_stock', '$category')";
                $conn->query($q);
                header("Location: ../products/");
            } else {
                $q = "UPDATE `products` SET `name` = '$name', `description` = '$description', `price` = '$price', `imgUrl` = '$imgUrl', `in_stock` = '$in_stock', `category_id` = '$category'
                WHERE `id` =". $_POST['productId'];
                $conn->query($q);
                header("Location: ../products/");
            }
        }
    }
} else {
    header("Location: ../../login/");
}
