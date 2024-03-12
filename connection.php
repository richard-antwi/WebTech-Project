<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "web_tech_project";

// Attempt to connect to the MySQL database
$connection = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connection successful";
}
?>
