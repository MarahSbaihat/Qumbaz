<!DOCTYPE html>
<html lang="en">

    <?php
    include('include/head.php');
    require('include/connection.php');

    $sql = "SELECT * FROM `producers`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $producers = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    $sql = "SELECT * FROM `customers`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $customers = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    $sql = "SELECT * FROM `delivaries`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $delivaries = mysqli_fetch_all($query, MYSQLI_ASSOC);
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
                    <h2 class="h2 text-capitalize">producers</h2>
                    <!-- <a href="#"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a> -->
                </div>
                <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">address</th>
                            <th scope="col">Phone number</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($producers)):
                                foreach ($producers as $producer) : ?>
                                    <tr>
                                        <th scope="row"><?= $producer['id']?></th>
                                        <td><?= $producer['name']?></td>
                                        <td><?= $producer['email']?></td>
                                        <td><?= $producer['address']?></td>
                                        <td>
                                            <ul>
                                                <?php 

                                                    $sql = "SELECT * FROM `producer_details` WHERE `producer_id` = $producer[id]";
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        $PDetails = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                                    }

                                                    if(isset($PDetails)):
                                                        foreach ($PDetails as $item) : ?>
                                                            <li><?= $item['phone']?></li>
                                                        <?php 
                                                    endforeach; 
                                                endif; ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="./view-details-producer.php?id=<?= $producer['id']?>"><i class="fa-solid fa-eye rounded-pill bg-info text-light py-1 px-2"></i></a>
                                            <a href="#"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
                                        </td>
                                    </tr>
                                <?php 
                            endforeach; 
                        endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="container pt-5">
                <div class="py-3 container d-flex justify-content-between">
                    <h2 class="h2 text-capitalize">customers</h2>
                    <!-- <a href="#"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a> -->
                </div>
                <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">email</th>
                            <th scope="col">address</th>
                            <th scope="col">phone number</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($customers)):
                                foreach ($customers as $customer) : ?>
                                    <tr>
                                        <th scope="row"><?= $customer['id']?></th>
                                        <td><?= $customer['name']?></td>
                                        <td><?= $customer['email']?></td>
                                        <td><?= $customer['address']?></td>
                                        <td>
                                            <ul>
                                                <?php          

                                                    $sql = "SELECT * FROM `customer_details` Where `customer_id` = $customer[id]";
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        $CDetails = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                                    }

                                                    if(isset($CDetails)):
                                                        foreach ($CDetails as $item) : ?>
                                                            <li><?= $item['phone']?></li>
                                                        <?php 
                                                    endforeach; 
                                                endif; ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="./view-details-customer.php?id=<?= $customer['id']?>"><i class="fa-solid fa-eye rounded-pill bg-info text-light py-1 px-2"></i></a>
                                            <a href="#"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
                                        </td>
                                    </tr>
                                <?php 
                            endforeach; 
                        endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="container pt-5">
                <div class="py-3 container d-flex justify-content-between">
                    <h2 class="h2 text-capitalize">deliveries</h2>
                    <a class="btn text-capitalize rounded-pill py-2 px-3" href="add-delivary.php">add delivary</a>
                </div>
                <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">company</th>
                            <th scope="col">email</th>
                            <th scope="col">response</th>
                            <th scope="col">phone number</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(isset($delivaries)):
                                foreach ($delivaries as $delivary) : ?>
                                    <tr>
                                        <th scope="row"><?= $delivary['id']?></th>
                                        <td><?= $delivary['company']?></td>
                                        <td><?= $delivary['email']?></td>
                                        <td><?= $delivary['response']?></td>
                                        <td>
                                            <ul>
                                                <?php          

                                                    $sql = "SELECT * FROM `delivary_phones` Where `delivary_id` = $delivary[id]";
                                                    $query = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($query) > 0) {
                                                        $DDetails = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                                    }

                                                    if(isset($DDetails)):
                                                        foreach ($DDetails as $item) : ?>
                                                            <li><?= $item['phone']?></li>
                                                        <?php 
                                                    endforeach; 
                                                endif; ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="./view-details-delivary.php?id=<?= $delivary['id']?>"><i class="fa-solid fa-eye rounded-pill bg-info text-light py-1 px-2"></i></a>
                                            <a href="#"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
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