<!DOCTYPE html>
<html>

<?php
include('include/head.php');
include('include/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
}
$sql = "SELECT * FROM products ";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
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

    <div class="register py-5">
        <div class="row d-flex align-items-center container pt-5 text-center">
            <div class="col-md-5 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                <img class="avatar pb-3" src="assets/img/login/heritage.jpg" alt="">
            </div>
            <div class="col-md-6 offset-1 text-start wow animate__animated animate__backInRight" data-wow-duration="2s">



                <form action="formaddproduct.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label text-capitalize">name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputname" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label text-capitalize">image</label>
                        <input type="file" name="image" class="form-control" id="exampleInputname" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label text-capitalize">details</label>
                        <input type="text" name="details" class="form-control" id="exampleInputname" aria-describedby="name" placeholder="size ,color somthing like this">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label text-capitalize">price</label>
                        <input type="number" name="price" class="form-control" id="exampleInputname" aria-describedby="name" placeholder="nis">
                    </div>

                    <div class="mb-3">
                        <label for="category">Select a category:</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">Select Category</option>
                            <?php
                            $sql = "SELECT classifications.id, classifications.category, classifications.categories_id, categories.category AS categories
                FROM classifications
                JOIN categories ON classifications.categories_id = categories.id";
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                $classifications = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                foreach ($classifications as $classification) {
                                    if (empty($classification['categories'])) {
                                        // Top-level classification
                                        echo '<option value="' . $classification['categories_id'] . '">' . $classification['category'] . '</option>';
                                    } else {
                                        // Sub-classification
                                        echo '<option value="' . $classification['id'] . '">&nbsp;&nbsp;' . $classification['categories'] . ' - ' . $classification['category'] . '</option>';
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputname" class="form-label text-capitalize">quantity</label>
                        <input type="text" name="quantity" class="form-control" id="exampleInputname" aria-describedby="name">
                    </div>
                    <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">add product</button>
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