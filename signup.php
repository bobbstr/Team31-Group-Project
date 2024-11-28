<?php
require 'database.php'; // Include the database connection

if (isset($_POST["submit"])) {
    $fname = trim($_POST["FirstName"]);
    $lname = trim($_POST["LastName"]);
    $email = trim($_POST["Email"]);
    $password = $_POST["Password"];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Validate password (e.g., minimum 8 characters)
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long!";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Securely hash password

    // Prepare and bind the MySQLi statement
    $query = "INSERT INTO userid (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $fname, $lname, $email, $hashed_password);

        if (mysqli_stmt_execute($stmt)) {
            echo "Successfully created an account!";
        } else {
            echo "Failed to create account: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt); // Close the prepared statement
    } else {
        echo "Failed to prepare statement: " . mysqli_error($conn);
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
        <img src="Logo.jpg.png" alt="Sugar Rush Logo" class="logo">
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
                
                <div class="Sign up">
                    <input type="submit" name="submit" value="Sign up" id="regSubmit">
                </div>

                <p id="loginLink">Already have an account? <a href="login.php">Log in now</a></p>
            </form>
        </section>
    </main>
</body>
</html>
