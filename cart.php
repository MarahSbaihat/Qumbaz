<!DOCTYPE html>
<html lang="en">

<?php

    include('include/head.php');
    include('include/connection.php');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    $sql = "SELECT carts.id, carts.product_id, carts.customer_id, products.image,products.id AS products_id, products.name, products.price, products.clasify_id, products.producer_id
        FROM carts
        JOIN products ON carts.product_id = products.id
        WHERE carts.customer_id = $id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }}
?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <!-- Navbar -->
        <?php
        include('include/navbar.php');
        ?>
        <!-- End Navbar -->

        <div class="table pt-5">
            <div class="container pt-5">
                <div class="py-3 container d-flex justify-content-between">
                    <h3 class="h3 text-capitalize">cart</h3>
                </div>
                <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                
                        
                 <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">image</th>
                            <th scope="col">product_name</th>
                            <th scope="col">classifications</th>
                            <th scope="col">produser_name</th>
                            <th scope="col">price</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    if(isset($products)):
                        $count = 1;
                        foreach ($products as $product) : ?>
                    
                    <!-- error_reporting(E_ALL);
                    ini_set('display_errors', 1);
                     -->
			         	
                                <tr><th scope='row'><?= $count ?></th>
                                <td><img class ='w-25 rounded' src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>"></td>
                                <td><?= $product['name'] ?></td>
                                <?php
                                                        $sql = "SELECT * FROM `classifications` where `id` = $product[clasify_id]";
                                                        $query = mysqli_query($conn, $sql);
                                                        if (mysqli_num_rows($query) > 0) {
                                                            $clasifies = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                                        }
                                                    ?>
                                <td><?= $clasifies[0]['category'] ?></td>
                                <?php
                                                        $sql = "SELECT `name` FROM `producers` where `id` = $product[producer_id]";
                                                        $query = mysqli_query($conn, $sql);
                                                        if (mysqli_num_rows($query) > 0) {
                                                            $produsers = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                                        }
                                                    ?>
                                <td><?= $produsers[0]['name'] ?></td>
                                <td><?= $product['price'] ?></td>
                                <!-- // <td><button onclick='deleteRow(this)'><i class='fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2'></i></button></td>"; -->
                                <td>
                                    <form action="include\delete-cart.php" method="POST">
                                        <button class="rounded-pill bg-danger text-light py-1 px-2">
                                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                            <input type="hidden" name="customer_id" value="<?= $product['customer_id'] ?>">
                                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>                    
                                        </tr>
                            
                                <?php
                            $count++;
                        endforeach; 
                    endif;
                        ?>
                        <!-- <tr>
                            <th scope="row">1</th>
                            <td><img style="width:100px" src="assets/img/profile/profile default.jpg" alt="product"></td>
                            <td>Image name</td>
                            <td>Category</td>
                            <td>ahmed</td>
                            <td>30</td>
                            <td>
                                <a href="#"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        include('include/footer.php');
        ?>


        <?php
        include('include/script.php');
        ?>

    </body>

</html>