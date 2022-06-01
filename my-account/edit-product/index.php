<?php
require_once "../../connection/connection.php";
require_once "../../controller/category.php";
require_once "../../controller/product.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['userObj'])) {
    header("Location: ../../login");
    die();
}

$categories = array();
$skipFirst = 0;

$q = "SELECT `id`, `name` FROM `category`";

$result = $conn->query($q);

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


$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$id = isset($_GET['productId']) ? $_GET['productId'] : $_POST['productId'];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $q = "SELECT `id`, `name`,`description`,`imgUrl`, `category_id`, `price`, `in_stock`
    FROM `products` WHERE `id`=" . $id;

    $result = $conn->query($q);
    $row = $result->fetch_assoc();
    $inStock = $row['in_stock'];

    $q1 = "SELECT `name` FROM `category` WHERE `id`=" . $row['category_id'];
    $result1 = $conn->query($q1);
    $row1 = $result1->fetch_assoc();

    $editProduct = new EditProduct($row['id'], $row['name'], $row['price'], $row['imgUrl'], $row['description'], $row['in_stock']);



    include("../view/edit-product.php");
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
    if (isset($nameErr) || isset($descriptionErr) || isset($priceErr) || isset($imgUrlErr) || isset($categoryErr) || isset($stockErr)) {
        
        $productId = $_POST['productId'];

        $q = "SELECT `id`, `name`,`description`,`imgUrl`, `category_id`, `price`, `in_stock`
        FROM `products` WHERE `id`=" . $_POST['productId'];
    
        $result = $conn->query($q);
        $row = $result->fetch_assoc();
        $inStock = $row['in_stock'];
    
        $q1 = "SELECT `name` FROM `category` WHERE `id`=" . $row['category_id'];
        $result1 = $conn->query($q1);
        $row1 = $result1->fetch_assoc();
    
        $editProduct = new EditProduct($row['id'], $row['name'], $row['price'], $row['imgUrl'], $row['description'], $row['in_stock']);
    

        include("../view/edit-product.php");
    } else {
        $q = "UPDATE `products` SET `name` = '$name', `description` = '$description', `price` = '$price', `imgUrl` = '$imgUrl', `in_stock` = '$inStock', `category_id` = '$category'
        WHERE `id` =" . $_POST['productId'];
        $conn->query($q);
        header("Location: ../products/");
    }
} else {

    include("../view/products.php");
}
