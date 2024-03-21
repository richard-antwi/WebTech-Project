<?php
include '../connection.php'; // Ensure the path to your connection script is correct

if (isset($_POST['submit'])) { // Check if ID is set
    // Prepare and bind
    $stmt = $connection->prepare("UPDATE contacts SET name=?, email=?, message=?, submit_time=? WHERE id=?");
    $stmt->bind_param("ssssi", $_POST['name'], $_POST['email'], $_POST['message'], $_POST['submit_time'], $_POST['id']);
    
    if ($stmt->execute()) {
        header("Location: messages.php");  
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
