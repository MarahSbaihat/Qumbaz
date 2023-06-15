<?php
    session_start();
    
    require('../include/connection.php');
    require('methods/index.php');
    
    extract($_POST);
    
    $question = handleStringInput($question);
    $answer = handleStringInput($answer);

    $errors =[];

    // question
    if(empty($question)){
        $errors[] = ['question is required'];
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
        $sql = "INSERT INTO `questions`(`question`,`answer`) VALUES ('$question','$answer')";
        if(mysqli_query($conn,$sql)){
            header('location: ../question.php');
            $_SESSION['success']='question created successfully';
        }else{
            header('location: ../add-questions.php');
        }
    }else{
        $_SESSION['errors'] = $errors;
        header('location: ../add-questions.php');
    }
?>