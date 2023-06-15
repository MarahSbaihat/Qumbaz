<?php
include('connection.php');

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM favourites WHERE customer_id='$id'";

  if (mysqli_query($conn, $sql)) {
    // echo "All rows deleted successfully";
  } else {
    echo "Error deleting rows: " . mysqli_error($conn);
  }
  header("location: ../favourite.php?id=$id");
    exit();
}else{
    header("location: ../favourite.php?id=$id");
    exit();

}

?>