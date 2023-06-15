<?php
    session_start();
    require('../include/connection.php');
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM `sliders` WHERE `id`=$id";
        $query = mysqli_query($conn , $sql);
        if( mysqli_num_rows($query)>0 ){
            $slider = mysqli_fetch_assoc($query);
            $image = $slider['image'];
            echo $image;
            $sql = "DELETE FROM `sliders` WHERE `id`=$id";
            if(mysqli_query($conn , $sql)){
                unlink("./upload/slider/$image");
                $_SESSION['success'] = ['slider deleted successfully'];
                header('location: ../slider.php');
            }
        }else{
            $_SESSION['errors'] = ['no slider found'];
            header('location: ../slider.php');
        }
    }else{
        $_SESSION['errors'] = ['no id found'];
        header('location: ../slider.php');
    }
?>