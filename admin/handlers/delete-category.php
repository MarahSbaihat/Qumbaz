<?php
    session_start();
    require('../include/connection.php');
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        if($_GET['type']=='categories'){
            $sql = "SELECT * FROM `classifications` WHERE `categories_id`=$id";
            $query = mysqli_query($conn , $sql);
            if( mysqli_num_rows($query)>0){
                $_SESSION['errors'] = ['you cant delete it because this category have a children'];
                header('location: ../home.php');
            }else{
                $sql = "SELECT * FROM `categories` WHERE `id`=$id";
                $query = mysqli_query($conn , $sql);
                if( mysqli_num_rows($query)>0 ){
                    $category = mysqli_fetch_assoc($query);
                    $image = $category['image'];
                    $sql = "DELETE FROM `categories` WHERE `id`=$id";
                    if(mysqli_query($conn , $sql)){
                        unlink("./upload/category/$image");
                        $_SESSION['success'] = ['category deleted successfully'];
                        header('location: ../home.php');
                    }
                }else{
                    $_SESSION['errors'] = ['no category found'];
                    header('location: ../home.php');
                }
            }
        }elseif($_GET['type']=='classifications'){
            $sql = "SELECT * FROM `classifications` WHERE `id`=$id";
            $query = mysqli_query($conn , $sql);
            if( mysqli_num_rows($query)>0 ){
                $category = mysqli_fetch_assoc($query);
                $image = $category['image'];
                $sql = "DELETE FROM `classifications` WHERE `id`=$id";
                if(mysqli_query($conn , $sql)){
                    unlink("./upload/category/$image");
                    $_SESSION['success'] = ['category deleted successfully'];
                    header('location: ../home.php');
                }
            }else{
                $_SESSION['errors'] = ['no category found'];
                header('location: ../home.php');
            }
        }
    }else{
        $_SESSION['errors'] = ['no id found'];
        header('location: ../home.php');
    }
?>