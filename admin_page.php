<?php 

@include 'config.php';

if(isset($_POST['add_product'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/'.$product_image;

    
    if(empty($product_name) || empty($product_price) || empty($product_description) || empty($product_image)){
        $message[] = 'please fill out all';
    }else{
        
        
        $insert = "INSERT INTO products(name, price, description, image) 
                   VALUES('$product_name', '$product_price', '$product_description', '$product_image')";
        
        $upload = mysqli_query($conn, $insert);

        if($upload){
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            $message[] = 'new product added successfully';
        }else{
            $message[] = 'not add the product';
        }
    }
};


if(isset($_GET['delete'])){

    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header('location:admin_page.php');

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="admin_page_body">

<?php 

if(isset($message)){
    foreach($message as $message){
        echo '<span class="message">'.$message.'</span>';
    }
}

?>

<div class="container">

<div class="menu-btn">
    <a href="menu.php" class="btn">view menu</a>
</div>

    <div class="admin_form_container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <h3>add a new product</h3>

            <input type="text" placeholder="enter product Name" name="product_name" class="box">

            <input type="text" placeholder="enter product price" name="product_price" class="box">

            <input type="text" placeholder="enter product description" name="product_description" class="box">

            <input type="file" accept="image/png, image/jpg, image/jpeg" name="product_image" class="box">

            <input type="submit" value="add product" name="add_product" class="btn">
        </form>

    </div>

    <?php 
    $select = mysqli_query($conn, "SELECT * FROM products");
    ?>

    <div class="product-display">
        <table class="product-display-table">
            <thead>
                <tr>
                    <th>product image</th>
                    <th>product name</th>
                    <th>product price</th>
                    <th>product description</th>
                     <th>Actions</th> 
                
                </tr>
            </thead>
       
        <?php 
        while($row = mysqli_fetch_assoc($select)){

        ?>

        <tr>
        <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>

        <td><?php echo $row['name']; ?></td>

        <td><?php echo $row['price']; ?></td>

        <td><?php echo $row['description']; ?></td>

        <td class="action-buttons">

            <a href="admin_update.php?update=<?php echo $row['id']; ?>" class="btn">update</a>
            <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn">delete</a>
        </td>

        </tr>
        <?php }; 
        ?>
        
        </table>
    </div>

</div>

</body>
</html>
