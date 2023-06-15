<?php
    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');
    
    extract($_POST);

    // $name = handleStringInput($name);
    $img = $_FILES['image'];
    $imgName = $img['name'];

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
    if(!$img){
        $errors = ['img is required'];
    }else{
        $img = $_FILES['image'];
        $imgName = $img['name'];
        $tmpName = $img['tmp_name'];
        $sizeImgMB = $img['size']/(1024*1024);
        $ext = pathinfo($imgName,PATHINFO_EXTENSION);
        if($ext){
            $newName = uniqid().$name.'.'.$ext;
        }else{
            $newName = uniqid().$name;
        }
    }

    if(empty($errors)){
        $sql = "INSERT INTO `centralproducts`(`title`,`image`) VALUES ('$title','$newName')";
        if(mysqli_query($conn,$sql)){
            if($_FILES['image']['name']){
                move_uploaded_file($tmpName,"./upload/product/$newName");
            }
            header('location: ../product.php');
            $_SESSION['success']='product created successfully';
        }else{
            header('location: ../add-product.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-product.php');
    }
?>