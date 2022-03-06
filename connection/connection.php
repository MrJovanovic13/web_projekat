<?php
    // assumes database is already created on localhost
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "prodajahardvera";

    $conn = new mysqli($servername, $username, $password, $database);
    if($conn->connect_error)
    {
        die("Unsuccessful connection: " . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');