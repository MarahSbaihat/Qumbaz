<?php
include('include/head.php');
require('include/connection.php');

$sql = "SELECT * FROM categories";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    $categories = mysqli_fetch_all($query, MYSQLI_ASSOC);?>
    <div class="offcanvas-body">
    <p>These Palestinian heritage products were produced by a group of Palestinian handicrafts owners</p>
  <?php  foreach ($categories as $category) {
          $categoryID = $category['id'];

        $sql = "SELECT * FROM classifications WHERE categories_id = '$categoryID'";
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            $classifications = mysqli_fetch_all($query, MYSQLI_ASSOC);?>

            
           <ul class="list ps-2">
            <li><a href="#" class="categories"><?=$category['category'] ?></a>
           <ul class="ps-5">
<?php
            foreach ($classifications as $classification) {
                $classificationID = $classification['id'];
                echo '<li><a href="home.php?id=' . $classificationID . '">' . $classification['category'] . '</a></li>';
            }
?>
            </ul>
            </li>
            </ul>
            <?php
            } else {
                // Print the category that does not have any child classifications
                echo '<ul class="list ps-2"><li><a href="#" class="categories">' . $category['category'] . '</a></li></ul>';
            }
        }
        ?>
    </div>
<?php
}
?>
