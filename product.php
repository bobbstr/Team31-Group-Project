<?php
include("database.php");
session_start();
global $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
$anAdmin = isset($_SESSION['admin']) && $_SESSION['admin'];
$isBusinessAccount = isset($_SESSION['business']) && $_SESSION['business'];
$prodIDentifier = isset($_GET['id']) ? intval($_GET['id']) : 0;

$productDetails = null;
if ($prodIDentifier > 0) {
    $stmt = $conn->prepare("SELECT ProductID, ProductBrand, ProductName, ProductCategory, ProductImage, ProductWeight, ProductPrice, InStock FROM products WHERE ProductID = ?");
    $stmt->bind_param("i", $prodIDentifier);
    $stmt->execute();
    $stmt->bind_result($prodID, $productBrand, $prodNames, $productCategory, $productImage, $productWeight,  $ProductPrice, $inStock);
    if ($stmt->fetch()) {
        $productDetails = array(
            'ProductID' => $prodID,
            'ProductBrand' => $productBrand,
            'ProductName' => $prodNames,
            'ProductCategory' => $productCategory,
            'ProductImage' => $productImage,
            'ProductWeight' => $productWeight,
            'ProductPrice' =>  $ProductPrice,
            'InStock' => $inStock
        );
    }
    $stmt->close();
}

