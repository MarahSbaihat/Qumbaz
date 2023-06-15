<?php
    session_start();
        
    require('../include/connection.php');
    require('method/index.php');

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

        if(empty($errors)) {
            $sql = "SELECT * FROM `producers` WHERE `email` = '$email'";
            $query = mysqli_query($conn, $sql);
            $sqll = "SELECT * FROM `customers` WHERE `email` = '$email'";
            $queryy = mysqli_query($conn, $sqll);
            if(mysqli_num_rows($query) > 0) {
                $user = mysqli_fetch_assoc($query);
                $userPassword = $user['password'];
                if(password_verify($password, $userPassword)) {
                    $_SESSION['user'] = $user;
                    $_SESSION['account_type'] = 'producer';
                    $_SESSION['logedin'] = 'login';
                    header('Location: ../home.php');
                }else{
                    $errors[] = ['email or password is incorrect'];
                    header('Location: ../login.php');
                }
            }elseif(mysqli_num_rows($queryy) > 0) {
                $user = mysqli_fetch_assoc($queryy);
                $userPassword = $user['password'];
                if(password_verify($password, $userPassword)) {
                    $_SESSION['user'] = $user;
                    $_SESSION['account_type'] ='customer';
                    $_SESSION['logedin'] = 'login';
                    header('Location: ../home.php');
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