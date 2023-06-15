<?php
// session_start();

// include('include/connection.php');

// if (isset($_GET['product_id']) && isset($_GET['id'])) {
//     $product_id = $_GET['product_id'];
//     $customer_id = $_GET['id'];

//     // Insert the product into the cart table
//     $sql = "INSERT INTO carts (product_id, customer_id) VALUES ($product_id, $customer_id)";
//     mysqli_query($conn, $sql);
//     header('location: home.php');
//     exit();

// } else {
//     $_SESSION['errors'] = ['There was an error'];
//     header('location: home.php');
//     exit();
// }
?>
<?php
session_start();
include('include/connection.php');

if (isset($_GET['product_id']) && isset($_GET['id'])) {
    $product_id = $_GET['product_id'];
    $customer_id = $_GET['id'];

    // Check if the product already exists in the carts
    $checkSql = "SELECT * FROM carts WHERE product_id = $product_id AND customer_id = $customer_id";
    $result = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($result) > 0) {
        // Product already exists in carts, remove it
        $deleteSql = "DELETE FROM carts WHERE product_id = $product_id AND customer_id = $customer_id";
        mysqli_query($conn, $deleteSql);
    } else {
        // Product doesn't exist in carts, add it
        $insertSql = "INSERT INTO carts (product_id, customer_id) VALUES ($product_id, $customer_id)";
        mysqli_query($conn, $insertSql);
    }
    
    header('location: home.php');
    exit();
} else {
    $_SESSION['errors'] = ['There was an error'];
    header('location: home.php');
    exit();
}
?>