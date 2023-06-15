<!DOCTYPE html>
<html lang="en">

<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } 
    
    include('include/head.php');

    // if (!$_SESSION['admin']['role'] == 'super_admin'){
    //     header('location: index.php');
    // }

?>

<body>

    <div class="btnTop">
        <i class="fa-solid fa-angle-up"></i>
    </div>

    <?php
        require('include/navbar.php');

        // if(isset($yourArray['admins'])){
        //     if(!is_null($_SESSION['admins']) && isset($_SESSION['admins']['role'])){
        //         if ($_SESSION['admins']['role'] == 'admin') {
        //             header('location: index.php');
        //         }
        //     }
        // }
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

                        <form action="handlers/create-admin.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="exampleInputname" class="form-label text-capitalize">user name</label>
                                <input type="text" class="form-control" name="name" id="exampleInputname" aria-describedby="name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label text-capitalize">email address</label>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label text-capitalize">password</label>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label text-capitalize">image</label>
                                <input type="file" class="form-control" name="image" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label text-capitalize">role</label>
                                <select class="form-select" aria-label="Default select example" name="role">
                                    <option value="admin" selected>admin</option>
                                    <option value="super_admin">Super admin</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label text-capitalize">is_active</label>
                                <select class="form-select" aria-label="Default select example" name="is_active">
                                    <option value="1" selected>active</option>
                                    <option value="0">not active</option>
                                </select>
                            </div>
                            <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">add admin</button>
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