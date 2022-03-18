<?php
if ($_SERVER['REQUEST_METHOD']=="GET"){
    include("../view/login.php");
    
} elseif($_SERVER['REQUEST_METHOD']=="POST") {
    include("../view/404.php");
} else {
    header("Location: test.php"); 
    die();
}
?>