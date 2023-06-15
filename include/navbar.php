<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require('include/connection.php');

    $sql = "SELECT * FROM `logos`";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $logo = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary py-3">
    <div class="container-fluid d-flex justify-content-between">
        <a class="navbar-brand" href="<?= isset($_SESSION['user']) ? 'home.php' : 'index.php'?>">
        <img src="admin/handlers/upload/logo/<?= $logo[0]['image'] ?>" alt="logo" class="logo w-25">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#about">about</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#product">product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#question">questions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="#contact">contact</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="home.php">home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="profileforproducer.php">profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="about.php">about</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Category</button>
                    </li>
                    <!-- <li class="nav-item">
                        <form class="d-flex" action="./handler/search.php" method="POST">
                            <input type="text" name="search" id="" class="form-control w-50">
                            <button type="submit" class="btn nav-link text-capitalize"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </li> -->
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="login.php">sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="register.php">sign up</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user'])) :?>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-capitalize" href="profileforproducer.php"><?php 
                        if ($_SESSION['logedin'] = 'register') {
                            echo $_SESSION['user'][0]['name'];
                        } elseif($_SESSION['logedin'] = 'login') {
                            echo $_SESSION['user']['name'];
                        }
                        ?></a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-capitalize" href="handler/logout.php">sign out</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>