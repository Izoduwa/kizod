<?php
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get POST data 
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $projectType = isset($_POST['projectType']) ? trim($_POST['projectType']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

    $newMessage = $projectType . ': <br/>' . $message;
    // Validate form fields 
    if (empty($name)) {
        $errors[] = 'Name is empty';
    }
    if (empty($email)) {
        $errors[] = 'Email is empty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }
    if (empty($message)) {
        $errors[] = 'Message is empty';
    }
    // If no errors, send email 
    if (empty($errors)) {
        // Recipient email address (replace with your own) 
        $recipient = "kizodtechnology@gmail.com";
        // Additional headers 
        $headers = "From: $name <$email>";
        /*echo $newMessage;*/
        // Send email 
        if (mail($recipient, $newMessage, $headers)) {
            echo "Email sent successfully!";
        } else {
            echo "Failed to send email. Please try again later.";
        }
    } else {
        // Display errors 
        echo "The form contains the following errors:<br>";
        foreach ($errors as $error) {
            echo "- $error<br>";
        }
    }
} else {
    // Not a POST request, display a 403 forbidden error 
    header("HTTP/1.1 403 Forbidden");
    echo "You are not allowed to access this page.";
}
