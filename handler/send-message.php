<?php
    // session_start();
        
    // require('../include/connection.php');
    // require('method/index.php');

    // if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
    //     extract($_POST);

    //     $to = "marahsbehat@gmail.com";

    //     $email = handleStringInput($email);

    //     $message = handleStringInput($message);

    //     $subject = 'New Message Qumbaz';

    //     $headers = "From: $email\r\n";
    //     // $headers .= "Reply-To: sender@example.com\r\n";
    //     // $headers .= "MIME-Version: 1.0\r\n";
    //     // $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    //     $errors = [];

    //     // email
    //     if(empty($email)){
    //         $errors[] = ['email is required'];
    //     }elseif(!is_string($email)){
    //         $errors[] = ['email must be a string'];
    //     }elseif(strlen($email)<=11 || strlen($email)>60){
    //         $errors[] = ['email size error'];
    //     }

    //     // message
    //     if(empty($message)){
    //         $errors[] = ['message is required'];
    //     }elseif(strlen($message)<=1 || strlen($message)>500){
    //         $errors[] = ['message size error'];
    //     }

    //     if(empty($email)){
    //         // Send the email
    //         $mail = mail($to, $subject, $message, $headers);

    //         // Check if the email was sent successfully
    //         if ($mail) {
    //             echo 'Email sent successfully.';
    //             header("Location: ../{$_SESSION['HTTP_REFERER']}");
    //         } else {
    //             echo 'Failed to send email.';
    //             header("Location: ../{$_SESSION['HTTP_REFERER']}");
    //         }
    //     }else{
    //         $_SESSION['errors'] = $errors;
    //         header("Location: ../{$_SESSION['HTTP_REFERER']}");
    //     }
    // }
?>

<?php
    session_start();
    require('../include/connection.php');
    require('method/index.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        extract($_POST);

        $to = "marahsbehat@gmail.com";

        $email = handleStringInput($email);
        $message = handleStringInput($message);
        $subject = 'New Message Qumbaz';

        $headers = "From: $email\r\n";

        $errors = [];

        // email validation
        if (empty($email)) {
            $errors[] = 'Email is required';
        } elseif (!is_string($email)) {
            $errors[] = 'Email must be a string';
        } elseif (strlen($email) <= 11 || strlen($email) > 60) {
            $errors[] = 'Email size error';
        }

        // message validation
        if (empty($message)) {
            $errors[] = 'Message is required';
        } elseif (strlen($message) <= 1 || strlen($message) > 500) {
            $errors[] = 'Message size error';
        }

        if (empty($errors)) {
            // Send the email
            $mailSent = mail($to, $subject, $message, $headers);

            // Check if the email was sent successfully
            if ($mailSent) {
                echo 'Email sent successfully.';
                // header("Location: ../{$_SERVER['HTTP_REFERER']}");
                header("Location: ../{$_SESSION['HTTP_REFERER']}");
                exit;
            } else {
                echo 'Failed to send email.';
                // header("Location: ../{$_SERVER['HTTP_REFERER']}");
                header("Location: ../{$_SESSION['HTTP_REFERER']}");
                exit;
            }
        } else {
            $_SESSION['errors'] = $errors;
            // header("Location: ../{$_SERVER['HTTP_REFERER']}");
            header("Location: ../{$_SESSION['HTTP_REFERER']}");
            exit;
        }
    }
?>