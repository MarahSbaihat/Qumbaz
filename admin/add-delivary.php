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
        require('include/navbar.php');

        if(isset($yourArray['admins'])){
            if(!is_null($_SESSION['admins']) && isset($_SESSION['admins']['role'])){
                if ($_SESSION['admins']['role'] == 'admin') {
                    header('location: index.php');
                }
            }
        }
    ?>

    <div class="register">
        <div class="container text-center">
            <div class="row d-flex align-items-center vh-100">
                <div class="col-md-5 wow animate__animated animate__bounceInLeft" data-wow-duration="2s">
                    <img class="avatar" src="../assets/img/login/heritage.jpg" alt="">
                </div>
                <div class="col-md-6 offset-1 wow animate__animated animate__bounceInRight" data-wow-duration="2s">
                    <div class="text-start">
                        
                        <!-- alerts -->
                        <?php require('./include/alerts.php') ?>

                        <form action="handlers/create-delivary.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleInputname" class="form-label text-capitalize">company name</label>
                                <input type="text" class="form-control" name="company" id="exampleInputname" aria-describedby="name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label text-capitalize">email address</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputname" class="form-label text-capitalize">phone number</label>
                                <input type="phone" class="form-control" name="phone" id="exampleInputname" aria-describedby="name">
                            </div>
                            <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">add delivary</button>
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