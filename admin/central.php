<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');
    ?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <?php
        include('include/navbar.php');
        ?>

        <header class="pt-5">
            <div class="row pt-5 px-4">
                <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInLeft" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">sliders</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">6</h5>
                                <a href="slider.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInDown" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">about qumbaz</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">4</h5>
                                <a href="about.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInDown" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">product</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">5</h5>
                                <a href="product.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInRight" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">questions</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">4</h5>
                                <a href="question.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">logo</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">1</h5>
                                <a href="logo.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-4 pt-5 m-auto wow animate__animated animate__backInRight" data-wow-duration="2s">
                    <div class="card mb-3">
                        <div class="card-header text-capitalize">footer</div>
                        <div class="card-body">
                            <div class="card-text d-flex justify-content-between align-items-center">
                                <h5 class="h5">3</h5>
                                <a href="footer.php" class="btn text-capitalize rounded-pill py-2 px-3">Show</a>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </header>

        <?php
        include('include/script.php');
        ?>

    </body>

</html>