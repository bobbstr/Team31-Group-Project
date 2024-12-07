<?php
session_start();
include("database.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

// Initialize the basket if it doesn't exist
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}

// Handle quantity update or item removal
if (isset($_POST['update_cart'])) {
    $productID = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity of the product in the basket
    if ($quantity <= 0) {
        unset($_SESSION['basket'][$productID]); // Remove item if quantity is 0 or less
    } else {
        $_SESSION['basket'][$productID]['quantity'] = $quantity;
    }
}

if (isset($_POST['remove_item'])) {
    $productID = $_POST['product_id'];
    unset($_SESSION['basket'][$productID]); // Remove item from basket
}

// Get product details from the database
$productDetails = [];
foreach ($_SESSION['basket'] as $productID => $basketItem) {
    $stmt = $conn->prepare("SELECT ProductID, ProductName, ProductPrice, ProductImage FROM products WHERE ProductID = ?");
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $stmt->bind_result($productID, $productName, $productPrice, $productImage);
    if ($stmt->fetch()) {
        $productDetails[$productID] = [
            'name' => $productName,
            'price' => (float)$productPrice, // Ensure it's a float
            'image' => $productImage,
            'quantity' => $basketItem['quantity'] // Use the quantity from the session basket
        ];
    }
    $stmt->close();
}

// Calculate the total price
$totalPrice = 0;
foreach ($productDetails as $product) {
    $totalPrice += $product['price'] * $product['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
    <link rel="stylesheet" href="Basket.css">
</head>
<body>
    <div class="basket-container">
        <header class="basket-header">
            <img src="Logo.jpg.png" alt="Sugar Rush Logo" class="basket-logo">
            <h1 class="basket-title">Your Basket</h1>
        </header>

        <!-- Basket Items -->
        <div class="basket-items">
            <?php if (!empty($productDetails)): ?>
                <?php foreach ($productDetails as $productID => $product): ?>
                    <div class="basket-item">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="basket-item-img">
                        <div class="item-details">
                            <h3 class="item-title"><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="item-price">£<?= number_format($product['price'], 2) ?></p>
                            <div class="quantity-container">
                                <form action="basket.php" method="POST">
                                    <label for="quantity-<?= $productID ?>" class="quantity-label">Qty:</label>
                                    <input type="number" id="quantity-<?= $productID ?>" name="quantity" value="<?= $product['quantity'] ?>" min="1" class="quantity-input">
                                    <input type="hidden" name="product_id" value="<?= $productID ?>">
                                    <button type="submit" name="update_cart" class="update-btn">Update</button>
                                </form>
                            </div>
                        </div>
                        <form action="basket.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $productID ?>">
                            <button type="submit" name="remove_item" class="remove-btn">Remove</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Your basket is empty.</p>
            <?php endif; ?>
        </div>

        <!-- Basket Summary -->
        <div class="basket-summary">
            <h3>Total: <span class="total-price">£<?= number_format($totalPrice, 2) ?></span></h3>
            <a href="shipping.php"><button class="checkout-btn">Proceed to Checkout</button></a>
        </div>
    </div>
</body>
</html>
