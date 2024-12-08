<?php
session_start();

$totalPrice = isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 0;
// This is just gettin the price we saved in payment.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SugarRush - Payment Successful</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="styles.css">
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


    <div class="success-card">
        <div class="success-icon">✓</div>
      <h1 class="success-heading">Success</h1>
        <p class="success-details">We received your purchase request;
            <br/> we'll be in touch shortly!</p>
        <p class="total-price">Total Paid: £<?= $totalPrice ?></p>
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
