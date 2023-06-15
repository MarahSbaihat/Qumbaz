<?php

    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');

    extract($_POST);

    // categories_id = parent
    // category_id = id[category]
    
    $category = handleStringInput($category);

    $sql = "SELECT * FROM `$type` WHERE `id`=$category_id";
    $query = mysqli_query($conn, $sql);
    $category = mysqli_fetch_assoc($query);

    $old_image = $category['image'];

    $errors =[];

    // category
    if(empty($category)){
        $errors[] = ['category is required'];
    }elseif(!is_string($category)){
        $errors[] = ['category must be a string'];
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
        // is there is a parent sent
        if($categories_id){
            // if its in categories table
            $sql = "SELECT * FROM `categories` WHERE `id`=$category_id";
            $query = mysqli_query($conn, $sql);
            $category_verify = mysqli_fetch_assoc($query);

            // if its in classifications table
            $sqll = "SELECT * FROM `classifications` WHERE `id`=$category_id";
            $queryy = mysqli_query($conn, $sqll);
            $classification_verify = mysqli_fetch_assoc($queryy);

            if($category_verify){
                $sql = "SELECT * FROM `categories` WHERE `id`=$category_id";
                $query = mysqli_query($conn , $sql);
                if( mysqli_num_rows($query)>0 ){
                    $category = mysqli_fetch_assoc($query);
                    $image = $category['image'];
                    $sql = "DELETE FROM `categories` WHERE `id`=$category_id";
                    mysqli_query($conn , $sql);
                }
                $sql = "INSERT INTO `classifications`(`categories_id`,`category`,`image`) VALUES ('$categories_id','$category','$newName')";
                if(mysqli_query($conn,$sql)){
                    if($_FILES['image']['name']){
                        move_uploaded_file($tmpName,"./upload/category/$newName");
                    }
                    $_SESSION['success']='category created successfully';
                    header('location: ../home.php');
                }else{
                    $_SESSION['errors'] = ['something went wrong'];
                    header('location: ../update-categories.php');
                }
            }elseif($classification_verify){
                $sql = "UPDATE `classifications` SET `categories_id`='$categories_id' , `category`='$category' , `image`='$newName' WHERE `id`=$category_id";
                if(mysqli_query($conn,$sql)){
                    if($_FILES['image']['name']){
                        move_uploaded_file($tmpName,"../upload/category/$newName");
                        unlink("../upload/category/$old_image");
                    }
                    header('location: ../home.php');
                    $_SESSION['success']='category updated successfully';
                }else{
                    $_SESSION['errors'] = ['something went wrong'];
                    header('location: ../update-categories.php');
                }
            }else{
                $_SESSION['errors'] = ['something went wrong'];
                header('location: ../update-categories.php');
            }
        }else{
            // if its in categories table
            $sql = "SELECT * FROM `categories` WHERE `id`=$category_id";
            $query = mysqli_query($conn, $sql);
            $category_verify = mysqli_fetch_assoc($query);

            // if its in classifications table
            $sqll = "SELECT * FROM `classifications` WHERE `id`=$category_id";
            $queryy = mysqli_query($conn, $sqll);
            $classification_verify = mysqli_fetch_assoc($queryy);

            if($classification_verify){
                $sql = "SELECT * FROM `classifications` WHERE `id`=$category_id";
                $query = mysqli_query($conn , $sql);
                if( mysqli_num_rows($query)>0 ){
                    $category = mysqli_fetch_assoc($query);
                    $image = $category['image'];
                    $sql = "DELETE FROM `classifications` WHERE `id`=$category_id";
                    mysqli_query($conn , $sql);
                }
                $sql = "INSERT INTO `categories`(`categories_id`,`category`,`image`) VALUES ('$categories_id','$category','$newName')";
                if(mysqli_query($conn,$sql)){
                    if($_FILES['image']['name']){
                        move_uploaded_file($tmpName,"./upload/category/$newName");
                    }
                    $_SESSION['success']='category created successfully';
                    header('location: ../home.php');
                }else{
                    $_SESSION['errors'] = ['something went wrong'];
                    header('location: ../update-categories.php');
                }
            }elseif($category_verify){
                $sql = "UPDATE `categories` SET `category`='$category' , `image`='$newName' WHERE `id`=$category_id";
                if(mysqli_query($conn,$sql)){
                    if($_FILES['image']['name']){
                        move_uploaded_file($tmpName,"../upload/category/$newName");
                        unlink("../upload/category/$old_image");
                    }
                    header('location: ../home.php');
                    $_SESSION['success']='category updated successfully';
                }else{
                    $_SESSION['errors'] = ['something went wrong'];
                    header('location: ../update-categories.php');
                }
            }else{
                $_SESSION['errors'] = ['something went wrong'];
                header('location: ../update-categories.php');
            }
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../update-admin.php');
    }
?>