<?php
$servername = "localhost";
$username = "root";
$password ="";
$database ="web_tech_project";

$connection = mysqli_connect($servername, $username, $password,$database);

if(!$connection){
    die("connection fialed" . mysqli_connect_error());
}else{
    echo"Connection successful";
}

?>