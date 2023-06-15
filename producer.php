<!doctype html>
<html lang="en">
<?php

// print_r($_SESSION);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include('include/head.php');
    include('include/connection.php');
    $sql = "SELECT * FROM `producers` WHERE `id` = $id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $producers = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
} else {
    echo 'لا يوجد منتج بهذا الرقم المعرف.';
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
                            <?php
                            if (isset($producers)) :
                                foreach ($producers as $producer) : ?>
                                    <div class='ms-4 mt-5 d-flex flex-column'>
                                        <img class="mg-fluid img-thumbnail mt-4 mb-2" src="handler/upload/account/<?= $producer['image'] ?>" alt="<?= $producer['name'] ?>">
                                        <a class='btn text-capitalize rounded-pill py-2 px-3' href=''>follow</a>
                                    </div>
                                    <div class='madakalak ms-3'>
                                        <h5><?= $producer['name'] ?></h5>
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
                                    <p class='lead fw-normal mb-1'>About</p>
                                    <div class='p-4'>
                                        <p class="font-italic mb-1"><?= $producer['bio'] ?></p>
                                    </div>
                                </div>
                                <h3 class="font-italic mb-1">product:</h3>
                                <?php
                                // JOIN  producers  ON  products.id = producers.id 
                                $sql = "SELECT * FROM `products` WHERE producer_id = $producer[id] ";
                                $query = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($query) > 0) {
                                    $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                    $productCount = count($products);
                                    $productIndex = 0;
                                    while ($productIndex < $productCount) {
                                        ?>
                                        <div class="row my-3 g-2">
                                            <?php if ($productIndex < $productCount) : ?>
                                                <div class="col wow animate__animated animate__backInLeft" data-wow-duration="2s">
                                                    <img class="w-100 rounded-3" src="<?= $products[$productIndex]['image'] ?>" alt="<?= $products[$productIndex]['name'] ?>">
                                                </div>
                                            <?php endif; ?>
                                            <?php $productIndex++; ?>
                                            <?php if ($productIndex < $productCount) : ?>
                                                <div class="col wow animate__animated animate__backInRight" data-wow-duration="2s">
                                                    <img class="w-100 rounded-3" src="<?= $products[$productIndex]['image'] ?>" alt="<?= $products[$productIndex]['name'] ?>">
                                                </div>
                                            <?php endif; ?>
                                            <?php $productIndex++; ?>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            <?php
                                endforeach;
                            endif;
                            ?>
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
