<?php
include '../connection.php'; // Database connection

// Initial Delete Action from the Form
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    // Assuming Bootstrap CSS is included in your project
    echo "<div class='container mt-5'>
            <div class='card text-center'>
                <div class='card-header'>
                    Confirm Deletion
                </div>
                <div class='card-body'>
                    <h5 class='card-title'>Are you sure you want to delete this record?</h5>
                    <p class='card-text'>This action cannot be undone.</p>
                    <form action='delete.php' method='post'>
                        <input type='hidden' name='id' value='{$id}'>
                        <input type='hidden' name='confirm_delete' value='yes'>
                        <button type='submit' class='btn btn-danger'>Yes, delete it!</button>
                    </form>
                </div>
                <div class='card-footer text-muted'>
                    <a href='dashboard.php' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
          </div>";
    exit;
}


// Confirmation Received and Process Deletion
if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
    $id = $_POST['id'];

    $stmt = $connection->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Record deleted successfully, redirect or display a message
        header("Location: messages.php?message=Record deleted successfully");
    } else {
        echo "Error deleting record.";
    }

    $stmt->close();
    $connection->close();
    exit;
}
?>
