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
            <img src="" alt="Sugar Rush Logo" class="basket-logo">
            <h1 class="basket-title">Items</h1>
        </header>

        <!-- Basket Items -->
        <div class="basket-items">
            <div class="basket-item">
                <img src="sweet 1.jpeg" alt="Sweet 1" class="basket-item-img">
                <div class="item-details">
                    <h3 class="item-title">?</h3>
                    <p class="item-price">£?</p>
                    <div class="quantity-container">
                        <label for="quantity-1" class="quantity-label">Qty:</label>
                        <input type="number" id="quantity-1" value="1" min="1" class="quantity-input">
                    </div>
                </div>
                <button class="remove-btn">Remove</button>
            </div>

            <div class="basket-item">
                <img src="sweet 2.webp" alt="Sweet 2" class="basket-item-img">
                <div class="item-details">
                    <h3 class="item-title">?</h3>
                    <p class="item-price">£?</p>
                    <div class="quantity-container">
                        <label for="quantity-2" class="quantity-label">Qty:</label>
                        <input type="number" id="quantity-2" value="1" min="1" class="quantity-input">
                    </div>
                </div>
                <button class="remove-btn">Remove</button>
            </div>
        </div>

        <!-- Basket Summary -->
        <div class="basket-summary">
            <h3>Total:<span class="total-price"> £?</span></h3>
            <button class="checkout-btn">Proceed to Checkout</button>
        </div>
    </div>
</body>
</html>