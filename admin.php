<?php
include 'config.php';

$admin_email = "admin@gmail.com";
$admin_pass= "123";

// password hash
$hashpassword = password_hash($admin_pass, PASSWORD_DEFAULT);

// Db
$sql = "INSERT INTO admins (username, password) VALUES ('$admin_email', '$hashpassword')";

if(mysqli_query($conn, $sql)){
    echo "Admin Created Successfully!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
