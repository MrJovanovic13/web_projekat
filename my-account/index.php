<?php
session_start();

if(isset($_SESSION['userObj'])){
    header("Location: dashboard/");
} else {
    header("Location: ../login/");
}


?>