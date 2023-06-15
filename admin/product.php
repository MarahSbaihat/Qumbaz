<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');
    require('include/connection.php');

    $sql = "SELECT * FROM `centralproducts`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
    ?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <?php
        include('include/navbar.php');
        ?>

        <div class="admins pt-5">
            <div class="container pt-5">
                        
                <!-- alerts -->
                <?php require('./include/alerts.php') ?>

                <div class="py-3 container d-flex justify-content-between">
                    <h2 class="h2 text-capitalize">products</h2>
                    <a class="btn text-capitalize rounded-pill py-2 px-3" href="add-product.php">add product</a>
                </div>
                <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">title</th>
                            <th scope="col">image</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($products)):
                            foreach ($products as $product) : ?>
                                <tr>
                                    <th scope="row"><?=$product['id']?></th>
                                    <th scope="row"><?=$product['title']?></th>
                                    <td><img class="w-25 rounded" src="./handlers/upload/product/<?= $product['image'] ?>" alt="image of <?= $product['title'] ?>" /></td>
                                    <td class="d-flex">
                                        <a href="update-product.php?id=<?=$product['id']?>"><i class="fa-solid fa-pen-to-square rounded-pill bg-info text-light py-1 px-2"></i></a>
                                        <a href="handlers/delete-product.php?id=<?=$product['id']?>"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
                                    </td>
                                </tr>
                                <?php 
                        endforeach; 
                    endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        include('include/script.php');
        ?>

    </body>

</html>