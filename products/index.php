<?php
if ($_SERVER['REQUEST_METHOD']=="GET"){
    include("../view/products.php");
    
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    include("../view/products.php");
} else {
    include("../view/products.php");
    die();
}
