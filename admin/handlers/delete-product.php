<?php
    session_start();
    require('../include/connection.php');
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM `centralproducts` WHERE `id`=$id";
        $query = mysqli_query($conn , $sql);
        if( mysqli_num_rows($query)>0 ){
            $product = mysqli_fetch_assoc($query);
            $image = $product['image'];
            echo $image;
            $sql = "DELETE FROM `centralproducts` WHERE `id`=$id";
            if(mysqli_query($conn , $sql)){
                if($image != 'default.jpg'){
                    unlink("./upload/product/$image");
                }
                $_SESSION['success'] = ['product deleted successfully'];
                header('location: ../product.php');
            }
        }else{
            $_SESSION['errors'] = ['no product found'];
            header('location: ../product.php');
        }
    }else{
        $_SESSION['errors'] = ['no id found'];
        header('location: ../product.php');
    }
?>