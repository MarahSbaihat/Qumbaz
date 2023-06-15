<!doctype html>
<html lang="en">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cusID = $_SESSION['user'][0]['id'];
?>

<?php
include('include/head.php');
include('include/connection.php');
$sql = "SELECT * FROM `customers` WHERE `id`= $cusID";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    $customers = mysqli_fetch_all($query, MYSQLI_ASSOC);
}
?>

<body>

    <div class="btnTop">
        <i class="fa-solid fa-angle-up"></i>
    </div>

    <?php
    include('include/navbar.php');
    ?>

    <section class="h-100 gradient-custom-2 wow animate__animated animate__backInDown" data-wow-duration="2s">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row">
                            <div class='ms-4 mt-5 d-flex flex-column'>
                                <img class="mg-fluid img-thumbnail mt-4 mb-2" src="handler/upload/account/<?= $customers[0]['image'] ?>" alt="<?= $customers[0]['name'] ?>">

                                <form action="editprofileforcustomer.php" method="post" class="btn text-capitalize rounded-pill py-2 px-3 " >
                                    <input type="hidden" name="customer_id" value="<?= $_SESSION['user'][0]['id'] ?>">
                                    <button type="submit" > 
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                </form>
                            </div>
                            <div class='madakalak ms-3'>
                                <h5><?= $customers[0]['name'] ?></h5>
                            </div>
                        </div>
                        <div class='p-4 text-black'>
                            <div class='d-flex justify-content-end text-center py-1'>
                                <div class='small'>
                                    <p class='mb-1 px-5 h5'>478</p>
                                    <p class='small text-muted mb-0'>Following</p>
                                </div>
                            </div>
                        </div>
                        <div class='card-body p-4 text-black'>
                            <p class='lead fw-normal mb-1 mt-1'>About</p>
                            <div class='p-4'>
                                <p class="font-italic mb-1"><?= $customers[0]['bio'] ?></p>
                            </div>
                        </div>

                        <?php
                        // Fetch the favorite products
                        $sqlFavorites = "SELECT favourites.*, products.* FROM favourites 
                JOIN products ON favourites.product_id = products.id
                WHERE customer_id = $cusID
                LIMIT 2";
                        $resultFavorites = mysqli_query($conn, $sqlFavorites);

                        // Fetch the cart products
                        $sqlCart = "SELECT carts.*, products.* FROM carts 
            JOIN products ON carts.product_id = products.id
            WHERE customer_id = $cusID
            LIMIT 2";
                        $resultCart = mysqli_query($conn, $sqlCart);
                        ?>

                        <!-- Display favorite products -->
                        <div class="row my-3 g-2">
                            <p class="mb-0"><a href="favourite.php?id=<?= $customers[0]['id'] ?>" class="btn text-capitalize rounded-pill py-2 px-3"><i class="fa-solid fa-heart"></i> favourite</a></p>
                            <?php
                            if (mysqli_num_rows($resultFavorites) > 0) {
                                while ($rowFavorites = mysqli_fetch_assoc($resultFavorites)) {
                            ?>
                                    <div class="col mb-2 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                                        <a href="productsdetails.php?id=<?= $rowFavorites['product_id'] ?>"><img class="w-75 h-75 rounded-3" src="<?= $rowFavorites['image'] ?>" alt="<?= $rowFavorites['name'] ?>"></a>
                                    </div>
                            <?php
                                }
                            } else {
                                echo 'No favorite products found.';
                            }
                            ?>
                        </div>

                        <!-- Display cart products -->
                        <div class="row my-3 g-2">
                            <p class="mb-0"><a href="cart.php?id=<?= $customers[0]['id'] ?>" class="btn text-capitalize rounded-pill py-2 px-3"><i class="fa-solid fa-cart-shopping"></i> cart</a></p>
                            <?php
                            if (mysqli_num_rows($resultCart) > 0) {
                                while ($rowCart = mysqli_fetch_assoc($resultCart)) {
                            ?>
                                    <div class="col mb-2 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                                        <a href="productsdetails.php?id=<?= $rowCart['product_id'] ?>"><img class="w-75 h-75 rounded-3" src="<?= $rowCart['image'] ?>" alt="<?= $rowCart['name'] ?>"></a>
                                    </div>
                            <?php
                                }
                            } else {
                                echo 'No cart products found.';
                            }
                            ?>
                            <p class="mb-0 my-5 text-center"><a href="order.php?id=<?= $customers[0]['id'] ?>" class="btn text-capitalize rounded-pill py-2 px-3"><i class="fa-solid fa-truck"></i> order</a></p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include('include/footer.php');
    ?>

    <?php
    include('include/script.php');
    ?>

</body>

</html>
