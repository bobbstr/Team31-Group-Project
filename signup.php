<?php
require 'database.php';
session_start();

if (isset($_POST["submit"])) {
    $fname = trim($_POST["FirstName"]);
    $lname = trim($_POST["LastName"]);
    $email = trim($_POST["Email"]);
    $password = $_POST["Password"];
    
    // Get account type from form
    $accountType = isset($_POST["accountType"]) ? intval($_POST["accountType"]) : 0;
    
    // Validate account type (0 for customer, 1 for admin, 2 for business)
    if ($accountType != 0 && $accountType != 2) {
        $accountType = 0; // Default to customer if invalid
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }
    
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long!";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Securely hash password

    // Update query to include the admin column
    $query = "INSERT INTO userid (firstname, lastname, email, password, admin) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Add the accountType parameter to the bind_param part
        mysqli_stmt_bind_param($stmt, "ssssi", $fname, $lname, $email, $hashed_password, $accountType);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['user'] = [
                'firstname' => $fname,
                'lastname' => $lname,
                'email' => $email,
                'admin' => $accountType // This will store account type in session
            ];
            echo "<script> alert('Successfully created an account!');
            window.location.href = 'index.php';
            </script>";
        } else {
            echo "<script> alert('Error creating account');
            window.location.href = 'index.php';
            </script>";
        }
    } else {
        echo "Failed to prepare statement: ";
    }
}

mysqli_close($conn); // Close the database connection
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sugar Rush</title>
    <link rel="stylesheet" type="text/css" href="signupc.css" />
</head>
<body>
    
    <header id="mainHeader">
        <a href="index.php">
            <img src="Logo.jpg.png" alt="Sugar Rush Logo" class="logo">
        </a>
        <h1>Sugar Rush</h1>
    </header>

    <main class="content">
        <section class="signup">
            <h2>Sign up</h2>
        
            <form action="" method="POST">
                <div>
                    <label for="FirstName">First Name</label>
                    <input type="text" id="FirstName" name="FirstName" placeholder="First Name" required>
                </div>
                <div>
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="LastName" placeholder="Last Name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="Email" placeholder="Email" required>
                </div>
                <div>
                    <label for="Password">Password</label>
                    <input type="password" id="Password" name="Password" placeholder="Password" required>
                </div>
                <div>
                <label for="accountType">Account Type</label>
                    <select id="accountType" name="accountType">
                        <option value="0">Customer</option>
                        <option value="2">Business</option>
                    </select>
                </div>
                
                <div class="Sign up">
                    <input type="submit" name="submit" value="Sign up" class="account">
                </div>

                <p id="loginLink">Already have an account? <a href="login.php">Log in now</a></p>
            </form>
        </section>
    </main>
</body>
</html>
