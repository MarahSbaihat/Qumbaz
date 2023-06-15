<?php
    session_start();
        
    require('../include/connection.php');
    require('method/index.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        extract($_POST);

        $search = handleStringInput($search);

        $sql = "SELECT * FROM `producers` WHERE `name` = '$search'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $prod = $row['id'];
            header("Location: ../login.php?id=$prod");
        }
    }

?>