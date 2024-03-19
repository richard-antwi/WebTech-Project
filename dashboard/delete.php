<?php
include '../connection.php'; // Database connection

// Prompt for confirmation before actual deletion
if (isset($_POST['action']) && $_POST['action'] == 'confirm_delete') {
    $id = $_POST['id'];
    // Redirect to a confirmation page or render a confirmation message here
    // For simplicity, let's render a confirmation in the same script
    echo "<h2>Are you sure you want to delete this record?</h2>
          <form action='delete.php' method='post'>
            <input type='hidden' name='id' value='{$id}'>
            <input type='hidden' name='confirm_delete' value='yes'>
            <button type='submit'>Yes, delete it!</button>
          </form>
          <a href='dashboard.php'>Cancel</a>";
    exit;
}

// Handle actual deletion after confirmation
if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
    $id = $_POST['id'];

    $stmt = $connection->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Record deleted successfully, redirect or display a message
        header("Location: dashboard.php?message=Record deleted successfully");
    } else {
        echo "Error deleting record.";
    }

    $stmt->close();
    $connection->close();
    exit;
}
?>
