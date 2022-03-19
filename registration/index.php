<?php
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    include("../view/registration.php");
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        //header("Location: ../view/registration.php");
        include("../view/registration.php");
} else {
    header("Location: 404.php");
    die();
}
?>