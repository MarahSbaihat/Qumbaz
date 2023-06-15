<?php

    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');
    
    extract($_POST);
    
    $name = handleStringInput($name);
    $email = handleStringInput($email);

    $sql = "SELECT * FROM `admins` WHERE `id`=$admin_id";
    $query = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($query);

    $old_image = $admin['image'];

    $errors =[];

    // name
    if(empty($name)){
        $errors[] = ['name is required'];
    }elseif(!is_string($name)){
        $errors[] = ['name must be a string'];
    }elseif(strlen($name)<=2 || strlen($name)>40){
        $errors[] = ['name must be between 3 - 40 chars'];
    }

    // email
    if(empty($email)){
        $errors[] = ['email is required'];
    }elseif(!is_string($email)){
        $errors[] = ['email must be a string'];
    }elseif(strlen($email)<=10 || strlen($email)>60){
        $errors[] = ['email size error'];
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
        $sql = "UPDATE `admins` SET `name`='$name' , `email`='$email' , `image`='$newName' , `is_active`='$is_active' , `role`='$role' WHERE `id`=$admin_id";
        if(mysqli_query($conn,$sql)){
            if($_FILES['image']['name']){
                move_uploaded_file($tmpName,"../upload/admin/$newName");
                if($old_image != 'default.jpg'){
                    unlink("../upload/admin/$old_image");
                }
            }
            header('location: ../admins.php');
            $_SESSION['success']='admin updated successfully';
        }else{
            $_SESSION['errors'] = ['something went wrong'];
            header('location: ../update-admin.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../update-admin.php');
    }
?>