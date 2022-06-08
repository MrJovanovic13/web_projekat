<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$logController = new LogController();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : "";
$nameCurrent;
$nameNew;

if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        if ($action == 'editCategory') {
            $q = "SELECT `id`, `name`
            FROM `category` WHERE `id`=".$categoryId;
            $result = $database->executeQuery($q);
            $row = $result->fetch_assoc();
            $name = $row['name'];
        }

        $categories = array();
        $q = "SELECT `id`, `name`
            FROM `category`";
            $result = $database->executeQuery($q);
            while ($row = $result->fetch_assoc()) {
                $categories[] = new Category($row['id'],$row['name']);
        }
        
        include("../view/edit-category.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nameNew = $_POST['name'];
        $q = "UPDATE `category` SET `name` = '$nameNew'
            WHERE `id` =". $_POST['categoryId'];
            $result = $database->executeQuery($q);
            $message = "Succesfully edited category with ID:" . $_POST['categoryId'];
            $logController->log($message);
            header("Location: ../categories/");
    }
} else {
    header("Location: ../../login/");
}
