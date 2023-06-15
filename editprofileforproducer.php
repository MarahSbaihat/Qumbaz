<!doctype html>
<html lang="en">

    <?php
    include('include/head.php')
    ?>

    <body class="profile">

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <?php
        include('include/navbar.php')
        ?>



        <!-- Header -->
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(assets/img/ProfileProducer/proImg2.jpg); background-size: cover; background-position: center top;">
            <!-- Mask -->
            <span class="mask bg-gradient-default opacity-8"></span>
            <!-- Header container -->
            <div class="container-fluid d-flex align-items-center">
                <div class="row">
                    <div class="col-lg-7 col-md-10 wow animate__animated animate__bounceInUp" data-wow-duration="2s">
                        <h1 class="display-2">Hello Duha</h1>
                        <p class="mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-md-4 order-xl-2 mb-5 mb-xl-0 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                    <div class="card card-profile shadow">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        <img src="assets/img/ProfileProducer/proImg.jpg" class="rounded-circle">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="#" class="more btn text-capitalize rounded-pill mt-5 py-2 px-3">edit image</a>
                            <a href="#" class="more btn text-capitalize rounded-pill mt-5 py-2 px-3">add image</a>
                        </div>
                        <div class="card-body pt-0 pt-md-4">
                            <div class="row">
                                <div class="col">
                                    <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                        <div>
                                            <span class="heading">22</span>
                                            <span class="description">Following</span>
                                        </div>
                                        <div>
                                            <span class="heading">89</span>
                                            <span class="description">Comments</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3>
                                    Jessica Jones<span class="font-weight-light">, 27</span>
                                </h3>
                                <div class="h5 font-weight-300">
                                    <i class="ni location_pin mr-2"></i>Bucharest, Romania
                                </div>
                                <div class="h5 mt-4">
                                    <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                                </div>
                                <div>
                                    <i class="ni education_hat mr-2"></i>University of Computer Science
                                </div>
                                <hr class="my-4">
                                <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records
                                    all of his own music.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 order-xl-1 wow animate__animated animate__backInRight" data-wow-duration="2s">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Settings of my account</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form">
                                <h6 class="heading-small text-muted mb-4">User information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-username">Username</label>
                                                <input type="text" id="input-username" class="form-control form-control-alternative" placeholder="lucky.jesse">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email address</label>
                                                <input type="email" id="input-email" class="form-control form-control-alternative" placeholder="jesse@example.com">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-first-name">First name</label>
                                                <input type="text" id="input-first-name" class="form-control form-control-alternative" placeholder="Lucky">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-last-name">Last name</label>
                                                <input type="text" id="input-last-name" class="form-control form-control-alternative" placeholder="Jesse">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <!-- Address -->
                                <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-address">Address</label>
                                                <input id="input-address" class="form-control form-control-alternative" placeholder="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-city">City</label>
                                                <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="New York">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group focused">
                                                <label class="form-control-label" for="input-country">Country</label>
                                                <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="United States">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-Num">Number</label>
                                                <input type="text" id="input-Num" class="form-control form-control-alternative" placeholder="+972">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <!-- Description -->
                                <h6 class="heading-small text-muted mb-4">About me</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group ">
                                        <label class="form-control-label">About Me</label>
                                        <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ..."></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <?php
        include('include/footer.php')
        ?>

        <?php
        include('include/script.php')
        ?>

    </body>

</html>