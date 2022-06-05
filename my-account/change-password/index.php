<?php
require "../../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$database = new Database();
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
$user = unserialize($_SESSION['userObj']);
$userId = $user->id;

if (!isset($_SESSION['userObj'])) {
    header("Location: ../../login");
    die();
} else {
    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        include("../view/change-password.php");
    } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

        $validation = new ChangePasswordValidator($_POST);

        $password = isset($_POST['newPassword']) ? $validation->testInput($_POST['newPassword']) : "";

        $errors = [];

        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == "Change password") {
                $errors = $validation->validateForm();
                if (count($errors) > 0) {
                    include_once('../view/change-password.php');
                } else {
                    $password = sha1($password);
                    $q = "UPDATE `users` SET `password` = ? WHERE `id` = ?";
                    $stmt = $database->prepareQuery($q);
                    $stmt->bind_param('si', $password, $userId);
                    $stmt->execute();

                    header("Location: ../orders");
                }
            }
        } else {
            include_once('../view/change-password.php');
        }
    }
}
