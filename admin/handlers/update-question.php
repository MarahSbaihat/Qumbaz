<?php

    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');
    
    extract($_POST);
    
    $question = handleStringInput($question);
    $answer = handleStringInput($answer);

    $sql = "SELECT * FROM `questions` WHERE `id`=$question_id";
    $query = mysqli_query($conn, $sql);

    $errors =[];

    // question
    if(empty($question)){
        $errors[] = ['name is required'];
    }elseif(!is_string($question)){
        $errors[] = ['question must be a string'];
    }

    // answer
    if(empty($answer)){
        $errors[] = ['answer is required'];
    }elseif(!is_string($answer)){
        $errors[] = ['answer must be a string'];
    }

    if(empty($errors)){
        $sql = "UPDATE `questions` SET `question`='$question' , `answer`='$answer' WHERE `id`=$question_id";
        if(mysqli_query($conn,$sql)){
            header('location: ../question.php');
            $_SESSION['success']='question updated successfully';
        }else{
            $_SESSION['errors'] = ['something went wrong'];
            header('location: ../update-question.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../update-question.php');
    }
?>