if ($anAdmin && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle admin form submission to update the product details
    $updatedProductName = $_POST['ProductName'];
    $updatedProductBrand = $_POST['ProductBrand'];
    $updatedProductCategory = $_POST['ProductCategory'];
    $updatedProductImage = $_POST['ProductImage'];
    $updatedProductWeight = $_POST['ProductWeight'];
    $updatedProductPrice = $_POST['ProductPrice'];
    $updatedInStock = $_POST['InStock'];

    $updateQuery = "UPDATE products 
                    SET ProductName = ?, ProductBrand = ?, ProductCategory = ?, ProductImage = ?, ProductWeight = ?, ProductPrice = ?, InStock = ?
                    WHERE ProductID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssdiis", $updatedProductName, $updatedProductBrand, $updatedProductCategory, $updatedProductImage, $updatedProductWeight, $updatedProductPrice, $updatedInStock, $prodIDentifier);
    $stmt->execute();
    $stmt->close();

    // Reload the product details after update
    header("Location: product.php?id=$prodIDentifier");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SugarRush</title>
    <link rel="stylesheet" type="text/css" href="index.css" />
    <link rel="stylesheet" type="text/css" href="styles/product.css" />
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
                <?php if (isset($_SESSION['email'])):?>
                    <a href="Basket.php" aria-label="Basket" class="Basket">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                            <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </a>
                    <a href="orders.php?q="><button class="account">Orders</button></a>
                    <a href="logout.php"><button class="account">Log Out</button></a>
                <?php else: ?>
                    <a href="Basket.php" aria-label="Basket" class="Basket">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                     <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9zM1 7v1h14V7zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5m2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5"/>
                      </svg>
                </a>
                    <a href="login.php"><button class="account">Log In</button></a>  
                    <a href="signup.php"><button class="account">sign Up</button></a>
                <?php endif; ?>                    
            </div>   
        </div>

        <center>
            <div class="search">
                <form class="search_i" action="search.php" method="GET" onsubmit="window.location = 'search.php?q=' + search.value.replace(/ /g, '+'); return false;">
                    <input id="search" type="text" class="search_i" placeholder="Search...">
                    <input type="submit" value="Search" class="account">
                </form>
            </div>
        </center>

            <div class="section">
                <p><a href="search.php?q=sweets" class="filter_button" id="sweets">Sweets</a> <!-- "id=" is used to control background colour independently for each filter button.-->
                <a href="search.php?q=chocolate" class="filter_button" id="chocolate">Chocolate</a>
                <a href="search.php?q=savoury" class="filter_button" id="savoury">Savoury</a>
                <a href="search.php?q=drinks" class="filter_button" id="drinks">Drinks</a>
                <a href="search.php?q=biscuits" class="filter_button" id="biscuits">Biscuits</a>
                <a href="search.php?q=" class="filter_button" id="all">All</a></p>
            </div>
    </div>
    <br/>
    <br/>
    <div class="product-zone">
        <?php
            if ($productDetails) {
                echo "<table style='width: 100%; border-collapse: collapse;'>";
                echo "<tr>";

                // Retrieving description and ingredients from product_descriptions table.
                $descriptionQuery = "SELECT * FROM product_descriptions WHERE DescriptionID = $prodIDentifier";
                $resultArray = $conn -> query($descriptionQuery);
                $description = $resultArray -> fetch_array()['DescriptionContent'];
                mysqli_free_result($resultArray);

                $ingredientsQuery = "SELECT * FROM product_descriptions WHERE DescriptionID = $prodIDentifier";
                $resultArray = $conn -> query($ingredientsQuery);
                $ingredients = $resultArray -> fetch_array()['Ingredients'];
                mysqli_free_result($resultArray);

                // Product Image
                echo "<td style='width: 30%;'>";
                echo "<img src='" . htmlspecialchars($productDetails['ProductImage']) . "' 
                          alt='" . htmlspecialchars($productDetails['ProductBrand'] . " image") . "' 
                          class='product-image' />";
                echo "</td>";
            
                // Product Details (for Admin, show input fields)
                echo "<td style='vertical-align: top; padding-left: 15px;'>";
                echo "<b>" . htmlspecialchars($productDetails['ProductName']) . "</b><br/>";
                $displayPrice = $productDetails['ProductPrice'];
                if ($isBusinessAccount) {
                    $displayPrice = $displayPrice * 0.85; // 15% discount
                    echo "<b>Price:</b> <strike>£" . htmlspecialchars($productDetails['ProductPrice']) . "</strike> £" . htmlspecialchars(number_format($displayPrice, 2)) . " (15% Business Discount)<br/>";
                } else {
                    echo "<b>Price:</b> £" . htmlspecialchars($productDetails['ProductPrice']) . "<br/>";
                }
                echo "<b>Description: </b> " . htmlspecialchars($description) . "<br/>";
                echo "<b>Ingredients: </b> " . htmlspecialchars($ingredients) . "<br/>";

                if ($anAdmin) {
                    // Admin can edit product details
                    echo "<form action='product.php?id=$prodIDentifier' method='POST'>";
                    echo "<b>Product Name:</b> <input type='text' name='ProductName' value='" . htmlspecialchars($productDetails['ProductName']) . "' required /><br/>";
                    echo "<b>Product Brand:</b> <input type='text' name='ProductBrand' value='" . htmlspecialchars($productDetails['ProductBrand']) . "' required /><br/>";
                    echo "<b>Product Category:</b> <input type='text' name='ProductCategory' value='" . htmlspecialchars($productDetails['ProductCategory']) . "' required /><br/>";
                    echo "<b>Product Image URL:</b> <input type='text' name='ProductImage' value='" . htmlspecialchars($productDetails['ProductImage']) . "' required /><br/>";
                    echo "<b>Product Weight:</b> <input type='number' name='ProductWeight' value='" . htmlspecialchars($productDetails['ProductWeight']) . "' required /><br/>";
                    echo "<b>Price (£):</b> <input type='number' name='ProductPrice' value='" . htmlspecialchars($productDetails['ProductPrice']) . "' required /><br/>";
                    echo "<b>In Stock:</b> <input type='number' name='InStock' value='" . htmlspecialchars($productDetails['InStock']) . "' required /><br/>";
                    echo "<button class='account' type='submit'>Save Changes</button>";
                    echo "</form>";
                } else {
                    // Normal user can only add to basket
                    echo "<form action='basketAdd.php' method='POST'>";
                    echo "<input type='hidden' name='product_id' value='" . $productDetails['ProductID']."'/>";
                    echo "<input type='hidden' name='product_name' value='" . htmlspecialchars($productDetails['ProductName'])."' />";
                    echo "<input type='hidden' name='product_price' value='" . htmlspecialchars($productDetails['ProductPrice'])."'/>";

                    // Apply 15% discount for business accounts
                    $price = $productDetails['ProductPrice'];
                    if ($isBusinessAccount) {
                        $price = $price * 0.85; // 10% discount
                        echo "<p><strong>Business discount applied: 10% off</strong></p>";
                    }

                    // Set quantity limits based on account type
                    $maxQty = $isBusinessAccount ? 100 : 5;
                    echo "<label for='quantity'>Quantity (max $maxQty):</label>";
                    echo "<input type='number' id='quantity' name='quantity' min='1' max='$maxQty' value='1'><br>";
                    
                    echo "<button class='account' type='submit'>Add to Basket</button>";
                    echo "</form>";
                }

                echo "</td>";
                echo "</tr>";
                echo "</table>";
            } else {
                echo "Product Not Found.";
            }
        ?>
    </div>
</header>

<br/>
<br/>

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
            <li><a href="contactUs.php">Contact Us</a></li>
            <li><a href="aboutUs.php">About us</a></li>


                </ul>
            </nav>
        </div>


        <div class="footerSocial">
            <h2>Follow Us</h2>
            <p>Stay connected through our social media profiles:</p>
            <div class="socialIcons">
                <a href="https://gb.linkedin.com/" aria-label="LinkedIn" class="socialIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                    </svg>
                </a>
                <a href="https://github.com/" aria-label="GitHub" class="socialIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
                    </svg>
                </a>
                <a href="https://en-gb.facebook.com/" aria-label="Facebook" class="socialIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                    </svg>
                </a>
                <a href="https://www.instagram.com/" aria-label="Instagram" class="socialIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                    </svg>
                </a>
                <a href="https://www.twitter.com/" aria-label="Twitter" class="socialIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16" width="25" height="25">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="footerLegal">
            <div class="legalLinks">
                <a href="Privacy policy.pdf">Privacy Policy</a>
                <span>|</span>
                <a href="Terms and Conditions.pdf">Terms & Conditions</a>
            </div>
        </div>
        
        <div class="footerCopyright">
            <p>© Copyright - SugarRush.com 2024. All rights reserved.</p>
        </div>

        </footer>

</body>
</html>
