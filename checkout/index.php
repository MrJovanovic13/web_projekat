<?php
require "../vendor/autoload.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['userObj'])){

    $database = new Database();

    $user = unserialize($_SESSION['userObj']);
    $cartProducts = array();
    $cartTotal = 0;

    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if (isset($_SESSION['cart'][$i])) {
            $cartItemId = $_SESSION['cart'][$i]->id;
            $q = "SELECT `id`, `name`, `price` FROM `products` WHERE `id`=?";
            $stmt = $database->prepareQuery($q);
            $stmt->bind_param('i', $cartItemId);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $cartTotal += $row['price'] * $_SESSION['cart'][$i]->quantity;

            $cartProducts[] = New OrderProduct($row['id'],$row['name'],$row['price'],$_SESSION['cart'][$i]->quantity);
        }
    }
    include("../view/checkout.php");

} else {
    header("Location: ../login/");
}

?>