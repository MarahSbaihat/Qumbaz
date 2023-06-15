<?php
include('include/head.php');
require('include/connection.php');

if (isset($_GET['category'])) {
    $category = strtolower($_GET['category']);

    $sql = "SELECT * FROM categories WHERE category = '$category'";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) > 0) {
        $categories = mysqli_fetch_assoc($query);
        $categoryID = $categories['id'];

        $sql = "SELECT * FROM classifications WHERE categories_id = '$categoryID'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            $classifications = mysqli_fetch_all($query, MYSQLI_ASSOC);
            $classificationIDs = array_column($classifications, 'id');
        
            foreach ($classificationIDs as $classificationID) {
                $sql = "SELECT * FROM products  WHERE clasify_id = '$classificationID'";
                $query = mysqli_query($conn, $sql);
        
                if (mysqli_num_rows($query) > 0) {
                    $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    // Process the products here
                }
            }
        }
        
    }
}
?>

<body>

    <div class="btnTop">
        <i class="fa-solid fa-angle-up"></i>
    </div>

    <?php
        include('include/navbar.php');
        ?>

        <section class="product py-3" id="product">
            <div class="container text-center">
                <div class="row">
                    <?php 
                        if(isset($products)):
                            foreach ($products as $product) : ?>
                                <div class="col-md-2 m-auto my-5 wow animate__animated animate__backInUp" data-wow-duration="2s">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn border border-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <img src="assets/img/central/products/embroidered.jpg" alt="some product">
                                    </button>
                                    <h3 class="h3 text-capitalize py-4 text-center"><?=$product['name']?></h3>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade modal-xl" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"><?=$categories['category']?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body py-5">
                                                <div class="row d-flex align-items-center">
                                                    <div class="col-md-5">
                                                        <img src="assets/img/central/products/embroidered.jpg" alt="some product">
                                                    </div>
                                                    <div class="col-md-7 text-start">
                                                        <h3 class="h3 text-capitalize pb-4">embroidered dress</h3>
                                                        <p class="p">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis eveniet fuga modi officia, totam ullam voluptas. Cupiditate aperiam odit laudantium quibusdam enim, rem, temporibus omnis voluptates, id ducimus itaque?</p>
                                                        <p class="p">price: <p class="p1"><?=$product['price']?> </p></p>
                                                        <a class="btn text-capitalize rounded-pill py-2 px-3" href="login.php">buy</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                        endforeach; 
                    endif; ?>
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