<!DOCTYPE html>
<html lang="en">
<?php
include('include/head.php');
include('include/connection.php');

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    
    $sql = "SELECT favourites.id, favourites.product_id, favourites.customer_id, products.image, products.id AS products_id, products.name, products.price, products.clasify_id, products.producer_id
    FROM favourites
    JOIN products ON favourites.product_id = products.id
    WHERE favourites.customer_id = $customer_id";

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

    <!-- Navbar -->
    <?php
    require('include/navbar.php');
    ?>
    <!-- End Navbar -->

    <div class="favourite pb-5 table">
        <div class="container pt-5">
            <div class="py-5 container d-flex justify-content-between">
            <a class="btn text-capitalize rounded-pill py-2 px-3" href="include/delete_all.php?id=<?= $customer_id ?>">delete all the favourite product</a>
            </div>
            <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">img</th>
                        <th scope="col">Price</th>
                        <th scope="col">producer</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if(isset($products)) {
                    $count = 1;
                    foreach ($products as $product) : ?>
                        <tr>
                            <th scope="row"><?= $count ?></th>
                            <td><?= $product['name'] ?></td>
                            <td><img class="w-25 rounded" src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" /></td>
                            <td><?= $product['price'] ?></td>
                            <?php
                            $sql = "SELECT * FROM `producers` where `id` = $product[producer_id]";
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                $producers = mysqli_fetch_all($query, MYSQLI_ASSOC);
                            }
                            ?>
                            <td><?= $producers[0]['name'] ?></td>
                            <td>
                                <form action="include/delete-favourite.php" method="POST">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                        <input type="hidden" name="customer_id" value="<?= $product['customer_id'] ?>">
                                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                    <button class="rounded-pill bg-danger text-light py-1 px-2">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $count++;
                    endforeach; 
                } else {
                    echo '<tr><td colspan="6">No results found.</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    require('include/footer.php');
    ?>

    <?php
    require('include/script.php');
    ?>

</body>

</html>
