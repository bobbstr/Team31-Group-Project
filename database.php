<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db_name = "sugarrush";

    // Attempt to connect to the database
    $conn = mysqli_connect($server, $username, $password, $db_name);

    // Check database connection
    if ($conn) {
        echo "You are connected!";
    } else {
        echo "Could not connect: " . mysqli_connect_error();
    }
?>
