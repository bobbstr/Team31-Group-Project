<?php
session_start();
include("database.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}


if (isset($_POST['update_cart'])) {
    $prodID = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    if ($quantity <= 0) {
        unset($_SESSION['basket'][$prodID]); 
    } else {
        $_SESSION['basket'][$prodID]['quantity'] = $quantity;
    }
}

if (isset($_POST['remove_item'])) {
    $prodID = $_POST['product_id'];
    unset($_SESSION['basket'][$prodID]); 
}


$productDetails = [];
foreach ($_SESSION['basket'] as $prodID => $basketItem) {
    $stmt = $conn->prepare("SELECT ProductID, ProductName,  prodPrices, ProductImage FROM products WHERE ProductID = ?");
    $stmt->bind_param("i", $prodID);
    $stmt->execute();
    $stmt->bind_result($prodID, $prodNames,  $prodPrices, $productImage);
    if ($stmt->fetch()) {
        $productDetails[$prodID] = [
            'name' => $prodNames,
            'price' => (float) $prodPrices, 
            'image' => $productImage,
            'quantity' => $basketItem['quantity'] 
        ];
    }
    $stmt->close();
}
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
           <a href='index.php'><img src="Logo.jpg.png" alt="Sugar Rush Logo" class="basket-logo"></a>
            <h1 class="basket-title">Your Basket</h1>
        </header>

        <!-- Basket Items -->
        <div class="basket-items">
            <?php if (!empty($productDetails)): ?>
                <?php foreach ($productDetails as $prodID => $product): ?>
                    <div class="basket-item">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="basket-item-img">
                        <div class="item-details">
                            <h3 class="item-title"><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="item-price">£<?= number_format($product['price'], 2) ?></p>
                            <div class="quantity-container">
                                <form action="basket.php" method="POST">
                                    <label for="quantity-<?= $prodID ?>" class="quantity-label">Qty:</label>
                                    <input type="number" id="quantity-<?= $prodID ?>" name="quantity" value="<?= $product['quantity'] ?>" min="1" class="quantity-input">
                                    <input type="hidden" name="product_id" value="<?= $prodID ?>">
                                    <button type="submit" name="update_cart" class="account">Update</button>
                                </form>
                            </div>
                        </div>
                        <form action="basket.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $prodID ?>">
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
    <div class="back-button-container">
            <a href='index.php'>
                <button class="account">Back</button>
            </a>
        </div>
</body>
</html>
