<?php
session_start();

// Here I am checking if all needed variables have been given
if (isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'])) {
    // and now storing all data into local variables
    $prodID = $_POST['product_id'];
    $prodNames = $_POST['product_name'];
    $prodPrices = $_POST['product_price'];

    // starts basket as empty array if it doesn't already exsits
    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
        } 
        // checks if product is already in basket
        if (isset($_SESSION['basket'][$prodID])) {
            // add to quantity if it is
        $_SESSION['basket'][$prodID]['quantity'] += 1;
    } else {
        //  other wise add it as new
        $_SESSION['basket'][$prodID] = [
            'id' => $prodID,
            'name' => $prodNames,
            'price' =>  $prodPrices,
            'quantity' => 1
        ];
        }
    header('Location: Basket.php');
    exit();
} else {
    echo "Error: Missing Dataa ";
    exit();
}

