<?php
global $conn;
include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SugarRush</title>
    <link rel="stylesheet" type="text/css" href="home.css" />
</head>
<body>

<?php


?>
<!-- <script src="index.js"></script>
-->
<header>
    <div class="mbar">
        <div class = "bar">
            <p>bar</p>
        </div>
        <div>
            <a href="index.php"><img src="real.png" alt="Sugar Rush Logo" class="log"></a>
        </div>
        <div class="search">
            <form action="/search.php" method="GET" onsubmit="window.location = '/search.php?q=' + search.value.replace(/ /g, '+'); return false;">
                <input id="search" type="text" class="search_i" placeholder="Search...">
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="section">
            <p>Home      Snack     Snack      Pick-a-mix       Snack</p>
        </div>
    </div>
    <div class="query-results">
        <?php
            $searchQuery =  $_GET['q'];

            $sqlQuery = "SELECT * FROM products WHERE ProductBrand LIKE '%$searchQuery%' OR ProductName LIKE '%$searchQuery%' OR ProductCategory LIKE '%$searchQuery%'";

            if ($result = mysqli_query($conn, $sqlQuery))
            {
                if (mysqli_num_rows($result) > 0)
                {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Brand</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_array($result))
                    {
                        echo "<tr>";
                        echo "<td>".$row['ProductBrand'] . "</td>";
                        echo "<td>".$row['ProductName']."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    mysqli_free_result($result);
                }
                else
                {
                    echo "No results found";
                }
            }
            else
            {
                echo "Error with execution of query. ".mysqli_error($conn);
            }
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>
