<?php
    session_start();
    
    require('include/connection.php');
    // require('handeler/method/index.php');
    function handleStringInput($string){
        return strip_tags(trim($string));
    }
    if (isset($_POST['customer_id'])) {
        $customer_id = $_POST['customer_id'];
    extract($_POST);
    
    $name = handleStringInput($name);
    $email = handleStringInput($email);
    $password = handleStringInput($password);
    $bio = handleStringInput($bio);
    $address = handleStringInput($address);
    $phone = handleStringInput($phone);
    

    
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
            $newName = uniqid() . $name . '.' . $ext;
            $targetPath = './upload/account/' . $newName;
            move_uploaded_file($tmpName, $targetPath);
        } else {
            $newName = uniqid() . $name;
        }
    } else {
        $newName = 'default.jpg';
    }

    if(empty($errors)){

            $password = password_hash($password,PASSWORD_DEFAULT);
            $sql = "UPDATE `customers` SET `name`='$name', `address`='$address', `bio`='$bio', `password`='$password' WHERE `id`=$customer_id";
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
                    $sql = "UPDATE `customers` SET `name`='$name', `address`='$address' WHERE `id`=$customer_id";
                    mysqli_query($conn,$sql);
                }
                $_SESSION['success']='acount created successfully';

                

                header("location: profileforcustomer.php");
            }else{
                $_SESSION['success']='something went wrong';
                header("location: profileforcustomer.php");
            }}else{
                $_SESSION['errors'] = 'someting wrong';
                header("location: profileforcustomer.php");
            }
    
        
    } else {
        $_SESSION['errors'] = $errors;
        header("location: profileforcustomer.php");
        exit();
    }

?>
