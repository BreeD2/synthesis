<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $email = filter_var($_POST['signupEmail'], FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['signupUsername'], FILTER_SANITIZE_STRING);
    $password = $_POST['signupPassword']; // In a real application, ensure to hash the password

    // Validate input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } elseif (empty($username)) {
        echo "Username is required";
    } elseif (empty($password)) {
        echo "Password is required";
    } else {
        // Here, you would typically insert the data into a database
        // For demonstration, we'll just display a success message
        echo "Signup successful!";

        // Redirect to login page
        header("Location: login.html");
        exit();
    }
} else {
    // Not a POST request, redirect back to the signup form
    header("Location: signup.html");
    exit();
}
?>
