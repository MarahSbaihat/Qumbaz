<?php
    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');
    
    extract($_POST);
    
    $company = handleStringInput($company);
    $email = handleStringInput($email);
    $phone = handleStringInput($phone);

    $errors =[];

    // company
    if(empty($company)){
        $errors[] = ['company is required'];
    }elseif(!is_string($company)){
        $errors[] = ['company must be a string'];
    }elseif(strlen($company)<=2 || strlen($company)>40){
        $errors[] = ['company must be between 3 - 40 chars'];
    }

    // email
    if(empty($email)){
        $errors[] = ['email is required'];
    }elseif(!is_string($email)){
        $errors[] = ['email must be a string'];
    }elseif(strlen($email)<=10 || strlen($email)>60){
        $errors[] = ['email size error'];
    }

    // phone
    if(empty($phone)){
        $errors[] = ['phone number is required'];
    }

    if(empty($errors)){
        $sql = "INSERT INTO `delivaries`(`company`,`email`) VALUES ('$company','$email')";
        if(mysqli_query($conn,$sql)){
            $sql = "SELECT * FROM `delivaries` WHERE `email` = '$email'";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        $delivary = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    }
                    $delivary_id = $delivary[0]['id'];
            $sql = "INSERT INTO `delivary_phones`(`delivary_id`,`phone`) VALUES ('$delivary_id','$phone')";
            if(mysqli_query($conn,$sql)){
                header('location: ../details.php');
                $_SESSION['success']='admin created successfully';
            }
        }else{
            $errors[] = ['something went wrong'];
            header('location: ../add-delivary.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-delivary.php');
    }
?>