<?php
require_once "../controller/cartL.php";
require_once "../controller/product.php";
require_once "../connection/connection.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD']=="GET"){
    $cartTotal = 0;
    $cartProducts = array();
    $emptyCart = 0;
      if(isset($_SESSION['cart'])&&count($_SESSION['cart'])!=0)
      {
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
          if (isset($_SESSION['cart'][$i])) {
            $cartItemId = $_SESSION['cart'][$i]->id;
            $q = "SELECT `id`, `name`, `description`, `price`, `imgUrl`
                  FROM `products`
                  WHERE `id`=$cartItemId";
            $result = $conn->query($q);
            $row = $result->fetch_assoc();
  
            $cartTotal += $row['price'] * $_SESSION['cart'][$i]->quantity;
          }
          $cartProductObj = new CartProduct($cartItemId,$_SESSION['cart'][$i]->quantity,$row['name'], $row['price'], $row['imgUrl']);
          $cartProducts[] = $cartProductObj;
        }
      }
    if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
        $emptyCart = 1;
    }
    
      include("../view/cart.php");
} else {
    header("Location: index.php"); 
    die();
}
