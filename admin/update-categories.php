<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');
    require('include/connection.php');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM `categories` where `id` = $id";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            $categories = mysqli_fetch_all($query, MYSQLI_ASSOC);
        }
    }
    ?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <?php
        include('include/navbar.php');
        require('include/connection.php');
        
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $type = $_GET['type'];
            $sql = "SELECT * FROM `$type` WHERE `id`=$id";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query)>0) {
                $category = mysqli_fetch_assoc($query);
            }else{
                $_SESSION['errors'] = ['no category found'];
                header('Location: ./home.php');
            }
        }else{
            $_SESSION['errors'] = ['something went wrong'];
            header('Location: ./home.php');
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

                            <form action="handlers/update-category.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <?php $cat = $category['category']?>
                                    <label for="exampleInputname" class="form-label text-capitalize">category</label>
                                    <input type="text" name="category" value="<?=$category['category']?>" class="form-control" id="exampleInputname" aria-describedby="name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label text-capitalize">parent</label>
                                    <select name="categories_id" class="form-select" aria-label="Default select example" name="role">
                                        <option value="" selected>category</option>
                                        <?php 
                                            if(isset($categories)):
                                                foreach ($categories as $category) : ?>
                                                    <option value="<?= $category['id']?>"><?= $category['category']?></option>
                                                <?php 
                                            endforeach; 
                                        endif; ?>
                                    </select>
                                    <div class="text-danger">Please make sure that the selected category is correct</div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label text-capitalize">image</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    <img class="rounded-circle w-25" src="handlers/upload/category/<?=$category['image']?>" alt="<?=$category['category']?> image">
                                </div>
                                <input type="hidden" name="type" value="<?=$type?>">
                                <input type="hidden" name="category_id" value="<?=$id?>">
                                <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">update category</button>
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