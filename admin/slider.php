<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');
    require('include/connection.php');

    $sql = "SELECT * FROM `sliders`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $sliders = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
    ?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <?php
        include('include/navbar.php');
        ?>

        <div class="admins pt-5">
            <div class="container pt-5">

                <!-- alerts -->
                <?php require('./include/alerts.php') ?>

                <div class="py-3 container d-flex justify-content-between">
                    <h2 class="h2 text-capitalize">sliders</h2>
                    <a class="btn text-capitalize rounded-pill py-2 px-3" href="add-slider.php">add slider</a>
                </div>
                <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">image</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($sliders)):
                            foreach ($sliders as $slider) : ?>
                                <tr>
                                    <th scope="row"><?= $slider['id'] ?></th>
                                    <td>
                                    <img class="w-25 rounded" src="./handlers/upload/slider/<?= $slider['image'] ?>" alt="slider" />
                                    <td>
                                        <a href="update-slider.php?id=<?=$slider['id']?>"><i class="fa-solid fa-pen-to-square rounded-pill bg-info text-light py-1 px-2"></i></a>
                                        <a href="handlers/delete-slider.php?id=<?=$slider['id']?>"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
                                    </td>
                                </tr>
                                <?php 
                            endforeach; 
                        endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
        include('include/script.php');
        ?>

    </body>

</html>