<!doctype html>
<html lang="en">

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
include('include/head.php');
include('include/connection.php');

$type = $_SESSION['account_type'];
if ($type == 'customer'){
    header("location: ./profileforcustomer.php");
}

$prodID = $_SESSION['user'][0]['id'];
$cusql = "SELECT * FROM `producers` WHERE `id`=$prodID";
$curesult = mysqli_query($conn, $cusql);
$curew = mysqli_fetch_assoc($curesult);


if (($_SESSION['account_type'] == 'customer')) {
    $sql = "SELECT * FROM products
where producer_id='" . $_SESSION['user'][0]['id'] . "'";

    $result = mysqli_query($conn, $sql);
    $rew = mysqli_fetch_array($result);
    $posts = array();
    $r = 0;

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $po = array();
        $po["id"] = $row["id"];
        $po["name"] = $row["name"];
        $po["image"] = $row["image"];
        $posts[$r] = $po;
        $r++;
    }
}else{
    $sql = "SELECT * FROM customer_details
        where customer_id ='" . $_SESSION['user'][0]['id'] . "'";

    $result = mysqli_query($conn, $sql);
    $rew = mysqli_fetch_array($result);
    $posts = array();
    $r = 0;

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $po = array();
        $po["id"] = $row["id"];
        $po["name"] = $row["phone"];

        $posts[$r] = $po;
        $r++;
    }
}

$prodID = $_SESSION['user'][0]['id'];
$sql = "SELECT * FROM `products` WHERE `producer_id` = $prodID";
$query = mysqli_query($conn, $sql);
if(mysqli_num_rows($query)){
    $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
}
?>

<body>

    <div class="btnTop">
        <i class="fa-solid fa-angle-up"></i>
    </div>

    <?php
    include('include/navbar.php');
    ?>

    <section class="h-100 gradient-custom-2 wow animate__animated animate__backInDown" data-wow-duration="2s">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row">
                            <div class="ms-4 mt-5 d-flex flex-column">
                                <img src="assets\img\profile\profile default.jpg" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2">
                                <a href="editprofileforcustomer.php" class="btn text-capitalize rounded-pill py-2 px-3"><i class="fa-solid fa-pen-to-square"></i> Edit profile</a>
                            </div>
                            <div class=" madakalak ms-3">
                                <h5>&nbsp;<?= $curew["name"] ?></h5>
                            </div>
                        </div>
                        <div class="p-4 text-black">
                            <div class="d-flex justify-content-end text-center py-1">


                            </div>
                        </div>
                        <div class="card-body p-4 ">
                            <div class="mb-5">
                                <p class="lead fw-normal mb-1">About</p>
                                <div class="p-4">
                                    <p class="font-italic mb-1">location &nbsp; <?= $curew["address"] ?> </p>
                                    <p class="font-italic mb-1">about customer &nbsp; <?= $curew["name"] ?> </p>
                                    <p class="font-italic mb-0">about his products</p>
                                </div>
                            </div>
                            <?php 
                                if(isset($products)):
                                    foreach ($products as $product) : ?>
                                        <div class="row">
                                            <div class="col">
                                                <input type="hidden" name="id" class="box" value="<?= $product["id"]; ?>" id="id"><br>
                                                <a href="admincrud/admin_update.php?edit=<?php echo $product["id"]; ?>" class="btn">
                                                    <i class="fas fa-edit"></i><?= $product["name"]; ?> </a>
                                            </div>
                                            <div class="col">
                                                <img class="mt-4 rounded" style="width: 100px; hight: 100px;" src="admincrud/uploaded_img/<?= $product['image']; ?>" height="60"><br>
                                            </div>
                                        </div>
                                    <?php 
                                endforeach; 
                            endif; ?>
                                
                        <div class="row my-3 g-2">
                            <p class="mb-0 me-3"><a href="admincrud/admin_page.php" class="btn text-capitalize rounded-pill py-2 px-3"><i class="fa-solid fa-plus"></i> Add Products</a></p>
                            <div class="col mb-2 wow animate__animated animate__backInRight" data-wow-duration="2s">

                            </div>
                            <div class="container">

                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include('include/footer.php');
    ?>

    <?php
    include('include/script.php');
    ?>
</body>

</html>