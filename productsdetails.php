<!DOCTYPE html>
<html lang="en">

<?php
include('include/head.php');
?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// print_r($_SESSION);
$customer_id = $_SESSION['user'][0]['id'];
?>

<body>

    <div class="btnTop">
        <i class="fa-solid fa-angle-up"></i>
    </div>

    <?php
    include('include/navbar.php');
    ?>
    <?php
    include('include/connection.php');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM products WHERE id=$id";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
        }
    } else {
        echo 'لا يوجد منتج بهذا الرقم المعرف.';
    }


    ?>


    <div class="productdetails">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-5 my-5 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                    <?php
                    if (isset($products)) :
                        foreach ($products as $product) : 
                            $product_id = $product['id'];
                            ?>
                            <img class="image1 w-100" src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                </div>
                <div class="col-md-6 offset-1 wow animate__animated animate__backInRight" data-wow-duration="2s">
                    <h3 class="h3 pb-3">Name:<?= $product['name'] ?></h3>
                    <?php
                            $sql = "SELECT * FROM classifications WHERE id = {$product['clasify_id']}";
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                $clasify = mysqli_fetch_assoc($query);
                            }
                    ?>
                    <p class="p">category:<?= $clasify['category'] ?></p>

                    <p class="p"><?= $product['details'] ?></p>
                    price:<?php
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
                    <?php
                            $sql = "SELECT * FROM producers WHERE id = $product[producer_id]";
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                $producer = mysqli_fetch_assoc($query);
                            }
                    ?>
                 <p class="p1"> <a href="producer.php?id=<?=$producer['id']?>">  producer name: <?= $producer['name'] ?></a></p>
                    <div class="d-flex">
<?php 
if ($_SESSION['account_type'] == 'customer') {?>
                        <form action="add-to-favourite-from-productdetails.php" method="get">
                        <input type="hidden" name="id" value="<?= $_SESSION['user'][0]['id'] ?>">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <button class="border border-none bg-transparent text-danger">
                                
                                <!-- <i class="fa-regular fa-heart"></i> -->
                                <?php
                                

                                // Check if the product exists in favourites
                                $checkSql = "SELECT * FROM favourites WHERE product_id = $product_id AND customer_id = $customer_id";
                                $result = mysqli_query($conn, $checkSql);

                                if (mysqli_num_rows($result) > 0) {
                                    // Product exists in favourites, display a different icon
                                    echo '<i class="fa-solid fa-heart"></i>';
                                } else {
                                    // Product doesn't exist in favourites, display the default icon
                                    echo '<i class="fa-regular fa-heart"></i>';
                                }
                                ?>
                            </button>
                        </form>
                        <form action="add_to_cart_from_productdetails.php" method="get">
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
                                ?> </button></form>
                                <!-- <form action="form-order.php" method="post"> -->
                                <form action="include\check_quantity.php" method="post">
                                <input type="hidden" name="customer_id" value="<?=$customer_id ?>">
                                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                <button class="border border-none bg-transparent">
                                    <i class="fa-solid fa-truck"></i>    
                                </button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="border mx-5 my-5"></div>
    </div>



    <?php
     $sql = "SELECT  classifications.category,
    classifications.categories_id,
    classifications.id,
    products.clasify_id,
    products.image,
    products.name,
    products.quantity,
    products.price,
    products.discount,
    products.id AS 'product-id',
    products.details 
    FROM `classifications` 
    JOIN `products` ON classifications.id = products.clasify_id
    WHERE classifications.id = {$product['clasify_id']}";

    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
         $classifications = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }



    ?>
    <header class="home py-5">
        <div class="image">
            <div class="container">
                <div class="row">
                    <?php
                            if (isset($classifications)) :
                                foreach ($classifications as $clasify) : ?>
                            <div class="item col-md-3 m-auto position-relative">
                                <div class="hover wow animate__animated animate__backInDown" data-wow-duration="2s">
                                    <div class="w-90 position-relative">
                                        <a href="productsdetails.php?id=<?= $clasify['product-id'] ?>">
                                            <div class="overlay w-100">
                                                <i class="fa-solid fa-magnifying-glass-plus"></i>
                                            </div>
                                            <img class="image1 w-100" src="<?= $clasify['image'] ?>" alt="<?= $clasify['name'] ?>">
                                            <div class="info d-flex justify-content-between p-3 align-items-center">
                                                <div class="desc w-100">
                                                    <?php
                                                    // $sql = "SELECT `category` FROM `classifications` where `id` = $product[clasify_id]";
                                                    // $query = mysqli_query($conn, $sql);
                                                    // if (mysqli_num_rows($query) > 0) {
                                                    //     $clasifies = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                                    // }
                                                    ?>
                                                    <h3><?= $clasify['category'] ?></h3>
                                                    <div class="w-50 d-flex justify-content-between">
                                                        <p>quantity: <?= $clasify['quantity'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="icon d-flex">
                                                <?php 
if ($_SESSION['account_type'] == 'customer') {?>
                                                    <form action="add-to-favourite-from-productdetails.php" method="get">
                                                    <input type="hidden" name="id" value="<?= $_SESSION['user'][0]['id'] ?>">
                                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                        <button class="border border-none bg-transparent text-danger">
                                                            
                                                            <!-- <i class="fa-regular fa-heart"></i> -->
                                                            <?php
                                                            $product_id = $product['id'];
                                                            $customer_id = $_SESSION['user'][0]['id'];

                                                            // Check if the product exists in favourites
                                                            $checkSql = "SELECT * FROM favourites WHERE product_id = $product_id AND customer_id = $customer_id";
                                                            $result = mysqli_query($conn, $checkSql);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Product exists in favourites, display a different icon
                                                                echo '<i class="fa-solid fa-heart"></i>';
                                                            } else {
                                                                // Product doesn't exist in favourites, display the default icon
                                                                echo '<i class="fa-regular fa-heart"></i>';
                                                            }
                                                            ?>
                                                        </button>
                                                    </form>
                                                    <form action="add_to_cart_from_productdetails.php" method="get">
                                                    <input type="hidden" name="id" value="<?= $_SESSION['user'][0]['id'] ?>">
                                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                        <button class="border border-none bg-transparent">
                                                            
                                                            <?php
                                                            $product_id = $product['id'];
                                                            $customer_id = $_SESSION['user'][0]['id'];

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
                                                            ?> </button>
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details d-flex justify-content-between mx-2">
                                        <p class="p"><?= $clasify['name'] ?></p>
                                        <?php
                                        $originalPrice = $clasify['price'];
                                        $discount = $clasify['discount'];
                                        $discountedPrice = $originalPrice - ($originalPrice * ($discount / 100));
                                        ?>

                                        <p class="p">
                                            <?php if (isset($discount) && $discount != 0) : ?>
                                                <span class="original-price"><s><?= $originalPrice ?> nis</s></span>
                                                <span class="discounted-price"><?= $discountedPrice ?> nis</span>
                                            <?php else : ?>
                                                <span class="original-price"><?= $originalPrice ?> nis</span>
                                            <?php endif; ?>

                                        </p>                                    </div>
                                </div>
                            </div>
                    <?php
                                endforeach;
                            endif; ?>
                </div>
            </div>
        </div>
    </header>
<?php
                        endforeach;
                    endif; ?>
<?php include('include/footer.php'); ?>
<?php include('include/script.php'); ?>
</body>

</html>