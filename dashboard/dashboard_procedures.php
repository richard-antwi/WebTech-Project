<?php
include '../connection.php'; // Include your database connection

// SQL to count total number of people
$sql = "SELECT COUNT(*) AS totalPeople FROM users";
$result = $connection->query($sql);

$totalPeople = 0;
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $totalPeople = $row["totalPeople"];
  }
} else {
  echo "0 results";
}


// SQL to count total number of people
$sql = "SELECT COUNT(*) AS totalAdmin FROM admin_users";
$result = $connection->query($sql);

$totalAdmin = 0;
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $totalAdmin = $row["totalAdmin"];
  }
} else {
  echo "0 results";
}

// SQL to count total number of people
$sql = "SELECT COUNT(*) AS messages FROM contacts";
$result = $connection->query($sql);

$messages = 0;
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $messages = $row["messages"];
  }
} else {
  echo "0 results";
}

//Query for the data in the data table
$sql = "SELECT username, first_name, last_name, date_of_birth FROM users";
$result = $connection->query($sql);


$connection->close();
?>
