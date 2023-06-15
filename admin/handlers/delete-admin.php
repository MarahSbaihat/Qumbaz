<?php
    session_start();
    require('../include/connection.php');
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM `admins` WHERE `id`=$id";
        $query = mysqli_query($conn , $sql);
        if( mysqli_num_rows($query)>0 ){
            $admin = mysqli_fetch_assoc($query);
            $image = $admin['image'];
            // echo $image;
            $sql = "DELETE FROM `admins` WHERE `id`=$id";
            if(mysqli_query($conn , $sql)){
                if($image != 'default.jpg'){
                    unlink("./upload/admin/$image");
                }
                $_SESSION['success'] = ['admin deleted successfully'];
                header('location: ../admins.php');
            }
        }else{
            $_SESSION['errors'] = ['no admin found'];
            header('location: ../admins.php');
        }
    }else{
        $_SESSION['errors'] = ['no id found'];
        header('location: ../admins.php');
    }
?>