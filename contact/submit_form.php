<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $firstName = htmlspecialchars(stripslashes(trim($_POST['firstName'])));
    $lastName = htmlspecialchars(stripslashes(trim($_POST['lastName'])));
    $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
    $message = htmlspecialchars(stripslashes(trim($_POST['message'])));

    // Specify the recipient email and subject
    $toEmail = 'your_email@example.com'; // Replace with your email address
    $subject = 'Contact Form Submission from ' . $firstName . ' ' . $lastName;

    // Prepare the email body text
    $body = "You have received a new message from your website contact form.\n\n";
    $body .= "Here are the details:\n";
    $body .= "First Name: $firstName\n";
    $body .= "Last Name: $lastName\n";
    $body .= "Email: $email\n";
    $body .= "Message:\n$message\n";

    // Set email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($toEmail, $subject, $body, $headers)) {
        echo "Thank You! Your message has been sent.";
    } else {
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
