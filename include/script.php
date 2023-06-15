<!-- j query -->
<script src="assets/js/jquery-3.6.1.js"></script>
<!-- owl carousel -->
<script src="assets/js/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel();
    });
</script>
<!-- animate js -->
<script src="assets/js/animate-wow-js.min.js"></script>
<script>
    new WOW().init();
</script>
<!-- bootstrap js -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!-- custom js -->
<script src="assets/js/main.js"></script>


<!-- <script>
function deleteRow(button) {
  var row = button.parentNode.parentNode;
  row.parentNode.removeChild(row);
  <?php
// تأسيس الاتصال بقاعدة البيانات
// $servername = "localhost";
// $username = "username";
// $password = "password";
// $dbname = "database_name";

// $conn = mysqli_connect($servername, $username, $password, $dbname);

// التحقق من اتصال القاعدة بشكل صحيح
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }

// get id from url parameter
// $id = $_GET['id'];

// delete row from table
// $sql = "DELETE FROM products WHERE id = $id";
// if (mysqli_query($conn, $sql)) {
//     echo "Record deleted successfully";
// } else {
//     echo "Error deleting record: " . mysqli_error($conn);
// }

?>}
</script> -->
<script>
// function deleteRow(button) {
//   var row = button.parentNode.parentNode;
//   var id = row.dataset.id;
//   var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function() {
//     if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
//       if (this.responseText === 'success') {
//         row.parentNode.removeChild(row);
//       } else {
//         alert('Error deleting row.');
//       }
//     }
//   };
//   xhr.open('POST', 'delete.php');
//   xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
//   xhr.send('id=' + id);
// }
</script>