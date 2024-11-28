<?php
    $server = "localhost";
    $username = "db_user";
    $db_password = "password";
    $db_name = "sugarrush";

    global $conn;

    // Attempt to connect to the database
    $conn = mysqli_connect($server, $username, $db_password, $db_name);

    // Check database connection
    if ($conn) {
        echo "<!--You are connected! -->";
    } else {
        echo "<!--Could not connect: " . mysqli_connect_error() . "-->";
    }
?>
