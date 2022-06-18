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
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../../images/favicon.png">
    <title>IT Store</title>
</head>

<body>

    <section class="top-nav">
        <div>
            Logo Here
        </div>
        <input id="menu-toggle" type="checkbox" />
        <label class='menu-button-container' for="menu-toggle">
            <div class='menu-button'></div>
        </label>
        <ul class="menu">
            <li>One</li>
            <li>Two</li>
            <li>Three</li>
            <li>Four</li>
            <li>Five</li>
        </ul>
    </section>
    <!-- <ul class="header">
        <div class="left-navbar">
            <li><a href="../../home/">
                    <img class="logo" src="../../images/ITStore.gif" alt="logo"></i></a></a></li>
        </div>
        <div class="right-navbar" id="right-navbar">
            <li><a href="../../products/">Home </a></li>
            <li><a href="../../products/">Products</a></li>
            <li><a href="../../cart/">Cart</a></li>
            <li><a href="../../my-account/">My account</a></li>
            <li><a href="../../logout/">Logout</a></li>
        </div>
    </ul>  -->
    <script type="text/javascript" src="../../js/navbar.js"></script>