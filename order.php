<?php
include('include/head.php');
include('include/connection.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // استعلام SQL لاسترداد جميع الطلبيات مع معلومات السعر
    $sql = "SELECT orders.id, orders.total_price, orders.ordered_at, products.price
            FROM orders
            JOIN products ON orders.product_id = products.id
            WHERE orders.customer_id = $id";
    $query = mysqli_query($conn, $sql);

    // التحقق من وجود نتائج استعلام SQL
    if (mysqli_num_rows($query) > 0) {
        $orders = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
}
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
                <h3 class="h3 text-capitalize">order</h3>
            </div>
            <table class="table table-striped text-center wow animate__animated animate__backInUp" data-wow-duration="2s">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">total_price</th>
                        <th scope="col">details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // التحقق من وجود طلبيات
                    if (isset($orders)):
                        $count = 1;
                        foreach ($orders as $order) :
                    ?>
                            <tr>
                                <th scope="row"><?= $count ?></th>
                                <?php
                                 $sql = "SELECT 
                                 products.*, orders.id AS order_id, orders.total_price, producers.name AS producer_name
                                 FROM `products` 
                                 JOIN orders ON products.id = orders.product_id 
                                 JOIN producers ON products.producer_id = producers.id
                                 WHERE orders.id = $order[id]";
                         
                             $query = mysqli_query($conn, $sql);
                             if (mysqli_num_rows($query) > 0) {
                                 $products = mysqli_fetch_all($query, MYSQLI_ASSOC);
                                 $totalPrice = 0; // Variable to calculate the total price
                                 $order_id = $products[0]['order_id']; // Get the order ID from the first product
                                 foreach ($products as $product) {
                                     $totalPrice += $product['price']; // Increase the total price by the price of each product
                                 }?>
                                <td><?= $totalPrice ?></td>
                                <?php
                             }
                                ?>
                                <td><?= $order['ordered_at'] ?></td>
                                
                                <td>
                                    <a href="orderdetails.php?id=<?= $order['id'] ?>">know more</a>
                                </td>
                                <td>
                                    <form action="include/delete-order.php" method="POST">
                                        <button class="rounded-pill bg-danger text-light py-1 px-2">
                                            <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                            <input type="hidden" name="customer_id" value="<?= $id ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                            $count++;
                        endforeach;
                    endif;
                    ?>
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
