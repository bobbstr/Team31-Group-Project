<?php
include("database.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SugarRush</title>
    <link rel="stylesheet" type="text/css" href="index.css" />
    <link rel="stylesheet" type="text/css" href="styles/search.css" />
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
                <a href="search.php?q=sweets mix">Pick-N-mix</a>       
                <a href="search.php?q=drinks">Drinks</a>       
                <a href="search.php?q=biscuits">Biscuits</a>    
                <a href="search.php?q=">All</a>
            </p>
        </div>
    </div>
</header>

<div class="query-results">
    <?php
    if (isset($_GET['q'])) {
        $searchQuery = $_GET['q'];

        // Use prepared statements to avoid SQL injection
        $sqlQuery = "SELECT * FROM products WHERE ProductBrand LIKE ? OR ProductName LIKE ? OR ProductCategory LIKE ?";
        if ($stmt = $conn->prepare($sqlQuery)) {
            $searchTerm = "%$searchQuery%";
            $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='pic_img'>";
                    echo "<a href='product.php?id=".$row['ProductID']."'>";
                    echo "<img src='".$row['ProductImage']."' alt='".$row['ProductName']."' class='log2'/>";
                    echo "<p class='buy1'>".$row['ProductName']."</p>";
                    echo "</a></br>";
                    echo "\n\nPrice: £".$row['ProductPrice'];
                    
                    // Debugging: Output hidden inputs
                    echo "<form action='basketAdd.php' method='POST'>";
                    echo "<input type='hidden' name='product_id' value='".$row['ProductID']."' />";
                    echo "<input type='hidden' name='product_name' value='".htmlspecialchars($row['ProductName'])."' />";
                    echo "<input type='hidden' name='product_price' value='".htmlspecialchars($row['ProductPrice'])."' />";
                    echo "<button class='account' type='submit'>Add to Basket</button>";
                    echo "</form>";

                    
                    echo "</div>";
                }
            } else {
                echo "No results found";
            }
            $stmt->close();
        }
    }
    ?>
</div>

</body>
</html>
