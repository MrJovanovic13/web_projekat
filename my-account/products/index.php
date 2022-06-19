<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$database = new Database();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$id = isset($_GET['productId']) ? $_GET['productId'] : "";

$products = array();
$counter = 0;
$productCounter = 0;
$pageCounter = 1;
$i = 1;
$currentPageUser = isset($_POST['page']) ? $_POST['page'] : "1";

function returnProductsFromPage($page,$arrayOfProducts) 
{
    $products = array();
    foreach($arrayOfProducts as $product){
        if($product->page == $page){
            $products[] = $product;
        }
    }
    return $products;
}

if (!isset($_SESSION['userObj'])) {
    header("Location: ../../login");
    die();
} else {
    if ($action == 'deleteProduct') {
        $q = "DELETE FROM `products` WHERE `id`=" . $id;
        $result = $database->executeQuery($q);
        header("Location: ../products");
    } else {
        $products = array();

        $q = "SELECT `id`, `name`, `category_id`, `price`, `in_stock`
        FROM `products`";
        $result = $database->executeQuery($q);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $inStock = ($row['in_stock']) ? ("Yes") : ("no");

                $q1 = "SELECT `name`
                FROM `category` WHERE `id`=" . $row['category_id'];
                $result1 = $database->executeQuery($q1);
                $row1 = $result1->fetch_assoc();

                $productObj = new AdminPageProduct($row['id'], $row['name'], $row['price'], $inStock, $row1['name'], $pageCounter);
                $products[] = $productObj;
                if (!$productCounter++ == 0 && $productCounter % 8 == 0) {
                    $pageCounter++;
                }
            }
        }
        include("../view/products.php");
    }
}
