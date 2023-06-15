<!DOCTYPE html>
<html>

<?php
include('include/head.php');
include('include/connection.php');
if (isset($_POST['customer_id'])) {
    $id = $_POST['customer_id'];
    $sql = "SELECT * FROM customers WHERE id=$id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $customers = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
} else {
    echo 'لا يوجد زبون بهذا الرقم المعرف.';
}

?>

<body>

<div class="btnTop">
    <i class="fa-solid fa-angle-up"></i>
</div>

<?php
include('include/navbar.php');
?>

<div class="register py-5">
    <div class="row d-flex align-items-center container pt-5 text-center">
        <div class="col-md-5 wow animate__animated animate__backInLeft" data-wow-duration="2s">
            <img class="avatar pb-3" src="assets/img/login/heritage.jpg" alt="">
        </div>
        <div class="col-md-6 offset-1 text-start wow animate__animated animate__backInRight" data-wow-duration="2s">

            <form action="update-profile.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="exampleInputname" class="form-label text-capitalize">user name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputname" aria-describedby="name" value="<?= $customers[0]['name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label text-capitalize">email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $customers[0]['email'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label text-capitalize">password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" value="<?= $customers[0]['password'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputname" class="form-label text-capitalize">image</label>
                    <input type="file" name="image" class="form-control" id="exampleInputname" aria-describedby="name">
                </div>
                <div class="mb-3">
                    <label for="exampleInputname" class="form-label text-capitalize">bio</label>
                    <input type="text" name="bio" class="form-control" id="exampleInputname" aria-describedby="name" value="<?= $customers[0]['bio'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputname" class="form-label text-capitalize">address</label>
                    <input type="text" name="address" class="form-control" id="exampleInputname" aria-describedby="name" value="<?= $customers[0]['address'] ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputname" class="form-label text-capitalize">phone number</label>
                    <?php
                    $sql = "SELECT * FROM customer_details WHERE customer_id = " . $customers[0]['id'];
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        $customer_details = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    }
                    ?>
                    <input type="text" name="phone" class="form-control" id="exampleInputname" aria-describedby="name" value="<?= $customer_details[0]['phone'] ?>">
                </div>
                <input type="hidden" name="customer_id" value="<?= $customers[0]['id'] ?>">
                <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">confirm</button>
            </form>
        </div>
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
