<?php
    session_start();
    require('../include/connection.php');
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM `products` WHERE `id`=$id";
        $query = mysqli_query($conn , $sql);
        if( mysqli_num_rows($query)>0 ){
            $product = mysqli_fetch_assoc($query);
            $image = $product['image'];
            $sql = "DELETE FROM `products` WHERE `id`=$id";
            if(mysqli_query($conn , $sql)){
                if($image != 'default.jpg'){
                    unlink("./../../handler/upload/product/$image");
                }
                $_SESSION['success'] = ['product deleted successfully'];
                header('location: ../products.php');
            }
        }else{
            $_SESSION['errors'] = ['no product found'];
            header('location: ../products.php');
        }
    }else{
        $_SESSION['errors'] = ['no product found'];
        header('location: ../products.php');
    }
?>