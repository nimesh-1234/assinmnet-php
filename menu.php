<?php

@include 'config.php';

$query = "SELECT * FROM products";
$select_products = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="menu-body">

    <div class="menu-login">
        <a href="login.php" class="login-btn">Login</a>
    </div>

    <h1 class="title">Our Menu</h1>

    <div class="menu">

<?php
if(mysqli_num_rows($select_products) > 0){
    while($row = mysqli_fetch_assoc($select_products)){

?>

    
        <div class="card">

        <div class="card-img">
            <img src="uploaded_img/<?php echo $row['image']; ?>">
        </div>

        <div class="card-name">
            <h3><?php echo $row['name']; ?></h3>
        </div>

         <div class="card-price">
            <p>$<?php echo $row['price']; ?></p>
        </div>

        <div class="card-desc">
            <p><?php echo $row['description']; ?></p>
        </div>

        <div>
            <button class="order-btn">Order Now</button>
        </div>

       </div>  
    <?php 
     }
    }
    
    ?>

   
    </div>
    
</body>
</html>