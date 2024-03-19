<?php
include('../connection.php');

session_start();

if(isset($_POST['submit'])){
    // Sanitize and hash
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute insert statement
    $stmt = $connection->prepare("INSERT INTO admin_users (username, password_hash) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password_hash);
    if ($stmt->execute()) {
        header("Location: index.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

if(isset($_POST['login'])){
    // Sanitize input
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Prepare and execute select statement
    $stmt = $connection->prepare("SELECT * FROM admin_users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.html");
            exit;
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "User not found";
    }
    $stmt->close();
}

$connection->close();
?>
