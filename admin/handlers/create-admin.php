<?php
    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');
    
    extract($_POST);
    
    $name = handleStringInput($name);
    $email = handleStringInput($email);
    $password = handleStringInput($password);
    $img = $_FILES['image'];
    $imgName = $img['name'];

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

    // password
    if(empty($password)){
        $errors[] = ['password is required'];
    }elseif ($password <= 8) {
        $errors[] = ["Your Password Must Contain At Least 8 Characters!"];
    }elseif(!preg_match("#[0-9]+#",$password)) {
        $errors[] = ["Your Password Must Contain At Least 1 Number!"];
    }elseif(!preg_match("#[A-Z]+#",$password)) {
        $errors[] = ["Your Password Must Contain At Least 1 Capital Letter!"];
    }elseif(!preg_match("#[a-z]+#",$password)) {
        $errors[] = ["Your Password Must Contain At Least 1 Lowercase Letter!"];
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
        $newName = 'default.jpg';
    }

    if(empty($errors)){
        $password = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `admins`(`name`,`email`,`password`,`image`,`is_active`,`role`) VALUES ('$name','$email','$password','$newName','$is_active','$role')";
        if(mysqli_query($conn,$sql)){
            if($_FILES['image']['name']){
                move_uploaded_file($tmpName,"./upload/admin/$newName");
            }
            header('location: ../admins.php');
            $_SESSION['success']='admin created successfully';
        }else{
            header('location: ../add-admins.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-admins.php');
    }
?>