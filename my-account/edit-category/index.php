<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$logController = new LogController();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : $_POST['categoryId'];
$nameCurrent;
$nameNew;

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_SESSION['userObj'])) {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {

        if ($action == 'editCategory') {
            $q = "SELECT `id`, `name`
            FROM `category` WHERE `id`=" . $categoryId;
            $result = $database->executeQuery($q);
            $row = $result->fetch_assoc();
            $name = $row['name'];
        }

        $categories = array();
        $q = "SELECT `id`, `name`
            FROM `category`";
        $result = $database->executeQuery($q);
        while ($row = $result->fetch_assoc()) {
            $categories[] = new Category($row['id'], $row['name']);
        }

        include("../view/edit-category.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

        //Name validation
        if (empty($_POST["name"])) {
            $nameErr = "You must input this field!";
        } else {
            $name = test_input($_POST["name"]);

            $q = "SELECT `name` 
            FROM `category`
            WHERE `name` = ? AND `id` != ?";

            $stmt = $database->prepareQuery($q);
            $stmt->bind_param('si', $name, $_POST['categoryId']);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows != 0) {
                $nameErr = "Category name already exists!";
            }
        }

        if (isset($nameErr)) {
            include("../view/edit-category.php");
            //unset($nameErr);
        } else {
            $nameNew = $_POST['name'];
            $q = "UPDATE `category` SET `name` = '$nameNew'
                WHERE `id` =" . $_POST['categoryId'];
            $result = $database->executeQuery($q);
            $message = "Succesfully edited category with ID:" . $_POST['categoryId'];
            $logController->log($message);
            header("Location: ../categories/");
        }
    }
} else {
    header("Location: ../../login/");
}
