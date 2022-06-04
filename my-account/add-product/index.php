<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['userObj'])) {

$database = new Database();
$categories = array();
$skipFirst = 0;

$q = "SELECT `id`, `name` FROM `category`";

$result = $database->executeQuery($q);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (!$skipFirst++) {
            continue;
        }
        if (isset($_POST["category"]) && $_POST["category"] == $row["id"]) {
            $categoryObj = new CategoryProduct($row['id'], $row['name'],1);
            $categories[] = $categoryObj;
            continue;
        }
        $categoryObj = new CategoryProduct($row['id'], $row['name'],0);
        $categories[] = $categoryObj;
    }
} else {
    $categoryErr = "No categories";
}

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        
        $addProduct = new EditProduct("", "", "", "", "","");
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
        } elseif ($_POST["category"] == 1) {
            $category = test_input($_POST["category"]);
        }

        if (!isset($_POST["stock"])) {
            $stockErr = "You must select one!";
        } else {
            $inStock = $_POST["stock"];
        }

        if (empty($_POST["category"])) {
            $categoryErr = "You must select a category!";
        } else {
            $category = $_POST["category"];
        }

        if (isset($nameErr) || isset($descriptionErr) || isset($priceErr) || isset($imgUrlErr) || isset($categoryErr)) {

            $name = isset($_POST['name']) ? $_POST['name'] : "";
            $description = isset($_POST['description']) ? $_POST['description'] : "";
            $price = isset($_POST['price']) ? $_POST['price'] : "";
            $stock = isset($_POST['stock']) ? $_POST['stock'] : "";
            $imgUrl = isset($_POST['imgUrl']) ? $_POST['imgUrl'] : "";
            $category = isset($_POST['category']) ? $_POST['category'] : "";
            $addProduct = new EditProduct(0, $name, $price, $imgUrl, $description,$stock);
            include_once('../view/add-product.php');
        } else {
                $q = "INSERT INTO `products`(`name`,`description`, `price`, `imgUrl`, `in_stock`, `category_id`) 
                VALUES ('$name', '$description', '$price', '$imgUrl', '$inStock', '$category')";
                $result = $database->executeQuery($q);
                header("Location: ../products/");
        }
    }
} else {
    header("Location: ../../login/");
}
