<?php
    include("database.php");
    global $conn;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SugarRush</title>
    <link rel="stylesheet" type="text/css" href="home.css" />
    <link rel="stylesheet" type="text/css" href="/styles/product.css" />
</head>
<body>
<!-- <script src="index.js"></script>
-->
<header>
    <div class="mbar">
        <div class = "bar">
            <p>bar</p>
        </div>
        <div>
            <a href="/index.php"><img src="real.png" alt="Sugar Rush Logo" class="log"></a>
        </div>
        <div class="search">
            <form action="/search.php" method="GET" onsubmit="window.location = '/search.php?q=' + search.value.replace(/ /g, '+'); return false;">
                <input id="search" type="text" class="search_i" placeholder="Search...">
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="section">
            <p><a href="/search.php?q=sweets">Sweets</a>      <a href="/search.php?q=chocolate">Chocolate</a>     <a href="/search.php?q=savoury">Savoury</a>      <a href="/search.php?q=mix">Pick-N-mix</a>       <a href="/search.php?q=drinks">Drinks</a></p>
        </div>
    </div>
    <div class="product-zone">
        <?php
        $productIdentifier =  $_GET['id'];

        $sqlQuery = "SELECT * FROM products WHERE ProductID = $productIdentifier";

        if ($result = mysqli_query($conn, $sqlQuery))
        {
            if (mysqli_num_rows($result) > 0)
            {
                while ($row = mysqli_fetch_array($result))
                {
                    echo "<table style='width: 100%'>";
                    echo "<td> <img src='".$row['ProductImage']."' alt='".$row['ProductBrand']."' class='product-image'/></td>";
                    echo "<td><b>".$row['ProductName']."</b>";
                    echo "\n\n<b>Price</b>: £".$row['ProductPrice']." ";
                    echo "<button>Add To Basket</button>";
                    echo "\n\n<b>Description: </b>".$row['ProductDescription']."</td>";
                    echo "</table>";
                }

                mysqli_free_result($result);
            }
            else
            {
                echo "Product Not Found.";
            }
        }
        else
        {
            echo "Error with execution of query. ".mysqli_error($conn);
        }
        mysqli_close($conn);
        ?>
    </div>
</header>
