<?php
    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        extract($_POST);

        $email = handleStringInput($email);
        $password = handleStringInput($password);

        $errors = [];

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

        if(empty($errors)) {
            $sql = "SELECT * FROM `admins` WHERE `email` = '$email'";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) > 0) {
                $admin = mysqli_fetch_assoc($query);
                $adminPassword = $admin['password'];
                if(password_verify($password, $adminPassword)) {
                    $_SESSION['admin'] = $admin;
                    header('Location: ../index.php');
                }else{
                    $errors[] = ['email or password is incorrect'];
                    header('Location: ../login.php');
                }
            }else{
                $errors[] = ['email or password is incorrect'];
                header('Location: ../login.php');
            }
        }else{
            $_SESSION['errors'] = $errors;
            header('Location: ../login.php');
        }
    }
?>