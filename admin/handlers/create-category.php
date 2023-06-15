<?php
    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');
    
    extract($_POST);
    
    $category = handleStringInput($category);

    $img = $_FILES['image'];
    $imgName = $img['name'];

    $errors =[];

    // category
    if(empty($category)){
        $errors[] = ['category is required'];
    }elseif(!is_string($category)){
        $errors[] = ['category must be a string'];
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
            $newName = uniqid().$category.'.'.$ext;
        }else{
            $newName = uniqid().$category;
        }
    }

    if(empty($errors)){
        if($categories_id){
            $sql = "INSERT INTO `classifications`(`categories_id`,`category`,`image`) VALUES ('$categories_id','$category','$newName')";
            if(mysqli_query($conn,$sql)){
                if($_FILES['image']['name']){
                    move_uploaded_file($tmpName,"./upload/category/$newName");
                }
                header('location: ../home.php');
                $_SESSION['success']='category created successfully';
            }else{
                header('location: ../add-categories.php');
            }
        }else{
            $sql = "INSERT INTO `categories`(`category`,`image`) VALUES ('$category','$newName')";
            if(mysqli_query($conn,$sql)){
                if($_FILES['image']['name']){
                    move_uploaded_file($tmpName,"./upload/category/$newName");
                }
                header('location: ../home.php');
                $_SESSION['success']='category created successfully';
            }else{
                header('location: ../add-categories.php');
            }
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-categories.php');
    }
?>