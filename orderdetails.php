<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('include/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT 
        products.*, orders.id AS order_id, orders.total_price, producers.name AS producer_name
        FROM `products` 
        JOIN orders ON products.id = orders.product_id 
        JOIN producers ON products.producer_id = producers.id
        WHERE orders.id = $id";

    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $totalPrice = 0; // Variable to calculate the total price
        $order_id = $products[0]['order_id']; // Get the order ID from the first product
        foreach ($products as $product) {
            $totalPrice += $product['price']; // Increase the total price by the price of each product
        }
        $product_id = $products[0]['id']; // Get the product ID from the first product
    } else {
        $_SESSION['errors'] = ['Something went wrong'];
        header('Location: order.php');
        exit();
    }
} else {
    $_SESSION['errors'] = ['Something went wrong'];
    header('Location: order.php');
    exit();
}
?>

<head>
    <?php include('include/head.php'); ?>
</head>

<body>
    <div class="btnTop">
        <i class="fa-solid fa-angle-up"></i>
    </div>

    <?php include('include/navbar.php'); ?>

    <div class="favourite pb-5 table">
        <div class="container pt-5">
            <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Producer</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($products) && !empty($products)) : ?>
                        <?php $count = 1; ?>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <th scope="row"><?= $count ?></th>
                                <td><?= $product['name'] ?></td>
                                <td><img class="w-25 rounded" src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" /></td>
                                <td><?= $product['producer_name'] ?></td>
                                <td><?= $product['price'] ?></td>
                            </tr>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-dark text-decoration-none">Total Price: <?= $totalPrice ?></td>
                        </tr>
                        <?php
                        // Update the total price in the orders table
                        $updateSql = "UPDATE `orders` SET `total_price`='$totalPrice' WHERE `id`='$order_id'";
                        mysqli_query($conn, $updateSql);
                        ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">No results found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include('include/footer.php'); ?>
    <?php include('include/script.php'); ?>

</body>

</html>
