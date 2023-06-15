<!DOCTYPE html>
<html>

<?php
include('include/head.php');
include('include/connection.php');

if (isset($_POST['product_id']) && isset($_POST['customer_id'])) {
    $product_id = $_POST['product_id'];
    $customer_id = $_POST['customer_id'];

    $sql = "SELECT * FROM customers WHERE id = $customer_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $customers = mysqli_fetch_all($query, MYSQLI_ASSOC);
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
                <form action="include/add-to-order.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label text-capitalize">user name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputname" aria-describedby="name" value="<?= $customers[0]['name'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label text-capitalize">address</label>
                        <input type="text" name="address" class="form-control" id="exampleInputname" aria-describedby="name" value="<?= $customers[0]['address'] ?>">
                    </div>
                    <div class="mb-3">
                        <?php
                        $sql = "SELECT * FROM customer_details WHERE customer_id = $customer_id";
                        $query = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query) > 0) {
                            $customer_details = mysqli_fetch_all($query, MYSQLI_ASSOC);
                        }
                        ?>
                        <label for="exampleInputname" class="form-label text-capitalize">phone number</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputname" aria-describedby="name" value="<?= $customer_details[0]['phone'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label text-capitalize">pay account</label>
                        <select name="pay_account" class="form-select" aria-label="Default select example">
                            <option value=""></option>
                            <option value="PayPal">PayPal</option>
                            <option value="PalPay">PalPay</option>
                            <option value="JawwalPay">JawwalPay</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label text-capitalize">pay number</label>
                        <input type="text" name="pay_number" class="form-control" id="exampleInputname" aria-describedby="name" value="">
                    </div>
                    <input type="hidden" name="customer_id" value="<?= $customer_id ?>">
                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                    <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">
                        confirm
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php

} else {
    $_SESSION['errors'] = ['There was an error'];
    header("location: productsdetails.php?id=$product_id");
    exit();
}
?>

<?php
include('include/footer.php');
?>

<?php
include('include/script.php');
?>

</body>

</html>