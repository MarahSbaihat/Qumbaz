<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');

    session_start();
    require('include/connection.php');
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM `sliders` WHERE `id`=$id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0) {
            $slider = mysqli_fetch_assoc($query);
        }else{
            $_SESSION['errors'] = ['no slider found'];
            header('Location: ./sliders.php');
        }
    }else{
        $_SESSION['errors'] = ['something went wrong'];
        header('Location: ./sliders.php');
    }
    session_destroy();
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

                            <!-- alerts -->
                            <?php require('./include/alerts.php') ?>
                            
                            <form action="handlers/update-slider.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label text-capitalize">image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <img class="rounded-circle w-25" src="handlers/upload/slider/<?=$slider['image']?>"/>
                                </div>
                                <input type="hidden" name="slider_id" value="<?=$slider['id']?>">
                                <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">update slider</button>
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