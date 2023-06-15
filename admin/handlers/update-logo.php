<?php

    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');
    
    extract($_POST);
    
    $name = handleStringInput($name);

    $sql = "SELECT * FROM `logos` WHERE `id`=$logo_id";
    $query = mysqli_query($conn, $sql);
    $logo = mysqli_fetch_assoc($query);

    $old_image = $logo['image'];

    $errors =[];

    // name
    if(empty($name)){
        $errors[] = ['name is required'];
    }elseif(!is_string($name)){
        $errors[] = ['name must be a string'];
    }elseif(strlen($name)<=2 || strlen($name)>40){
        $errors[] = ['name must be between 3 - 40 chars'];
    }

    // image 
    if($_FILES['image']['name']){
        $img = $_FILES['image'];
        $imgName = $img['name'];
        $tmpName = $img['tmp_name'];
        $sizeImgMB = $img['size']/(1024*1024);
        $ext = pathinfo($imgName,PATHINFO_EXTENSION);
        if($ext){
            $newName = uniqid().$imgName.'.'.$ext;
        }else{
            $newName = uniqid().$imgName;
        }
    }else{
        $newName = $old_image;
    }

    if(empty($errors)){
        $sql = "UPDATE `logos` SET `name`='$name' , `image`='$newName' WHERE `id`=$logo_id";
        if(mysqli_query($conn,$sql)){
            if($_FILES['image']['name']){
                move_uploaded_file($tmpName,"./upload/logo/$newName");
                if($old_image != 'default.jpg'){
                    unlink("../upload/logo/$old_image");
                }
            }
            header('location: ../logo.php');
            $_SESSION['success']='logo updated successfully';
        }else{
            $_SESSION['errors'] = ['something went wrong'];
            header('location: ../update-logo.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../update-logo.php');
    }
?>