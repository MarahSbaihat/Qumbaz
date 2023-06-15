<!DOCTYPE html>
<html lang="en">
<?php
include('include/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $image = $_FILES['image']['name'];
    $details = $_POST['details'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];

    // Upload image file
    $targetDir = 'path/to/upload/directory/';
    $targetFile = $targetDir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

    // Insert product data into the database
    $sql = "INSERT INTO products (name, image, details, price, quantity) VALUES ('$name', '$image', '$details', '$price', '$quantity')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        // Product insertion successful
        echo "Product added successfully.";
    } else {
        // Product insertion failed
        echo "Failed to add product.";
    }
}
?>
    <?php
    include('include/head.php');

    $sql = "SELECT products.id, 
    products.name, 
    products.details, 
    products.price, 
    classifications.categories_id,
    classifications.category,
    products.image FROM `products`
    JOIN 
    classifications 
    ON 
      products.id = classifications.id ";
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

    <div class="formaddproduct pt-5">
        <div class="container pt-5">

            <div class="py-3 container d-flex justify-content-between">
                <h2 class="h2 text-capitalize">Your Products</h2>
                <a class="btn text-capitalize rounded-pill py-2 px-3" href="addproducts.php">add product</a>
            </div>
            <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">details</th>
                        <th scope="col">price</th>
                        <th scope="col">image</th>
                        <th scope="col">classifications</th>
                        <th scope="col">category</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(isset($products)):
                        $count=1;
                        foreach ($products as $product) : ?>
                            <tr>
                                <th scope="row"><?=$count?></th>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['details'] ?></td>
                                <td><?= $product['price'] ?></td>
                                <td><img class="w-25 rounded" src="./assets/img/central/<?= $product['image'] ?>" alt="image of <?= $product['name'] ?>" /></td>
                                <td><?= $product['category'] ?></td>
                              <?php
                                
                                $sql = "SELECT * FROM categories WHERE id = " . $product['categories_id'];
                                $query = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($query) > 0) {
                                    $category = mysqli_fetch_assoc($query);
                                }
                                ?>
                                <td><?= $category['category'] ?></td>
                                <td class="d-flex">
                                <a href="update-product.php?id=<?=$product['id']?>"><i class="fa-solid fa-pen-to-square rounded-pill bg-info text-light py-1 px-2"></i></a>
                                <a href="delete-product.php?id=<?=$product['id']?>"><i class="fa-solid fa-trash rounded-pill bg-danger text-light py-1 px-2"></i></a>
                             </td>

                            </tr>
                            <?php 
                            $count++;
                        endforeach; 
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include('include/footer.php'); ?>
    <?php include('include/script.php'); ?>

</body>

</html>