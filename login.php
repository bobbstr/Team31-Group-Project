<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sugar Rush</title>
    <link rel="stylesheet" type="text/css" href="loginc.css" />
</head>
<body>
    
    <header id="mainHeader">
        <img src="Logo.jpg.png" alt="Sugar Rush Logo" class="logo">
        <h1>Sugar Rush</h1>
    </header>

    <section class="login">
        <h2>Log in</h2>
    
        <form action="/action_page.php">
            <div>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <label for="Password">Password</label>
                <input type="password" id="Password" name="Password" placeholder="Password" required>
            </div>
            
            <div class="Sign in">
                <input type="submit" value="Sign in">
            </div>

            <p>New customer? <a href="signup.php">Create an account</a></p>
        </form>
    </section>
</body>
</html>


