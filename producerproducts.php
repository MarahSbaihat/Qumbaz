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
        include('include/navbar.php');
        ?>

        <div class="table pt-5">
            <div class="container pt-5">
                <div class="py-3 container d-flex justify-content-between">
                    <h3 class="h3 text-capitalize">products</h3>
                    <a class="btn text-capitalize rounded-pill py-2 px-3" href="add-admins.php">add products</a>
                </div>
                <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td><img style="width:100px" src="assets/img/profile/profile default.jpg" alt="product"></td>
                            <td>Image name</td>
                            <td>Category</td>
                            <td>
                                <a href="update-admin.php"><i class="fa-solid fa-pen-to-square rounded-pill bg-info text-light py-1 px-2"></i></a>
                                <a href="#"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <?php
        include('include/footer.php');
        ?>


        <?php
        include('include/script.php');
        ?>

    </body>

</html>