<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');
    require('include/connection.php');

    $id = $_GET['id'];
    $sql = "SELECT * FROM `customers` WHERE id = $id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
    $sql = "SELECT * FROM `customer_details` WHERE customer_id = $id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $details = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    // print_r($details);
    // print_r($user);
    
    ?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <?php
        include('include/navbar.php');
        ?>

        <div class="person">
            
            <!-- alerts -->
            <?php require('./include/alerts.php') ?>

            <div class="container row d-flex align-items-center vh-100">
                <div class="col-md-5">
                    <img src="../handler/upload/account/<?=$user[0]['image']?>" alt="person" class="w-100 m-auto wow animate__animated animate__backInLeft" data-wow-duration="2s">
                </div>
                <div class="col-md-6 offset-1 wow animate__animated animate__backInRight" data-wow-duration="2s">
                    <h3 class="h3 pb-3"><?=$user[0]['name']?></h3>
                    <p class="p">E-mail: <?=$user[0]['email']?></p>
                    <p class="p">address: <?=$user[0]['address']?></p>
                    <p class="p1"><?=$user[0]['bio']?></p>
                    <p class="p">
                        Phone number: 
                        <ul>
                            <?php
                                if(isset($details)):
                                    foreach ($details as $item) : ?>
                                        <li><?=$item['phone']?></li>
                                    <?php 
                                endforeach; 
                            endif; ?>
                        </ul>
                    </p>
                </div>
            </div>

            <div class="border mx-5"></div>

            <div class="admins">
                <!-- customer -->
                <div class="container pt-5 wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <div class="py-3 container d-flex justify-content-between">
                        <h2 class="h2 text-capitalize">favourite <i class="fa-solid fa-heart fa-2xs"></i></h2>
                    </div>
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">category</th>
                                <th scope="col">image</th>
                                <th scope="col">price</th>
                                <th scope="col">receipt</th>
                                <th scope="col">created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>dress</td>
                                <td>embroidered</td>
                                <td><img src="assets/img/cat-embroiders.jpg" alt="order" class="w-25"></td>
                                <td>1000$</td>
                                <td>✔</td>
                                <td>2023-02-14 21:14:17</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>dress</td>
                                <td>embroidered</td>
                                <td><img src="assets/img/cat-embroiders.jpg" alt="order" class="w-25"></td>
                                <td>1000$</td>
                                <td>❌</td>
                                <td>2023-02-14 21:14:17</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container pt-5 wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <div class="py-3 container d-flex justify-content-between">
                        <h2 class="h2 text-capitalize">cart <i class="fa-solid fa-cart-shopping fa-2xs"></i></h2>
                    </div>
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">category</th>
                                <th scope="col">image</th>
                                <th scope="col">price</th>
                                <th scope="col">receipt</th>
                                <th scope="col">created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>dress</td>
                                <td>embroidered</td>
                                <td><img src="assets/img/cat-embroiders.jpg" alt="order" class="w-25"></td>
                                <td>1000$</td>
                                <td>✔</td>
                                <td>2023-02-14 21:14:17</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>dress</td>
                                <td>embroidered</td>
                                <td><img src="assets/img/cat-embroiders.jpg" alt="order" class="w-25"></td>
                                <td>1000$</td>
                                <td>❌</td>
                                <td>2023-02-14 21:14:17</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="container pt-5 wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <div class="py-3 container d-flex justify-content-between">
                        <h2 class="h2 text-capitalize">orders <i class="fa-solid fa-credit-card fa-2xs"></i></h2>
                    </div>
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">category</th>
                                <th scope="col">image</th>
                                <th scope="col">price</th>
                                <th scope="col">receipt</th>
                                <th scope="col">created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>dress</td>
                                <td>embroidered</td>
                                <td><img src="assets/img/cat-embroiders.jpg" alt="order" class="w-25"></td>
                                <td>1000$</td>
                                <td>✔</td>
                                <td>2023-02-14 21:14:17</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>dress</td>
                                <td>embroidered</td>
                                <td><img src="assets/img/cat-embroiders.jpg" alt="order" class="w-25"></td>
                                <td>1000$</td>
                                <td>❌</td>
                                <td>2023-02-14 21:14:17</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php
        include('include/script.php');
        ?>

    </body>

</html>