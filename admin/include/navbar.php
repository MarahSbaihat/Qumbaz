<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    require('include/connection.php');

    if(!isset($_SESSION['admin'])){
        header('location: login.php');
    }

    $sql = "SELECT * FROM `logos`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $logo = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary py-3">
    <div class="container-fluid">
        <a class="navbar-brand pe-5" href="index.php">
            <img src="handlers/upload/logo/<?= $logo[0]['image'] ?>" alt="logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="index.php">cards</a>
                </li>
                <?php // if ($_SESSION['admin']['role'] == 'super_admin') : ?>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="admins.php">Admins</a>
                    </li>
                <?php // endif; ?>
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="central.php">central</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="home.php">home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="details.php">details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="products.php">products</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="index.php"><?=$_SESSION['admin']['name']?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-capitalize" href="./handlers/logout.php">sign out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>