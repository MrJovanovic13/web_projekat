<?php
require_once "../controller/cartL.php";
require_once "../controller/user.php";
session_start();

if(isset($_SESSION['userObj'])){
    include("../view/checkout.php");
} else {
    header("Location: ../login/");
}

?>