<?php
include('connection.php');

if (isset($_POST['product_id']) && isset($_POST['customer_id'])) {

    $product_id = $_POST['product_id'];
    $customer_id = $_POST['customer_id'];

    // التحقق من توفر المنتج في قاعدة البيانات
    $sql = "SELECT quantity FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $quantity = $row['quantity'];

        if ($quantity > 0) {
            // يوجد كمية متاحة للمنتج

            // قم بتحديث كمية المنتج في قاعدة البيانات
            $newQuantity = $quantity - 1;
            $updateSql = "UPDATE products SET quantity = $newQuantity WHERE id = $product_id";
            mysqli_query($conn, $updateSql);

            // قم بإعداد البيانات اللازمة لنموذج الطلب
            $orderData = [
                'customer_id' => $customer_id,
                'product_id' => $product_id
            ];
?>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // أرسل البيانات المحدثة إلى صفحة form-order.php
                    fetch('../form-order.php', {
                        method: 'POST',
                        body: JSON.stringify(<?= json_encode($orderData) ?>),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.text())
                    .then(data => {
                        // إظهار البيانات المسترجعة من صفحة form-order.php
                        console.log(data);
                        // إرسال النموذج تلقائيًا
                        document.getElementById("auto-submit-form").submit();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            </script>

            <form id="auto-submit-form" action="../form-order.php" method="post">
                <input type="hidden" name="customer_id" value="<?= $customer_id ?>">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                <button style="display: none;"></button>
            </form>

<?php
        } else {
            // لا يوجد منتج
            $_SESSION['errors'] = ['sold out'];
            header("location: ../productsdetails.php?id=$product_id");
            exit();
        }
    } else {
        echo "there is no product";
    }
}
?>
