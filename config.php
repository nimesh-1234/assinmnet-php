<?php 

$localhost = "localhost";
$username = "root";
$password = "";
$db = "cofeeshop_db";

$conn = mysqli_connect($localhost, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else {
     
}


?>