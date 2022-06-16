<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['userObj'])) {
    header("Location: ../../login");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB Store PH</title>
    <link rel="stylesheet" href="../../css/navbar.css">
    
</head>

<body>
    <ul class="header">
        <div class="left-navbar">

            <li><a href="../../home/">
                    <img class="logo" src="../../images/ITStore.gif" alt="logo"></i></a>
                </a></li>
        </div>
        <div class="right-navbar">
            <li><a href="../../products/">Home </a></li>
            <li><a href="../../products/">Products</a></li>
            <li><a href="../../cart/">Cart</a></li>
            <li><a href="../../my-account/">My account</a></li>
            <li><a href="../../logout/">Logout</a></li>

        </div>


    </ul>