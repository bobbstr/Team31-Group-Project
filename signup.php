<?php
require 'database.php'; // Ensure this path is correct

// Sign up
if (isset($_POST["submit"])) {
    $fname = $_POST["FirstName"];
    $lname = $_POST["LastName"];
    $email = $_POST["Email"];
    $password = password_hash($_POST["Password"], PASSWORD_DEFAULT); // Hash the password

    // Prepare and bind
    $query = "INSERT INTO userid (username, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $fname, $email, $password); // Bind variables to the prepared statement
        $result = mysqli_stmt_execute($stmt); // Execute the prepared statement
        
        if ($result) {
            echo 'Successfully created an account';
        } else {
            echo 'Failed to create account!';
        }
        
        mysqli_stmt_close($stmt); // Close the statement
    } else {
        echo 'Failed to prepare statement!';
    }
}

mysqli_close($conn); // Close the connection
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
