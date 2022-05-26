<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../../connection/connection.php";

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$id = isset($_GET['productId']) ? $_GET['productId'] : "";

if (!isset($_SESSION['userObj']))
{
    header("Location: ../../login"); 
    die();
} else {
    if($action=='editProduct'){

    
        $q = "SELECT `id`, `name`,`description`,`imgUrl`, `category_id`, `price`, `in_stock`
FROM `products` WHERE `id`=".$id;


        $result = $conn->query($q);
        $row = $result->fetch_assoc();
            $stock = $row['in_stock'];

            $q1 = "SELECT `name` FROM `category` WHERE `id`=" . $row['category_id'];
            $result1 = $conn->query($q1);
            $row1 = $result1->fetch_assoc();

        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
        $imgUrl = $row['imgUrl'];
        $category = $row1['name'];
        $switchUpdate = 'Edit product';

        include("../view/add-product.php");
    } else {
        include("../view/products.php");
    }
}