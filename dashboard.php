<?php
session_start();
require '../database.php';

// Check if user is logged in and is a business account
if(!isset($_SESSION['email']) || $_SESSION['admin'] != 2) {
    header("Location: ../login.php");
    exit();
}

// Get business account details
$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT firstname, lastname FROM userid WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($firstname, $lastname);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Business Dashboard - Sugar Rush</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../index.css" />
    <link rel="stylesheet" type="text/css" href="../styles/dashboard.css" />
</head>
<body>
    <header>
        <div class="mbar">
            <a href="../index.php"><img src="../Logo.jpg.png" alt="Sugar Rush Logo" class="log"></a>
            <h1>Business Dashboard</h1>
            <div class="log_sin">
                <a href="../logout.php"><button class="account">Log Out</button></a>
            </div>
        </div>
    </header>

    <main>
        <h2>Welcome, <?php echo htmlspecialchars($firstname . ' ' . $lastname); ?>!</h2>
        
        <section class="dashboard-section">
            <h3>Your Business Functions</h3>
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h4>Order Management</h4>
                    <p>View and manage your bulk orders</p>
                    <a href="orders.php" class="dashboard-button">Manage Orders</a>
                </div>
                <div class="dashboard-card">
                    <h4>Bulk Purchases</h4>
                    <p>Place new bulk orders at wholesale prices</p>
                    <a href="bulk-order.php" class="dashboard-button">New Order</a>
                </div>
                <div class="dashboard-card">
                    <h4>Account Settings</h4>
                    <p>Update your business information</p>
                    <a href="settings.php" class="dashboard-button">Settings</a>
                </div>
            </div>
        </section>
        
        <section class="dashboard-section">
            <h3>Recent Orders</h3>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- This would be populated from the database -->
                    <tr>
                        <td colspan="5">No recent orders found.</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <!-- Footer content (same as other pages) -->
        <div class="footerCopyright">
            <p>© Copyright - SugarRush.com 2024. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>