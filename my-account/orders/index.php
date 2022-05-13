<?php
if ($_SERVER['REQUEST_METHOD']=="GET"){
    include("../view/orders.php");
    
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

} else {
    include("../view/orders.php");
    die();
}
