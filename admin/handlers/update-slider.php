<?php
    session_start();
    
    require('../include/connection.php');

    extract($_POST);

    $sql = "SELECT * FROM `sliders` WHERE `id`=$slider_id";
    $query = mysqli_query($conn, $sql);
    $slider = mysqli_fetch_assoc($query);

    $old_image = $slider['image'];

    $errors =[];

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
        $sql = "UPDATE `sliders` SET `image`='$newName' WHERE `id`=$slider_id";
        if(mysqli_query($conn,$sql)){
            if($newName != $old_image){
                unlink("./upload/slider/$old_image");
                move_uploaded_file($tmpName,"./upload/slider/$newName");
            }
            $_SESSION['success']='slider updated successfully';
            header('location: ../slider.php');
        }else{
            $_SESSION['errors'] = ['something went wrong'];
            header('location: ../update-slider.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../update-slider.php');
    }
?>