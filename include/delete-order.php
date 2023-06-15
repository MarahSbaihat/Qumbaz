<?php
session_start();
require('connection.php');

if (isset($_POST['id']) && isset($_POST['customer_id'])) {
    $id = $_POST['id'];
    $customer_id = $_POST['customer_id'];
   
    $sql = "DELETE FROM orders
            WHERE id = $id AND customer_id = $customer_id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = 'Product from carts deleted successfully';
    } else {
        $_SESSION['errors'] = 'Error deleting the product';
    }
    header("location: ../order.php?id=$id");
    exit();
    
} else {
    $_SESSION['errors'] = 'No ID found';
}
?>
