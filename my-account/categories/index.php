<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$deleteErr;
$highlightCounter = 0;

if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        if ($action == 'removeCategory') {
            $q = "SELECT `id` FROM `products` WHERE `category_id`=" . $_GET['categoryId'];
            $result = $database->executeQuery($q);
            if ($row = $result->fetch_assoc()) {
                $deleteErr = "Category still has products using it!";
            } else {
                $q = "DELETE FROM `category` WHERE `id`=" . $_GET['categoryId'];
                $result = $database->executeQuery($q);
            }
        }

        $categories = array();
        $q = "SELECT `id`, `name`
            FROM `category`";
            $result = $database->executeQuery($q);
            while ($row = $result->fetch_assoc()) {
                $categories[] = new Category($row['id'],$row['name']);
            }
        
        include("../view/categories.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        
    }
} else {
    header("Location: ../../login/");
}
