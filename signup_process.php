<?php
include('connection.php');

if(isset($_POST['submit'])){
    // Correct function name is htmlspecialchars
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $date_of_birth = htmlspecialchars($_POST['date_of_birth']);

    // Correct way to call password_hash function
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $connection->prepare("INSERT INTO users (username, email, password_hash, first_name, last_name, date_of_birth) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $email, $password_hash, $first_name, $last_name, $date_of_birth); // 'ssssss' specifies the type of the variables passed to the statement ('s' = string)

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();

    // Optionally, close the connection if it's no longer needed
    // $connection->close();

    // It's generally not a good practice to echo inputs directly for security reasons
    // Consider redirecting to another page or displaying a success message
} else {
    echo "Form not submitted";
}
?>
