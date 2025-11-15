<?php 

@include 'config.php';

$id = isset($_GET['update']) ? $_GET['update'] : '';


if(isset($_POST['update'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/'.$product_image;

    
    if(empty($product_name) || empty($product_price) || empty($product_description) || empty($product_image)){
        $message[] = 'please fill out all';
    }else{
        
        
        $update = "UPDATE products SET name='$product_name', price='$product_price', description='$product_description', image='$product_image' WHERE id='$id'";
        
        $upload = mysqli_query($conn, $update);

        if($upload){
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            $message[] = 'new product added successfully';
            header('Location: admin_page.php');
        }else{
            $message[] = 'could not add the product';
        }
    }
};

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin_update</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 

    if(isset($message)){
    foreach($message as $message){
        echo '<span class="message">'.$message.'</span>';
    }
}

?>

<div class="container">
    <div class="admin_form_container">


    <?php
    
    $select = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");

    while($row = mysqli_fetch_assoc($select)){
    
    ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

            <h3>update product</h3>
            <input type="text" placeholder="enter product Name"  value="<?php echo $row['name']; ?>" name="product_name" class="box">

            <input type="text" placeholder="enter product price"  value="<?php echo $row['price']; ?>" name="product_price" class="box">

            <input type="text" placeholder="enter product description"  value="<?php echo $row['description']; ?>" name="product_description" class="box">

            <input type="file" accept="image/png, image/jpg, image/jpeg" value="<?php echo $row['image']; ?>" name="product_image" class="box"><br>

            <input type="submit" value="update" name="update" class="btn">

            <a href="admin_page.php" class="btn">go back</a>
        </form>
    <?php }; ?>
    </div>

</div>

</body>
</html>