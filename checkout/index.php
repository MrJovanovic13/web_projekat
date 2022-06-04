<?php
require "../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['userObj'])){
    include("../view/checkout.php");
} else {
    header("Location: ../login/");
}

?>