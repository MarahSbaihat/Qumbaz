<?php
    session_start();
    require('../include/connection.php');
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM `questions` WHERE `id`=$id";
        $query = mysqli_query($conn , $sql);
        if( mysqli_num_rows($query)>0 ){
            $sql = "DELETE FROM `questions` WHERE `id`=$id";
            if(mysqli_query($conn , $sql)){
                $_SESSION['success'] = ['question deleted successfully'];
                header('location: ../question.php');
            }
        }else{
            $_SESSION['errors'] = ['no question found'];
            header('location: ../question.php');
        }
    }else{
        $_SESSION['errors'] = ['no id found'];
        header('location: ../question.php');
    }
?>