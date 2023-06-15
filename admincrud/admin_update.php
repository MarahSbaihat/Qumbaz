<?php
if (!isset($_SESSION)) { session_start(); }
 include('../include/connection.php');

$id = $_GET['edit'];

if((isset($_POST['update_product'])) && ($_POST['update_product']=='update_product')){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $discount = $_POST['discount'];
   $quantity = $_POST['quantity'];
   $details = $_POST['details'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;
   $id=$_POST['id'];
  

      $update_data = "UPDATE products SET name='$product_name', price='$product_price',discount='$discount', quantity='$quantity' ,details='$details', image='$product_image'  WHERE id = '$id'";
      $res = mysqli_query($conn, $update_data);

      if($res){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:admin_page.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
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


<div class="admin-product-form-container centered">
<form action="" method="post" enctype="multipart/form-data">
   <?php
      
      $sele = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($sele)){

   ?>
   
   
      <h3 class="title">update the product</h3>
      <input type="hidden" class="box" name="id" value="<?php echo $row['id']; ?>" >
      <input type="text" class="box" name="product_name" value="<?php echo $row['name']; ?>" placeholder="enter the product name">
      <input type="number" min="1" class="box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="enter the product price">
      <input type="number" min="1" max="100" class="box" name="discount" value="<?php echo $row['discount']; ?>" placeholder="enter the product discount">
      <input type="text" class="box" name="quantity" value="<?php echo $row['quantity']; ?>" placeholder="enter the product quantity">
      <input type="text" class="box" name="details" value="<?php echo $row['details']; ?>" placeholder="enter the product details">
      <input type="file" class="box" name="product_image"  accept="image/png, image/jpeg, image/jpg" value="<?php echo $row['image']; ?>">
      <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
      <input type="submit" value="update_product" name="update_product" class="btn">
      <a href="admin_page.php" class="btn">go back!</a>
   
   


   <?php }; ?>

   </form>

</div>

</div>

</body>
</html>