<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../../connection/connection.php";
require_once "../../controller/user.php";
require_once "../../controller/product.php";

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$id = isset($_GET['productId']) ? $_GET['productId'] : "";

if (!isset($_SESSION['userObj']))
{
    header("Location: ../../login"); 
    die();
} else {
    if($action=='deleteProduct'){
        $q = "DELETE FROM `products` WHERE `id`=".$id;
        $result = $conn->query($q);
        header("Location: ../products"); 
    } else {
        $highlightCounter = 0;
        $products = array();

        $q = "SELECT `id`, `name`, `category_id`, `price`, `in_stock`
        FROM `products`";
        $result = $conn->query($q);

        while ($row = $result->fetch_assoc()) {

            $inStock = ($row['in_stock']) ? ("Yes") : ("no");

            $q1 = "SELECT `name` FROM `category` WHERE `id`=" . $row['category_id'];
            $result1 = $conn->query($q1);
            $row1 = $result1->fetch_assoc();
    
            $productObj = new AccountMenuProduct($row['id'], $row['name'], $row['price'], $inStock,$row1['name']);
            $products[] = $productObj;
        }

        include("../view/products.php");
    }
}
?>