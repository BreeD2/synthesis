<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Replace 'your_server', 'your_username', 'your_password', and 'your_database' with your actual database details
$servername = "your_server";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Optionally, uncomment the following lines to check the received POST data
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit; // Remove this line once you've confirmed that form data is received correctly
*/

// Get user input from the form
$email = $_POST['signupEmail'] ?? '';
$username = $_POST['signupUsername'] ?? '';
$password = $_POST['signupPassword'] ?? '';

// Validate input
if (empty($email) || empty($username) || empty($password)) {
    echo "All fields are required.";
    exit;
}

// Hash the password
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// Prepare SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
if(!$stmt) {
    // Handle error when preparation fails (e.g., SQL syntax error)
    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    exit;
}

$stmt->bind_param("sss", $email, $username, $passwordHash);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    // Provides more detailed error information
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
