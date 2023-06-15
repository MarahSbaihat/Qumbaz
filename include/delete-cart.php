<?php
session_start();
require('connection.php');

if (isset($_POST['id']) && isset($_POST['customer_id']) && isset($_POST['product_id'])) {
    $id = $_POST['id'];
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $sql = "SELECT carts.id, carts.product_id, carts.customer_id, products.image, products.id AS products_id, products.name, products.price, products.clasify_id, products.producer_id
    FROM carts
    JOIN products ON carts.product_id = products.id
    WHERE carts.id = $id";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $delete = mysqli_fetch_assoc($result);
        $sql = "DELETE FROM carts
                WHERE product_id = $product_id AND customer_id = $customer_id";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = 'Product from carts deleted successfully';
        } else {
            $_SESSION['errors'] = 'Error deleting the product';
        }
    } else {
        $_SESSION['errors'] = 'No product found';
    }
} else {
    $_SESSION['errors'] = 'No ID found';
}

header("location: ../cart.php?id=$customer_id");
exit();

?>