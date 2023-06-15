<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');
    require('include/connection.php');

    $sql = "SELECT * FROM `products`";
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
                <div class="py-3 container d-flex justify-content-between">
                    <h2 class="h2 text-capitalize">Products</h2>
                </div>
                <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">product</th>
                            <th scope="col">image</th>
                            <th scope="col">price</th>
                            <th scope="col">quantity</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($products)):
                                foreach ($products as $product) : ?>
                                    <tr>
                                        <th scope="row"><?=$product['id']?></th>
                                        <td><?=$product['name']?></td>
                                        <td><img class="w-25" src="./../handler/upload/product/<?=$product['image']?>" alt="<?=$product['name']?>product"></td>
                                        <td><?=$product['price']?></td>
                                        <td><?=$product['quantity']?></td>
                                        <td>
                                            <a href="handlers/delete-products.php?id=<?=$product['id']?>"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
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