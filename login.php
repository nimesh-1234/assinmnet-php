<?php  
include 'config.php';

if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    //select
    $query = "SELECT * FROM admins WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);
         $hash_password = $row['password'];

        // Hash 
        if(password_verify($password, $hash_password)){
            header("Location: admin_page.php");
            exit();
        } else {
            echo "<script>alert('Invalid user name or password');</script>";
            header("Location: menu.php");
            exit();
        }

    } 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>

    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">

    <div class="login-page">

        <form action="" method="post" class="login-form">

            <h2>Login</h2>

            <input type="text" name="username" placeholder="Username" class="input" required><br><br>

            <input type="password" name="password" placeholder="Password" class="input" required><br><br>

            <input type="submit" value="Login" class="login-page-btn" name="submit">

        </form>
    </div>
</body>
</html>