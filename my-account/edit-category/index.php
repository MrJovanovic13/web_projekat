<?php
require_once "../../connection/connection.php";
require_once "../../controller/category.php";

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : "";
$nameCurrent;
$nameNew;

session_start();
if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        if ($action == 'editCategory') {
            $q = "SELECT `id`, `name`
            FROM `category` WHERE `id`=".$categoryId;
            $result = $conn->query($q);
            $row = $result->fetch_assoc();
            $name = $row['name'];
        }

        $categories = array();
        $q = "SELECT `id`, `name`
            FROM `category`";
            $result = $conn->query($q);
            while ($row = $result->fetch_assoc()) {
                $categories[] = new Category($row['id'],$row['name']);
        }
        
        include("../view/edit-category.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        $nameNew = $_POST['name'];
        $q = "UPDATE `category` SET `name` = '$nameNew'
            WHERE `id` =". $_POST['categoryId'];
            $conn->query($q);

            header("Location: ../categories/");
    }
} else {
    header("Location: ../../login/");
}
