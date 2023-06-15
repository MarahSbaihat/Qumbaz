<?php
    session_start();
    
    require('../include/connection.php');
    require('method/index.php');
    
    extract($_POST);
    
    $name = handleStringInput($name);
    $email = handleStringInput($email);
    $password = handleStringInput($password);
    $bio = handleStringInput($bio);
    $address = handleStringInput($address);
    $phone = handleStringInput($phone);
    // $accountPayment = $pay_account;
    // $numberPayment = $pay_number;

    
    $img = $_FILES['image'];
    $imgName = $img['name'];

    $errors =[];

    // name
    if(empty($name)){
        $errors[] = ['name is required'];
    }elseif(!is_string($name)){
        $errors[] = ['name must be a string'];
    }elseif(strlen($name)<=3 || strlen($name)>50){
        $errors[] = ['name must be between 3 - 50 chars'];
    }

    // email
    if(empty($email)){
        $errors[] = ['email is required'];
    }elseif(!is_string($email)){
        $errors[] = ['email must be a string'];
    }elseif(strlen($email)<=11 || strlen($email)>60){
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
        if($sizeImgMB >5){
            $errors = ['size must be less than 5MB'];
        }
        if($ext){
            $newName = uniqid().$name.'.'.$ext;
        }else{
            $newName = uniqid().$name;
        }
    }else{
        $newName = 'default.jpg';
    }


    if(empty($errors)){

        if($type == 'customers'){
            $password = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `customers`(`name`,`email`,`password`,`image`,`bio`,`address`) VALUES ('$name','$email','$password','$newName','$bio','$address')";
            if(mysqli_query($conn,$sql)){
                if($_FILES['image']['name']){
                    move_uploaded_file($tmpName,"./upload/account/$newName");
                }
                if($phone){
                    $sql = "SELECT * FROM `customers` WHERE `email` = '$email'";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        $customer = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    }
                    $customer_id = $customer[0]['id'];
                    // $sql = "INSERT INTO `customer_details`(`phone`,`customer_id`,`pay_account`,`pay_number`) VALUES ('$phone','$customer_id','$accountPayment','$numberPayment')";
                    $sql = "INSERT INTO `customer_details`(`phone`,`customer_id`) VALUES ('$phone','$customer_id')";
                    mysqli_query($conn,$sql);
                }
                $_SESSION['success']='acount created successfully';

                $_SESSION['user'] = $customer;
                $_SESSION['account_type'] = 'customer';
                $_SESSION['logedin'] = 'register';

                header('location: ../home.php');
            }else{
                $_SESSION['success']='something went wrong';
                header('location: ../register.php');
            }

        }elseif($type == 'producers'){
            $password = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `producers`(`name`,`email`,`password`,`image`,`bio`,`address`) VALUES ('$name','$email','$password','$newName','$bio','$address')";
            if(mysqli_query($conn,$sql)){
                if($_FILES['image']['name']){
                    move_uploaded_file($tmpName,"./upload/account/$newName");
                }
                if($phone){
                    $sql = "SELECT * FROM `producers` WHERE `email` = '$email'";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        $producer = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    }
                    $producer_id = $producer[0]['id'];
                    // $sql = "INSERT INTO `producer_details`(`phone`,`producer_id`,`pay_account`,`pay_number`) VALUES ('$phone','$producer_id','$accountPayment','$numberPayment')";
                    $sql = "INSERT INTO `producer_details`(`phone`,`producer_id`) VALUES ('$phone','$producer_id')";
                    mysqli_query($conn,$sql);
                }
                $_SESSION['success']='acount created successfully';

                $_SESSION['user'] = $producer;
                $_SESSION['account_type'] = 'producer';
                $_SESSION['logedin'] = 'register';

                header('location: ../home.php');
            }else{
                $_SESSION['success']='something went wrong';
                header('location: ../register.php');
            }
            
        }else{
            $_SESSION['errors'] = 'someting wrong';
            header('location: ../register.php');
        }

    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../register.php');
    }