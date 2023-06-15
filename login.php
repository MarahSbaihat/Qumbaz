<!DOCTYPE html>
<html>

    <?php
    include('include/head.php');
    session_start();
    ?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <?php
        include('include/navbar.php');
        ?>

        <div class="login py-5">
            <div class="row m-auto d-flex align-items-center container pt-5 text-center">
                <div class="col-md-5 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                    <img class="avatar pb-3" src="assets/img/login/heritage.jpg" alt="">
                </div>
                <div class="col-md-6 offset-1 text-start wow animate__animated animate__backInRight" data-wow-duration="2s">
                    
                    <!-- alerts -->
                    <?php require('./include/alerts.php') ?>

                    <form action="handler/login.php" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label text-capitalize">email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label text-capitalize">password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">sign in</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        include('include/footer.php');
        ?>

        <?php
        include('include/script.php');
        ?>

    </body>

</html>