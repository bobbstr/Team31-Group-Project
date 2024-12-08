<?php
    $server = "localhost";
    $username = "cs2team31";
    $db_password = "eXLMpE0LPGNmdjR";
    $db_name = "cs2team31_db";

    global $conn;
    $conn = mysqli_connect($server, $username, $db_password, $db_name);
    if ($conn) {
        echo "<!--You are connected! -->";
    } else {
        echo "<!--Could not connect: " . mysqli_connect_error() . "-->";
    }
?>
