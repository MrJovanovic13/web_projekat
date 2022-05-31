<?php
require_once "../../connection/connection.php";
require_once "../../controller/category.php";

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$deleteErr;

session_start();
if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        if ($action == 'removeCategory') {
            $q = "SELECT `id` FROM `products` WHERE `category_id`=" . $_GET['categoryId'];
            $result = $conn->query($q);
            if ($row = $result->fetch_assoc()) {
                $deleteErr = "Category still has products using it!";
            } else {
                $q = "DELETE FROM `category` WHERE `id`=" . $_GET['categoryId'];
                $result = $conn->query($q);
            }
        }

        $categories = array();
        $q = "SELECT `id`, `name`
            FROM `category`";
            $result = $conn->query($q);
            while ($row = $result->fetch_assoc()) {
                $categories[] = new Category($row['id'],$row['name']);
            }
        
        include("../view/categories.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        
    }
} else {
    header("Location: ../../login/");
}
