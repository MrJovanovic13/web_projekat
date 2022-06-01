<?php
if ($_SERVER['REQUEST_METHOD']=="GET"){
    header("Location: ../products/"); 
} else {
    header("Location: index.php"); 
    die();
}
?>