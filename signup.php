<?php
require 'database.php';

//sign up
if (isset($_POST["submit"])) {
    $fname = $_POST["FirstName"];
    $lname = $_POST["LastName"];
    $email = $_POST["Email"];
    $password = $_POST["Password"];

    $query = "INSERT INTO userid (username, email, password) VALUES (?, ?, ?, ?, ?);";
    $insert = $db->prepare($query);
    $result = $insert->execute([$name, $email, $password]);

    if ($result) {
        echo 'Successfully created an account';
    } else {
        echo 'Falied to create account!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sugar Rush</title>
    <link rel="stylesheet" type="text/css" href="signupc.css" />
</head>
<body>
    
    <header id="main-header">
        <img src="Logo.jpg.png" alt="Sugar Rush Logo" class="logo">
        <h1>Sugar Rush</h1>
    </header>

    <section class="signup">
        <h2>Sign up</h2>
    
        <form action="/action_page.php">
            <div>
                <label for="FirstName">First Name</label>
                <input type="text" id="FirstName" name="FirstName" placeholder="Name" required>
            </div>
            <div>
                <label for="lname">Last Name</label>
               <input type="text" id="lname" name="LastName" placeholder="Last Name" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="text" id="email" name="Email" placeholder="Email" pattern=".+(\.ac\.uk|\.edu)" required>
            </div>
            <div>
                <label for="Password">Password</label>
                <input type="password" id="Password" name="Password" placeholder="Password" required>
            </div>
            
            <div class="Sign up">
                <input type="submit" value="Sign up">
            </div>

            <p>Already have an account? <a href="login.html">Log in now</a></p>
        </form>
    </section>
</body>
</html>
