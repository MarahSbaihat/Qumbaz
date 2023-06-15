<?php
session_start();
require('connection.php');

if (isset($_POST['id']) && isset($_POST['customer_id']) && isset($_POST['product_id'])) {
    $id = $_POST['id'];
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $sql = "SELECT favourites.id, favourites.product_id, favourites.customer_id, products.image, products.id AS products_id, products.name, products.price, products.clasify_id, products.producer_id
    FROM favourites
    JOIN products ON favourites.product_id = products.id
    WHERE favourites.id = $id";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $delete = mysqli_fetch_assoc($result);
        $sql = "DELETE FROM favourites
                WHERE product_id = $product_id AND customer_id = $customer_id";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = 'Product from favourites deleted successfully';
        } else {
            $_SESSION['errors'] = 'Error deleting the product';
        }
    } else {
        $_SESSION['errors'] = 'No product found';
    }
} else {
    $_SESSION['errors'] = 'No ID found';
}

header("location: ../favourite.php?id=$customer_id");
exit();









// session_start();
// require('connection.php');

// if (isset($_POST['id'])) {
//     $id = $_POST['id'];
//     $sql = "SELECT favourites.id,favourites.product_id, favourites.customers_id,products.id AS product_id, products.image, products.name, products.price, products.clasify_id, products.producer_id
//         FROM favourites
//         JOIN products ON favourites.product_id = products.product_id 
//         WHERE favourites.id=$id";

//     $result = mysqli_query($conn, $sql);

//     if (mysqli_num_rows($result) > 0) {
//         $delete = mysqli_fetch_assoc($result);
//         // $image = $delete['image'];
//         // echo $image;
//         $sql = "DELETE favourites.*
//                 WHERE favourites.id = $id";

//         if (mysqli_query($conn, $sql)) {
//             $_SESSION['success'] = ['Product from cart deleted successfully'];
//         } else {
//             $_SESSION['errors'] = ['Error deleting the product'];
//         }
//     } else {
//         $_SESSION['errors'] = ['No product found'];
//     }
// } else {
//     $_SESSION['errors'] = ['No ID found'];
// }

// header('location: ./profileforcustomer.php');
?>