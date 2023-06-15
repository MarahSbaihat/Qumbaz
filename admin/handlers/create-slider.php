<?php
    session_start();
    require('../include/connection.php');

    $img = $_FILES['image'];
    $imgName = $img['name'];

    $errors =[];
    

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
            $newName = uniqid().$name.'.'.$ext;
        }else{
            $newName = uniqid().$name;
        }
    }

    if(empty($errors)){
        $sql = "INSERT INTO `sliders`(`image`) VALUES ('$newName')";
        if(mysqli_query($conn,$sql)){
            move_uploaded_file($tmpName,"./upload/slider/$newName");
            $_SESSION['success']='slider created successfully';
            header('location: ../slider.php');
        }else{
            $errors = ['something went error'];
            $_SESSION['errors'] = $errors;
            header('location: ../add-slider.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-slider.php');
    }
?>