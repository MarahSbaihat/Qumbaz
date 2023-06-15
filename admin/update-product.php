<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');
    
    session_start();
    require('include/connection.php');
    
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM `centralproducts` WHERE `id`=$id";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query)>0) {
            $product = mysqli_fetch_assoc($query);
        }else{
            $_SESSION['errors'] = ['no product found'];
            header('Location: ./product.php');
        }
    }else{
        $_SESSION['errors'] = ['something went wrong'];
        header('Location: ./product.php');
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

                            <form action="handlers/update-product.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleInputname" class="form-label text-capitalize">title</label>
                                    <input type="text" value="<?=$product['title']?>" name="title" class="form-control" id="exampleInputname" aria-describedby="name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label text-capitalize">image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <img class="rounded-circle w-25" src="handlers/upload/product/<?=$product['image']?>" alt="<?=$product['title']?> image">
                                </div>

                                <input type="hidden" name="product_id" value="<?=$product['id']?>">
                                <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">update product</button>
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