<?php
if ($_SERVER['REQUEST_METHOD']=="GET"){
    include("../view/home.php");
    
} else {
    header("Location: index.php"); 
    die();
}
?>