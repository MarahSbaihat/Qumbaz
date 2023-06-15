<?php

    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');
    
    extract($_POST);
    
    $title = handleStringInput($title);

    $sql = "SELECT * FROM `centralproducts` WHERE `id`=$product_id";
    $query = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($query);

    $old_image = $product['image'];

    $errors =[];

    // title
    if(empty($title)){
        $errors[] = ['title is required'];
    }elseif(!is_string($title)){
        $errors[] = ['title must be a string'];
    }elseif(strlen($title)<=2 || strlen($title)>40){
        $errors[] = ['title must be between 3 - 40 chars'];
    }

    // image 
    if($_FILES['image']['name']){
        $img = $_FILES['image'];
        $imgName = $img['name'];
        $tmpName = $img['tmp_name'];
        $sizeImgMB = $img['size']/(1024*1024);
        $ext = pathinfo($imgName,PATHINFO_EXTENSION);
        $newName = uniqid().$name.'.'.$ext;
        if($sizeImgMB >5){
            $errors = ['size must be less than 5MB'];
        }
    }else{
        $newName = $old_image;
    }

    if(empty($errors)){
        $sql = "UPDATE `centralproducts` SET `title`='$title' , `image`='$newName' WHERE `id`=$product_id";
        if(mysqli_query($conn,$sql)){
            if($_FILES['image']['name']){
                move_uploaded_file($tmpName,"./upload/product/$newName");
                if($old_image != 'default.jpg'){
                    unlink("../upload/product/$old_image");
                }
            }
            header('location: ../product.php');
            $_SESSION['success']='product updated successfully';
        }else{
            $_SESSION['errors'] = ['something went wrong'];
            header('location: ../update-product.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../update-product.php');
    }
?>