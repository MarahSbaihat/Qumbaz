<!DOCTYPE html>
<html lang="en">

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include('include/head.php');
    // print_r($_SESSION);
    ?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <?php
        include('include/navbar.php');
        ?>

        <header class="pt-5">
            <div class="row pt-5 m-auto container">
                <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInLeft" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">admins</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">233</h5>
                                <a href="admins.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">central page</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">233</h5>
                                <a href="central.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInRight" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">home page</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">233</h5>
                                <a href="home.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInLeft" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">details</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">233</h5>
                                <a href="details.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInRight" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">products</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">233</h5>
                                <a href="products.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <?php
        include('include/script.php');
        ?>

    </body>

</html>