<?php
if ($_SERVER['REQUEST_METHOD']=="GET"){
    include("../view/login.php");
    
} else {
    header("Location: index.php"); 
    die();
}
?>