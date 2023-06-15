<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');
    require('include/connection.php');

    $sql = "SELECT * FROM `logos`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $logos = mysqli_fetch_all($query, MYSQLI_ASSOC);
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

                <div class="py-3 container">
                    <h2 class="h2 text-capitalize">logo</h2>
                </div>
                <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">image</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(isset($logos)):
                            foreach ($logos as $logo) : ?>
                                <tr>
                                    <th scope="row"><?=$logo['id']?></th>
                                    <td><?=$logo['name']?></td>
                                    <td><img class="w-25 rounded" src="./handlers/upload/logo/<?= $logo['image'] ?>" alt="image of <?= $logo['name'] ?> logo" /></td>
                                    <td class="d-flex">
                                        <a href="update-logo.php?id=<?=$logo['id']?>"><i class="fa-solid fa-pen-to-square rounded-pill bg-info text-light py-1 px-2"></i></a>
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