<?php
session_start();

if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [
        ['name' => 'Chocolate Bar', 'quantity' => 2, 'price' => 1.99],
        ['name' => 'Gummy Bears', 'quantity' => 1, 'price' => 3.50],
        ['name' => 'Lollipop', 'quantity' => 3, 'price' => 0.99]
    ];
    }
    $totalPrice = 0;
    foreach ($_SESSION['basket'] as $item) {
        $totalPrice += $item['quantity'] * $item['price'];
    }

    $_SESSION['total_price'] = $totalPrice;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['quantity'])) {
            foreach ($_SESSION['basket'] as $index => $item) {
                if (isset($_POST['quantity'][$index])) {
                    $_SESSION['basket'][$index]['quantity'] = (int)$_POST['quantity'][$index];
                }
            }
        }
        
        if (isset($_POST['remove'])) {
            $itemIndex = (int)$_POST['remove'];
            unset($_SESSION['basket'][$itemIndex]);
            $_SESSION['basket'] = array_values($_SESSION['basket']); 
        }
    }


    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';


    $totalPrice = 0;
    foreach ($_SESSION['basket'] as $item) {
        $totalPrice += $item['quantity'] * $item['price'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Information</title>
  <link rel="stylesheet" type="text/css" href="payment.css" />
  <link rel="stylesheet" type="text/css" href="index.css" />
</head>
<body>

<header>
    <div class="mbar">
        <div class="bar">
            <p></p>
        </div>
        <div id="flexLogo">
            <a href="index.php"><img src="Logo.jpg.png" alt="Sugar Rush Logo" class="log"></a>
            <div class="log_sin">
                <?php if (isset($_SESSION['email'])): ?>
                    <a href="logout.php"><button class="account">Log Out</button></a>
                <?php else: ?>
                    <a href="login.php"><button class="account">Log In</button></a>  
                <?php endif; ?>                    
                <a href="signup.php"><button class="account">Sign Up</button></a>
            </div>   
        </div>

        <center>
            <div class="search">
                <form class="search_i" action="/search.php" method="GET" onsubmit="window.location = 'search.php?q=' + search.value.replace(/ /g, '+'); return false;">
                    <input id="search" type="text" class="search_i" placeholder="Search...">
                    <input type="submit" value="Search" class="account">
                </form>
            </div>
        </center>

        <div class="section">
            <p>
                <a href="search.php?q=sweets">Sweets</a>
                <a href="search.php?q=chocolate">Chocolate</a>
                <a href="search.php?q=savoury">Savoury</a>    
                <a href="search.php?q=drinks">Drinks</a>       
                <a href="search.php?q=biscuits">Biscuits</a>    
                <a href="search.php?q=">All</a>
            </p>
        </div>
    </div>
</header>

  <div class="container">
    <div class="footerLogo1">
        <a href="index.php">
            <img src="Logo.jpg.png" alt="logo" width="auto" height="200px">
        </a>
    </div>

    <h3 class="pay_inf">Payment Information</h3>

    <h4 id="deliveryDetails" rows="4" cols="50" readonly>
      Email: <?= $email ?><br>
      Address: <?= $address ?>
    </h4><br>

    <div class="payment-section">
      <div class="basket">
        <h4>Your Basket</h4>
        <form action="" method="POST">
          <table>
            <thead>
              <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Remove</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($_SESSION['basket'] as $index => $item): ?>
                <tr>
                  <td><?= htmlspecialchars($item['name']) ?></td>
                  <td><input type="number" name="quantity[<?= $index ?>]" value="<?= $item['quantity'] ?>" min="1"></td>
                  <td>$<?= number_format($item['price'], 2) ?></td>
                  <td>$<?= number_format($item['quantity'] * $item['price'], 2) ?></td>
                  <td><button type="submit" class="account" name="remove" value="<?= $index ?>">Remove</button></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <h4>Total: $<?= number_format($totalPrice, 2) ?></h4>
          <button type="submit" class="account">Update Basket</button>
        </form>
      </div>

      <!-- Payment Form -->
      <div class="payment-form">
        <form action="success.php" method="POST" class="inf">
          <input type="hidden" name="email" value="<?= $email ?>">
          <input type="hidden" name="address" value="<?= $address ?>">

          <label for="cardNumber">Card Holder Name:</label>
          <input type="text" id="cardName" name="cardName" required class="exp"><br><br>

          <label for="cardNumber">Card Number:</label>
          <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 1234 1234 1234" required class="num" pattern="\d{4} \d{4} \d{4} \d{4}"><br><br>

          <label for="expiry">Expiry Date:</label><br>
          <input type="month" id="expiry" name="expiry" required class="exp"  placeholder="MM/YY" pattern="(0[1-9]|1[0-2])\/\d{2}"><br><br>

          <label for="cvv">CVV:</label><br>
          <input type="text" id="cvv" name="cvv" required class="cvv" placeholder="123" pattern="\d{3}"><br><br>

          <a href="success.php"><button type="submit" class="account">Submit Payment</button></a>
        </form>
      </div>
    </div>
  </div>

  <footer>
    <div class="footerLogo">
        <a href="index.php">
            <img src="Logo.jpg.png" alt="logo" width="100" height="100">
        </a>
    </div>

    <div class="footerNav">
        <h2>Our Pages</h2>
        <p>Use the links below to navigate between different pages:</p>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="">Contact Us</a></li>
                <li><a href="">Contact us</a></li>
                
            </ul>
        </nav>
    </div>

    <div class="footerSocial">
        <h2>Follow Us</h2>
        <p>Stay connected through our social media profiles:</p>
        <div class="socialIcons">
            <!-- Social media icons -->
        </div>
    </div>

    <div class="footerCopyright">
        <p>© Copyright - SugarRush.com 2024. All rights reserved.</p>
    </div>
  </footer>

</body>
</html> 
