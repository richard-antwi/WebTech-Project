<?php
include('connection.php');

session_start();

// Check if the form has been submitted
if(isset($_POST['send'])) { 
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Prepare and bind
    $stmt = $connection->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        header("Location: contactUs.html?message=success");
    } else {
        // Optionally pass an error code or message in a way that does not expose sensitive information
        header("Location: contactUs.html?message=error");
    }


    // Close statement
    $stmt->close();
}

// Always close the connection as the last action
$connection->close();
?>
