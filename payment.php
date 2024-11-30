<!-- payment.php -->
<?php
// Retrieve submitted data
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
$address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Information</title>
</head>
<body>
  <div class="container">
    <h3>Payment Information</h3>

    <!-- Display Email and Delivery Address -->
    <h4 id="deliveryDetails" rows="4" cols="50" readonly>
    Email: <?= $email ?><br>
    Address: <?= $address ?>
    </h4><br>

    <!-- Payment Form -->
    <form action="process_payment.php" method="POST">
      <input type="hidden" name="email" value="<?= $email ?>">
      <input type="hidden" name="address" value="<?= $address ?>">

      <label for="cardNumber">Card Number:</label>
      <input type="text" id="cardNumber" name="cardNumber" required><br><br>

      <label for="expiry">Expiry Date:</label>
      <input type="text" id="expiry" name="expiry" required><br><br>

      <label for="cvv">CVV:</label>
      <input type="text" id="cvv" name="cvv" required><br><br>

      <button type="submit">Submit Payment</button>
    </form>
  </div>
</body>
</html>
