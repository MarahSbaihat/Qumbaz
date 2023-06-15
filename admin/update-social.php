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

        <div class="register">
            <div class="container text-center">
                <div class="row d-flex align-items-center vh-100">
                    <div class="col-md-5 wow animate__animated animate__bounceInLeft" data-wow-duration="2s">
                        <img class="avatar" src="../assets/img/login/heritage.jpg" alt="">
                    </div>
                    <div class="col-md-6 offset-1 wow animate__animated animate__bounceInRight" data-wow-duration="2s">
                        <div class="text-start">
                            <form>
                                <div class="mb-3">
                                    <label for="exampleInputname" class="form-label text-capitalize">link</label>
                                    <input type="text" class="form-control" id="exampleInputname" aria-describedby="name">
                                </div>
                                <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">update social</button>
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