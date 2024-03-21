<?php
include '../connection.php'; // Ensure the path to your connection script is correct

if (isset($_POST['submit'])) { // Check if ID is set
    // Prepare and bind
    $stmt = $connection->prepare("UPDATE users SET username=?, first_name=?, last_name=?, date_of_birth=? WHERE id=?");
    $stmt->bind_param("ssssi", $_POST['username'], $_POST['first_name'], $_POST['last_name'], $_POST['date_of_birth'], $_POST['id']);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");  
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
