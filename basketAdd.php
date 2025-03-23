<?php
session_start();

// Check if user is a business account
$isBusinessAccount = isset($_SESSION['business']) && $_SESSION['business'];
// Set max quantity based on account type
$maxQuantity = $isBusinessAccount ? 100 : 5;

// Here I am checking if all needed variables have been given
if (isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'])) {
    // and now storing all data into local variables
    $prodID = $_POST['product_id'];
    $prodNames = $_POST['product_name'];
    $ProductPrice = $_POST['product_price'];
    
    // Apply business discount if applicable
    if ($isBusinessAccount) {
        $ProductPrice = $ProductPrice * 0.85; // 15% discount
    }
    
    // Get quantity from form or default to 1
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    // Limit to max allowed quantity
    $quantity = min($quantity, $maxQuantity);

    // starts basket as empty array if it doesn't already exist
    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
    } 
    
    // checks if product is already in basket
    if (isset($_SESSION['basket'][$prodID])) {
        // add to quantity if it is, but keeps in mind maximum
        $newQuantity = $_SESSION['basket'][$prodID]['quantity'] + $quantity;
        $newQuantity = min($newQuantity, $maxQuantity);
        $_SESSION['basket'][$prodID]['quantity'] = $newQuantity;
    } else {
        // otherwise add it as new
        $_SESSION['basket'][$prodID] = [
            'id' => $prodID,
            'name' => $prodNames,
            'price' => $ProductPrice,
            'quantity' => $quantity
        ];
    }
    header('Location: Basket.php');
    exit();
} else {
    echo "Error: Missing Data";
    exit();
}