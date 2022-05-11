<?php
if ($_SERVER['REQUEST_METHOD']=="GET"){
    include("../view/products.php");
    
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

} else {
    include("../view/products.php");
    die();
}
