<?php
// session_start();
// include('connection.php');

// if (isset($_POST['product_id']) && isset($_POST['customer_id'])) {
//     $product_id = $_POST['product_id'];
//     $customer_id = $_POST['customer_id'];

    
//         $insertSql = "INSERT INTO orders (product_id, customer_id) VALUES ($product_id, $customer_id)";
//         mysqli_query($conn, $insertSql);
        
    
//     header("location: ../productsdetails.php?id=$product_id");
//     exit();
// } else {
//     $_SESSION['errors'] = ['There was an error'];
//     header("location: ../productsdetails.php?id=$product_id");
//     exit();
// }
?>


<?php
session_start();
include('connection.php');
require('../handler/method/index.php');

if (isset($_POST['product_id']) && isset($_POST['customer_id'])) {
    $product_id = $_POST['product_id'];
    $customer_id = $_POST['customer_id'];

    extract($_POST);
    $name = handleStringInput($name);
    $address = handleStringInput($address);
    $phone = handleStringInput($phone);
    $accountPayment = $pay_account;
    $numberPayment = $pay_number;
    $errors = [];

    // Validate name
    if (empty($name)) {
        $errors[] = 'Name is required';
    } elseif (!is_string($name)) {
        $errors[] = 'Name must be a string';
    } elseif (strlen($name) <= 2 || strlen($name) > 40) {
        $errors[] = 'Name must be between 3 - 40 characters';
    }

    if (empty($errors)) {
        $insertSql = "INSERT INTO `orders` (`product_id`, `customer_id`) VALUES ($product_id, $customer_id)";
        $sql1 = "UPDATE `customers` SET `name`='$name', `address`='$address' WHERE `id`=$customer_id";
        $sql2 = "UPDATE `customer_details` SET `phone`='$phone' WHERE `customer_id`=$customer_id";
        $accountPaymentHashed = password_hash($accountPayment, PASSWORD_DEFAULT);
        $numberPaymentHashed = password_hash($numberPayment, PASSWORD_DEFAULT);
        $sql3 = "INSERT INTO `customer_details`(`pay_account`, `pay_number`, `customer_id`) VALUES ('$accountPaymentHashed', '$numberPaymentHashed', $customer_id)";

        if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $insertSql)) {
            $_SESSION['success'] = 'Order placed successfully';
            header("location: ../productsdetails.php?id=$product_id");
            exit();
        } else {
            $_SESSION['errors'] = ['Something went wrong'];
            header('location: ../form-order.php');
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors;
        header('location: ../form-order.php');
        exit();
    }
}
?>
