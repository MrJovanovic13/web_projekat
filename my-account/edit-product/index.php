<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../../connection/connection.php";
require_once "../../controller/category.php";
require_once "../../controller/product.php";

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

            $editProduct = new EditProduct($row['id'],$row['name'],$row['price'],$row['imgUrl'],$row['description'], $row['in_stock']);

        $q2 = "SELECT `id`, `name` FROM `category`";

        $result2 = $conn->query($q2);

        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                if ($row['category_id'] == $row2["id"]) {
                    $categoryObj = new CategoryProduct($row2['id'], $row2['name'], 1);
                    $categories[] = $categoryObj;
                    continue;
                }
                $categoryObj = new CategoryProduct($row2['id'], $row2['name'], 0);
                $categories[] = $categoryObj;
            }
        } else {
            $categoryErr = "No categories";
        }

        include("../view/edit-product.php");
    } else {

        include("../view/products.php");
    }
}