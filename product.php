<?php
include("database.php");
session_start();
global $conn;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
$anAdmin = isset($_SESSION['admin']) && $_SESSION['admin'];
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
                    <a href="logout.php"><button class="account">Log Out</button></a>
		    <a href="Basket.php"><button class="account">Basket</button></a>
                <?php else: ?>
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
            <p><a href="search.php?q=sweets">Sweets</a> <a href="search.php?q=chocolate">Chocolate</a> <a href="search.php?q=savoury">Savoury</a> <a href="search.php?q=drinks">Drinks</a> <a href="search.php?q=biscuits">Biscuits</a> <a href="search.php?q=">All</a></p>
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
                echo "<b>Price:</b> £" . htmlspecialchars($productDetails['ProductPrice']) . "<br/>";
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
                    echo "<form action='basketAdd.php' method='POST'>
                            <input type='hidden' name='product_id' value='" . $productDetails['ProductID']."'/>
                            <input type='hidden' name='product_name' value='" . htmlspecialchars($productDetails['ProductName'])."' />
                            <input type='hidden' name='product_price' value='" . htmlspecialchars($productDetails['ProductPrice'])."'/>
                            <button class='account' type='submit'>Add to Basket</button>
                          </form>";
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
                <li><a href="">Contact Us</a></li>
                <li><a href="">Contact us</a></li>
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
            <!-- Other social icons here -->
        </div>
    </div>
    
    <div class="footerCopyright">
        <p>© Copyright - SugarRush.com 2024. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
