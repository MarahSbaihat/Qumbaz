<!DOCTYPE html>
<html lang="en">

<?php
include('include/head.php');
include('include/connection.php');

if (isset($_GET['id'])) {
    $classificationIDs = $_GET['id'];

    // Convert the string to an array if it's not already
    if (!is_array($classificationIDs)) {
        $classificationIDs = array($classificationIDs);
    }

    $products = array(); 

    foreach ($classificationIDs as $classificationID) {
        $sql = "SELECT * FROM products WHERE clasify_id = '$classificationID'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            $products = array_merge($products, mysqli_fetch_all($query, MYSQLI_ASSOC));
        }
    }
} else {
    $sql = "SELECT * FROM `products` ORDER BY RAND()";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
}
?>

<body>

    <div class="btnTop">
        <i class="fa-solid fa-angle-up"></i>
    </div>

    <?php include('include/navbar.php'); ?>

    <div class="canvas pt-3">
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <?php include('canvase-category.php'); ?>
        </div>
    </div>

    <header class="home py-5">
        <div class="image">
            <div class="container">
                <div class="row">
                    <?php if (isset($products)) : ?>
                        <?php foreach ($products as $product) : ?>
                            <div class="item col-md-3 m-auto position-relative">
                                <div class="hover wow animate__animated animate__backInDown" data-wow-duration="2s">
                                    <div class="w-90 position-relative">
                                        <a href="productsdetails.php?id=<?= $product['id'] ?>">
                                            <div class="overlay w-100">
                                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                                            </div>
                                            <img class="image1 w-100" src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                                            <div class="info d-flex justify-content-between p-3 align-items-center">
                                                <div class="desc w-100">
                                                    <?php
                                                    $classificationID = $product['clasify_id'];
                                                    $sql = "SELECT `category`,`id` FROM `classifications` where `id` = $classificationID";
                                                    $query = mysqli_query($conn, $sql);

                                                    if (mysqli_num_rows($query) > 0) {
                                                        $clasify = mysqli_fetch_assoc($query);
                                                        $category = $clasify['category'];
                                                    }
                                                    ?>
                                                    <h3><?= $category ?></h3>
                                                    <div class="w-50 d-flex justify-content-between">
                                                        <p>quantity: <?= $product['quantity'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="icon d-flex">
                                                    <?php
                                                    if (session_status() === PHP_SESSION_NONE) {
                                                        session_start();
                                                    }if ($_SESSION['account_type'] == 'customer') { 
                                                     ?>
                                                    <form action="add-to-favourite.php" method="get">
                                                        <input type="hidden" name="id" value="<?= $_SESSION['user'][0]['id'] ?>">
                                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                        <button class="border border-none bg-transparent text-danger">
                                                            <?php
                                                            $customer_id = $_SESSION['user'][0]['id'];
                                                            // echo $customer_id ;
                                                            // Check if the product exists in favourites
                                                            $product_id = $product['id'];
                                                            $checkSql = "SELECT * FROM favourites WHERE product_id = $product_id AND customer_id = $customer_id";
                                                            $result = mysqli_query($conn, $checkSql);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Product exists in favourites, display a different icon
                                                                echo '<i class="fa-solid fa-heart"></i>';
                                                            } else {
                                                                // Product doesn't exist in favourites, display the default icon
                                                                echo '<i class="fa-regular fa-heart"></i>';
                                                            }
                                                            ?></button>
                                                            </form>
                                                            <form action="add_to_cart.php" method="get">
                                                                <input type="hidden" name="id" value="<?= $_SESSION['user'][0]['id'] ?>">
                                                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                                <button class="border border-none bg-transparent">
                                                                    <?php
                                                                    // Check if the product exists in carts
                                                                    $checkSql = "SELECT * FROM carts WHERE product_id = $product_id AND customer_id = $customer_id";
                                                                    $result = mysqli_query($conn, $checkSql);

                                                                    if (mysqli_num_rows($result) > 0) {
                                                                        // Product exists in carts, display a different icon
                                                                        echo '<i class="fa-solid fa-cart-shopping"></i>';
                                                                    } else {
                                                                        // Product doesn't exist in carts, display the default icon
                                                                        echo '<i class="fa-solid fa-cart-plus"></i>';
                                                                    }}
                                                                    ?></button>
                                                                    </form>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details d-flex justify-content-between mx-2">
                                        <p class="p"><?= $product['name'] ?></p>

                                        <?php
                                        $originalPrice = $product['price'];
                                        $discount = $product['discount'];
                                        $discountedPrice = $originalPrice - ($originalPrice * ($discount / 100));
                                        ?>

                                        <p class="p">
                                            <?php if (isset($discount) && $discount != 0) : ?>
                                                <span class="original-price"><s><?= $originalPrice ?> nis</s></span>
                                                <span class="discounted-price"><?= $discountedPrice ?> nis</span>
                                            <?php else : ?>
                                                <span class="original-price"><?= $originalPrice ?> nis</span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <?php include('include/footer.php'); ?>
    <?php include('include/script.php'); ?>
</body>

</html>