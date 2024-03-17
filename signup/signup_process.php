<?php
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
$stmt->bind_param("sss", $email, $username, $passwordHash);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
