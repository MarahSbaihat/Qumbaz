<!DOCTYPE html>
<html lang="en">

    <?php
    session_start();
    include('include/head.php');
    ?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <div class="login">
            <div class="container text-center">
                <div class="row d-flex align-items-center vh-100">
                    <div class="col-md-5 wow animate__animated animate__bounceInLeft" data-wow-duration="2s">
                        <img class="avatar pb-3" src="assets/img/heritage.jpg" alt="flag" />
                    </div>
                    <div class="col-md-6 offset-1 wow animate__animated animate__bounceInRight" data-wow-duration="2s">
                        <div class="text-start">
                        
                            <!-- alerts -->
                            <?php require('include/alerts.php') ?>
            
                            <form action="handlers/login.php" method="POST">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label text-capitalize">email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                                </div>
                                <div class="mb-3"> <label for="exampleInputPassword1" class="form-label text-capitalize">password</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" />
                                </div>
                                <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">sign in</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include('include/script.php');
        ?>

    </body>

</html>