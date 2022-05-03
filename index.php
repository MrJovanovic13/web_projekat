<?php

if ($_SERVER['REQUEST_METHOD']=="GET"){
    header("Location: ./home/");
    
} else {
    header("Location: index.php"); 
    die();
}
?>