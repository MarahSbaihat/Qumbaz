<!DOCTYPE html>
<html lang="en">

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    require('include/head.php');

    // if (!$_SESSION['admin']['role'] == 'super_admin'){
    //     header('location: index.php');
    // }

    require('include/connection.php');

    $sql = "SELECT * FROM `admins`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $admins = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
    ?>

<body>

    <div class="btnTop">
        <i class="fa-solid fa-angle-up"></i>
    </div>

    <?php
    include('include/navbar.php');

    // if(isset($yourArray['admins'])){
    //     if(!is_null($_SESSION['admins']) && isset($_SESSION['admins']['role'])){
    //         if ($_SESSION['admins']['role'] == 'admin') {
    //             header('location: index.php');
    //         }
    //     }
    // }
    ?>

    <div class="admins pt-5">
        <div class="container pt-5">

            <!-- alerts -->
            <?php require('./include/alerts.php') ?>

            <div class="py-3 container d-flex justify-content-between">
                <h2 class="h2 text-capitalize">admins</h2>
                <a class="btn text-capitalize rounded-pill py-2 px-3" href="add-admins.php">add admins</a>
            </div>
            <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">is_active</th>
                        <th scope="col">image</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(isset($admins)):
                        foreach ($admins as $admin) : ?>
                            <tr>
                                <th scope="row">1</th>
                                <td><?= $admin['name'] ?></td>
                                <td><?= $admin['email'] ?></td>
                                <td><?= $admin['is_active'] == 1 ? '<i class="fa-solid fa-check rounded-pill bg-success text-light py-1 px-2"></i>' : '<i class="fa-solid fa-xmark rounded-pill bg-danger text-light py-1 px-2"></i>' ?></td>
                                <td><img class="w-25 rounded" src="./handlers/upload/admin/<?= $admin['image'] ?>" alt="image of <?= $admin['name'] ?>" /></td>
                                <td class="d-flex">
                                    <a href="update-admin.php?id=<?=$admin['id']?>"><i class="fa-solid fa-pen-to-square rounded-pill bg-info text-light py-1 px-2"></i></a>
                                    
                                    <!-- <form action="handlers/delete-admin.php" method="POST">
                                        <button class="rounded-pill bg-danger text-light py-1 px-2">
                                            <input type="hidden" name="id" value="<?=$admin['id']?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form> -->
                                    <a href="handlers/delete-admin.php?id=<?=$admin['id']?>"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
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