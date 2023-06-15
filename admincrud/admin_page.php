<!DOCTYPE html>
<html lang="en">


<?php
if (!isset($_SESSION)) { session_start(); }
include ('../include/connection.php');

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $discount = $_POST['discount'];
   $quantity = $_POST['quantity'];
   $details = $_POST['details'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;
   $producer_id=$_SESSION['user'][0]['id'];
   $clasify_id = $_SESSION['user'][0]['id'];


   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO products(name, price, image,producer_id,discount,quantity,details ) VALUES('$product_name', '$product_price', '$product_image',' $producer_id',' $discount',' $quantity',' $details' )";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE id = $id");
   header('location:admin_page.php');
};

?>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

  
   <!-- custom css file link  -->
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

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" min="1" placeholder="enter product price" name="product_price" class="box">
         <input type="number" min="0" max="100" placeholder="discount" name="discount" class="box">
         <input type="text" placeholder="enter quantity" name="quantity" class="box"><br>
         <input type="text" placeholder="enter details" name="details" class="box"><br>
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <select class ="box" name="category" selected="<?php print($messageeditdetails[0]['category_id']); ?>">
             <option value=""><?php echo "Select"; ?></option>
         <?php  foreach ($dropdowndetails as $dropdowndetails) { ?>
             <option <?php if($messageeditdetails[0]['category_id'] == $dropdowndetails['id']) { ?>
                selected="<?php echo $dropdowndetails['id']; ?>" 
                <?php } ?> value="<?php echo $dropdowndetails['id']; ?>">
                <?php echo $dropdowndetails['image']; ?></option>
         <?php } ?>
</select>
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
   <div class="product-display">
      <table class="table table-bordered">
         <thead >
         <tr class="table-primary">
            <th scope="col">number</th>
            <th scope="col">product image</th>
            <th scope="col">product name</th>
            <th scope="col">product price</th>
            <th scope="col">discount</th>
            <th scope="col">quantity</th>
            <th scope="col">details</th>
            <th scope="col">action</th>
         </tr>
         </thead>
         <?php
         $i=1;
         while($row = mysqli_fetch_assoc($select)){ ?>
         <tr class="table-primary"> 
            <td><?= $i ?></td>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?>/-</td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['discount']; ?></td>
            <td><?php echo $row['details']; ?></td>

            <td>
               <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn text-capitalize rounded-pill py-2 px-3"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn text-capitalize rounded-pill py-2 px-3"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php 
   $i++ ;
   } ?>
      <tr>
         <td></td>
         <td colspan 2 class="btn text-capitalize rounded-pill py-2 px-3"> <a href="../profileforproducer.php" > <i class="fa fa-home"></i> Back Profile</a></td>
        
         <td></td>
       </tr>

      </table>
   </div>

</div>


</body>
</html>