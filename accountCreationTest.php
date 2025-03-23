<?php
$db_host = 'localhost';
$db_user = 'db_user';      
$db_pass = 'password';          
$db_name = 'sugarrush';  

// Test user details
$test_customer = 'test_customer_'.time().'@example.com';
$test_business = 'test_business_'.time().'@example.com';
$test_password = 'Test12345';

// Connect to database
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

echo "<h1> Authentication Test</h1>";

// Function to print test results
    function test_result($name, $success, $message = '') {
        echo "<p><strong>" . ($success ? "PASS" : "FAIL") . ":</strong> $name";
        if (!empty($message)) echo " - $message";
        echo "</p>";
    }

echo "<h2>1. Testing User Creation</h2>";

// Test creating a customer account
    $hashed_password = password_hash($test_password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO userid (firstname, lastname, email, password, admin) VALUES (?, ?, ?, ?, ?)");
    $fname = "Test";
    $lname = "Customer";
    $admin_val = 0; // Customer account has the ID of 0 
    $stmt->bind_param("ssssi", $fname, $lname, $test_customer, $hashed_password, $admin_val);

if ($stmt->execute()) {
    test_result("Create Customer Account", true, "Created customer with email: $test_customer");
} else {
        test_result("Create Customer Account", false, "Error: " . $stmt->error);
}

// Test creating a business account
    $admin_val = 2; // Business account hsas the id of 2
    $lname = "Business";
    $stmt->bind_param("ssssi", $fname, $lname, $test_business, $hashed_password, $admin_val);

    if ($stmt->execute()) {
        test_result("Create Business Account", true, "Created business with email: $test_business");
    } else {
        test_result("Create Business Account", false, "Error: " . $stmt->error);
    }

    $stmt->close();

echo "<h2>2. Testing User Login</h2>";

// Test customer login
$stmt = $conn->prepare("SELECT password, admin FROM userid WHERE email = ?");
$stmt->bind_param("s", $test_customer);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($db_password, $admin);
$stmt->fetch();

if ($stmt->num_rows > 0 && password_verify($test_password, $db_password)) {
    test_result("Customer Login", true, "Login successful for $test_customer with admin=$admin");
} else {
    test_result("Customer Login", false, "Login failed for $test_customer");
}

// Test business login
    $stmt->close();
    $stmt = $conn->prepare("SELECT password, admin FROM userid WHERE email = ?");
    $stmt->bind_param("s", $test_business);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($db_password, $admin);
    $stmt->fetch();

if ($stmt->num_rows > 0 && password_verify($test_password, $db_password)) {
    test_result("Business Login", true, "Login successful for $test_business with admin=$admin");
} else {
    test_result("Business Login", false, "Login failed for $test_business");
}

$stmt->close();

echo "<h2>3. Testing Logout</h2>";

// Test session management for logout
session_start();
$_SESSION['email'] = $test_customer;
$_SESSION['admin'] = 0;

if (isset($_SESSION['email'])) {
    test_result("Session Creation", true, "Session created with email: " . $_SESSION['email']);
    
    // Should logout
    session_destroy();
    session_start();
    
    if (!isset($_SESSION['email'])) {
        test_result("Logout", true, "Session successfully destroyed");
    } else {
        test_result("Logout", false, "Failed to destroy session");
    }
} else {
    test_result("Session Creation", false, "Failed to create session");
}

echo "<h2>4. Cleanup</h2>";

// Clean up test data by removing all new entries
$stmt = $conn->prepare("DELETE FROM userid WHERE email IN (?, ?)");
$stmt->bind_param("ss", $test_customer, $test_business);
$stmt->execute();
$affected = $stmt->affected_rows;
test_result("Cleanup", true, "Removed $affected test users");

$stmt->close();
$conn->close();
?>