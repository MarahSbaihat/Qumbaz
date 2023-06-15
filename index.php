<!doctype html>
<html lang="en">

    <?php
    include('include/head.php');
    require('include/connection.php');

    $sql = "SELECT * FROM `sliders`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $sliders = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    $sql = "SELECT * FROM `centralproducts`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    $sql = "SELECT * FROM `questions`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $questions = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
      
    ?>

    <body>

        <div class="color-box">
            <div class="color-option">
                <h2>colors</h2>
                <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <i class="fa-solid fa-cog fa-spin"></i>
        </div>
        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>
        <div class="loader">
            <span class="spinner"></span>
        </div>

        <?php
        include('include/navbar.php');
        ?>

        <header id="headercarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="over d-flex justify-content-center">
                <div class="in py-5 rounded text-center wow animate__animated animate__bounceInUp" data-wow-duration="2s" data-wow-delay="4s">
                    <div class="overlay"></div>
                    <h1 class="h1 text-uppercase pb-2 mb-2 change-color">qumbaz</h1>
                    <p class="p change-color">An online store that displays authentic Palestinian handmade products in their true form and in their modern form that suits our current era</p>
                </div>
            </div>
            <div class="carousel-inner">
                <?php 
                    if(isset($sliders)):
                        foreach ($sliders as $index => $slider) : ?>
                            <div class="carousel-item <?= $index==0 ? 'active' : '' ?> h-100 w-100">
                                <img src="./admin/handlers/upload/slider/<?= $slider['image'] ?>" class="d-block w-100 imgc" alt="...">
                            </div>
                        <?php 
                    endforeach; 
                endif; ?>
                <!-- <div class="carousel-item active h-100 w-100">
                    <img src="assets/img/central/product/embroidered/dabka-tradational.jpeg" class="d-block w-100 imgc" alt="...">
                </div>
                <div class="carousel-item h-100 w-100">
                    <img src="assets/img/central/product/embroidered/heritage" class="d-block w-100 imgc" alt="...">
                </div>
                <div class="carousel-item h-100 w-100">
                    <img src="assets/img/central/product/embroidered/ebroider.webp" class="d-block w-100 imgc" alt="...">
                </div>
                <div class="carousel-item h-100 w-100">
                    <img src="assets/img/central/product/embroidered/girls.jpg" class="d-block w-100 imgc" alt="...">
                </div>
                <div class="carousel-item h-100 w-100">
                    <img src="assets/img/central/product/embroidered/wedding.jpg" class="d-block w-100 imgc" alt="...">
                </div>
                <div class="carousel-item h-100 w-100">
                    <img src="assets/img/central/product/embroidered/music.webp" class="d-block w-100 imgc" alt="...">
                </div> -->
            </div>
            <button class="carousel-controll carousel-control-prev text-dark" type="button" data-bs-target="#headercarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-controll carousel-control-next text-dark" type="button" data-bs-target="#headercarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </header>

        <section class="about py-5" id="about">
            <h2 class="h2 text-uppercase text-center">about qumbaz</h2>
            <div class="container">
                <div class="row py-5 d-flex align-items-center">
                    <div class="col-md-6 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                        <img class="img1 m-auto" src="assets/img/central/about/palestine.png" alt="">
                    </div>
                    <div class="col-md-6">
                        <h5 class="h5 text-capitalize wow animate__animated animate__backInRight" data-wow-duration="2s">qumbaz</h5>
                        <!-- <label id="aboutLabel" class="p wow animate__animated animate__backInUp" data-wow-duration="2s">Qumbaz is a gateway to promote Palestinian producers and their traditional handicraft products in all their forms, sell them on a large scale, and facilitate the demand for these products throughout Palestine.</label> -->
                        <p class="p wow animate__animated animate__backInRight" data-wow-duration="2s">Qumbaz is a gateway to promote Palestinian producers and their traditional handicraft products in all their forms, sell them on a large scale, and facilitate the demand for these products throughout Palestine.</p>
                        <!-- <button id="updateAbout" class="border border-none more text-capitalize rounded-pill mt-5 py-2 px-3 wow animate__animated animate__backInUp" data-wow-duration="2s">edit <i class="fa-solid fa-pen-to-square"></i></button> -->
                        <div class="about text-center pt-5">
                            <div class="row mb-5">
                                <div class="col-md-4 wow animate__animated animate__backInRight" data-wow-duration="2s">
                                    <i class="fa-solid fa-eye fa-2xl"></i>
                                    <h5 class="h5 text-capitalize">vision</h5>
                                    <p class="p">A unique Palestinian interactive website that contributes to the promotion and sale of old and updated Palestinian handicrafts in a new way that keeps pace with our current era.</p>
                                </div>
                                <div class="col-md-4 wow animate__animated animate__backInRight" data-wow-duration="2s">
                                    <i class="fa-solid fa-gem fa-2xl"></i>
                                    <h5 class="h5 text-capitalize">values</h5>
                                    <p class="p">A person lives in this life according to certain values ​​that he applies or seeks to reach, and a sign indicating the good progress of work in its previous stages (feedback).</p>
                                </div>
                                <div class="col-md-4 wow animate__animated animate__backInRight" data-wow-duration="2s">
                                    <i class="fa-solid fa-leaf fa-2xl"></i>
                                    <h5 class="h5 text-capitalize">mission</h5>
                                    <p class="p">Enabling Qmbaz to achieve its ambitions in line with the team's initial principles and national priorities.</p>
                                </div>
                            </div>
                            <a href="about.php" class="more text-capitalize rounded-pill mt-5 py-2 px-3 wow animate__animated animate__backInUp" data-wow-duration="2s">read more <i class="fa-solid fa-angles-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="info">
            <div class="container">
                <div class="row text-center py-5">
                    <div class="col-md-3 wow animate__animated animate__backInUp" data-wow-duration="2s">
                        <i class="fa-solid fa-thumbs-up fa-2xl"></i>
                        <p class="p pt-3">1550</p>
                        <p class="p1 text-capitalize">satisfied customer</p>
                    </div>
                    <div class="col-md-3 wow animate__animated animate__backInUp" data-wow-duration="2s">
                        <i class="fa-solid fa-user fa-2xl"></i>
                        <p class="p pt-3">125</p>
                        <p class="p1 text-capitalize">producer</p>
                    </div>
                    <div class="col-md-3 wow animate__animated animate__backInUp" data-wow-duration="2s">
                        <i class="fa-solid fa-cart-shopping fa-2xl"></i>
                        <p class="p pt-3">5679</p>
                        <p class="p1 text-capitalize">products</p>
                    </div>
                    <div class="col-md-3 wow animate__animated animate__backInUp" data-wow-duration="2s">
                        <i class="fa-solid fa-truck fa-2xl"></i>
                        <p class="p pt-3">23</p>
                        <p class="p1 text-capitalize">shipping van</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="product py-5" id="product">
            <h2 class="h2 text-uppercase text-center">product</h2>
            <div class="container text-center pt-5">
                <div class="row pb-5">
                    <?php 
                        if(isset($products)):
                            foreach ($products as $product) : ?>
                                <div class="col-md-4 m-auto my-5 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                                    <a href="product.php?category=<?=$product['title']?>">
                                        <img src="./admin/handlers/upload/product/<?= $product['image'] ?>" alt="some product">
                                    </a>
                                    <h3 class="h3 text-capitalize py-4 text-center"><?=$product['title']?></h3>
                                </div>
                            <?php 
                        endforeach; 
                    endif; ?>
                    <!-- <div class="col-md-4 m-auto my-5 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                        <a href="product.php">
                            <img src="assets/img/central/products/embroidered.jpg" alt="some product">
                        </a>
                        <h3 class="h3 text-capitalize py-4 text-center">embroidered</h3>
                    </div>
                    <div class="col-md-4 m-auto my-5 wow animate__animated animate__backInDown" data-wow-duration="2s">
                        <a href="product.php">
                            <img src="assets/img/central/products/furniture.jfif" alt="some product">
                        </a>
                        <h3 class="h3 text-capitalize py-4 text-center">furniture</h3>
                    </div>
                    <div class="col-md-4 m-auto my-5 wow animate__animated animate__backInRight" data-wow-duration="2s">
                        <a href="product.php">
                            <img src="assets/img/central/products/tools.jpg" alt="some product">
                        </a>
                        <h3 class="h3 text-capitalize py-4 text-center">tools</h3>
                    </div>
                    <div class="col-md-4 m-auto my-5 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                        <a href="product.php">
                            <img src="assets/img/central/products/accessories.jfif" alt="some product">
                        </a>
                        <h3 class="h3 text-capitalize py-4 text-center">accessories</h3>
                    </div>
                    <div class="col-md-4 m-auto my-5 wow animate__animated animate__backInRight" data-wow-duration="2s">
                        <a href="product.php">
                            <img src="assets/img/central/products/soap.jfif" alt="some product">
                        </a>
                        <h3 class="h3 text-capitalize py-4 text-center">soap</h3>
                    </div> -->
                </div>
                <a class="more text-capitalize rounded-pill mt-5 py-2 px-3" href="login.php">more types <i class="fa-solid fa-angles-right"></i></a>
            </div>
        </section>

        <section class="question py-5" id="question">
            <div class="container text-center px-5">
                <h2 class="h2 text-uppercase text-center">questions</h2>
                <div class="accordion accordion-flush mb-5 mx-5 wow animate__animated animate__backInUp" data-wow-duration="2s" id="accordionFlushExample">
                    <h3 class="h3 text-capitalize pt-3 pb-1">frequently asked questions ...</h3>
                        <?php 
                            if(isset($questions)):
                                foreach ($questions as $index => $question) : ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed change-color" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?=$index?>" aria-expanded="false" aria-controls="flush-collapseOne">
                                                <?=$question['question']?>
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne<?=$index?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <?=$question['answer']?>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                            endforeach; 
                        endif; ?>
                    <!-- <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed change-color" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                what is Qumbaz ...
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                A site that publishes and markets traditional Palestinian handicrafts to revive them again and instill them in the hearts of generations.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed change-color" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                What is the Palestinian heritage ...
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                The Palestinian heritage is the historical stock of the Palestinian people, and this heritage is the result of the experiences of the ancestors who inhabited the land of Palestine throughout the historical ages.<br>The Palestinian heritage includes handicraft works and professions, as they have a special character that reflects the needs of the Palestinian society. The Palestinian heritage gave the Palestinian people a unique imprint that distinguishes them from other peoples.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed  change-color" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Technical problems ...
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                You can contact us directly when you encounter any technical problem in which you may need help, and we will be ready to help 24 hours a day
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                            <button class="accordion-button collapsed change-color" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                How much is the monthly subscription fee ...
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                There are two types of accounts:<br>
                                &nbsp; 1) customer ( Price : 0$ )<br>
                                &nbsp; 2) producer ( Price : 10$ )
                            </div>
                        </div>
                    </div> -->
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