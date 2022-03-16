<?php
if ($_SERVER['REQUEST_METHOD']=="GET"){
    include("../view/products.php");
    
} else {
    header("Location: index.php"); 
    die();
}
?>