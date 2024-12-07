<?php
session_start();

if (isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'])) {
    $productID = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];

    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
    }
    if (isset($_SESSION['basket'][$productID])) {
        $_SESSION['basket'][$productID]['quantity'] += 1;
    } else {

        $_SESSION['basket'][$productID] = [
            'id' => $productID,
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => 1
        ];
    }

    
    echo "<pre>";
    print_r($_SESSION['basket']);
    echo "</pre>";

    header('Location: Basket.php');
    exit();
} else {
    echo "Error: Missing product data.";
    exit();
}

