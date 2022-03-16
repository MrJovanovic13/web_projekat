<?php
if ($_SERVER['REQUEST_METHOD']=="GET"){
    include("../view/cart.php");
    
} else {
    header("Location: index.php"); 
    die();
}
?>