<!DOCTYPE html>
<html lang="en">
    
    <?php
    include('include/head.php');
    require('include/connection.php');

    $sql = "SELECT * FROM `categories`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $categories = mysqli_fetch_all($query, MYSQLI_ASSOC);
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
                    <h2 class="h2 text-capitalize">categories</h2>
                    <a class="btn text-capitalize rounded-pill py-2 px-3" href="add-ctegories.php">add categories</a>
                </div>
                <table class="table text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">parent</th>
                            <th scope="col">category</th>
                            <th scope="col">image</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($categories)):
                                foreach ($categories as $category) : ?>
                                    <tr class="bg-light">
                                        <th scope="row"><?= $category['id']?></th>
                                        <td>-</td>
                                        <td><?= $category['category']?></td>
                                        <td><img class="w-25 rounded" src="./handlers/upload/category/<?= $category['image'] ?>" alt="image of <?= $category['category'] ?>" /></td>
                                        <td>
                                            <a href="update-categories.php?id=<?=$category['id']?>&type=categories"><i class="fa-solid fa-pen-to-square rounded-pill bg-info text-light py-1 px-2"></i></a>
                                            <a href="handlers/delete-category.php?id=<?=$category['id']?>&type=categories"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                        $sql = "SELECT * FROM `classifications` WHERE `categories_id` = $category[id]";
                                        $query = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($query) > 0) {
                                            $classifications = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                        }

                                        if(isset($classifications)):
                                            foreach ($classifications as $clasify) : ?>
                                                <tr class="bg-secondary" >
                                                    <th scope="row"><?= $category['id']?>.<?= $clasify['id']?></th>
                                                    <td><?= $category['category']?></td>
                                                    <td><?= $clasify['category']?></td>
                                                    <td><img class="w-25 rounded" src="./handlers/upload/category/<?= $clasify['image'] ?>" alt="image of <?= $clasify['category'] ?>" /></td>
                                                    <td>
                                                        <a href="update-categories.php?id=<?=$clasify['id']?>&type=classifications"><i class="fa-solid fa-pen-to-square rounded-pill bg-info text-light py-1 px-2"></i></a>
                                                        <a href="handlers/delete-category.php?id=<?=$clasify['id']?>&type=classifications"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
                                                    </td>
                                                </tr>
                                            <?php 
                                        endforeach; 
                                    endif; ?>
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