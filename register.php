<!DOCTYPE html>
<html>

    <?php
    include('include/head.php');
    ?>

    <body>

        <div class="btnTop">
            <i class="fa-solid fa-angle-up"></i>
        </div>

        <?php
        include('include/navbar.php');
        ?>

        <div class="register py-5">
            <div class="row m-auto d-flex align-items-center container pt-5 text-center">
                <div class="col-md-5 wow animate__animated animate__backInLeft" data-wow-duration="2s">
                    <img class="avatar pb-3" src="assets/img/login/heritage.jpg" alt="">
                </div>
                <div class="col-md-6 offset-1 text-start wow animate__animated animate__backInRight" data-wow-duration="2s">
                        
                    <!-- alerts -->
                    <?php require('./include/alerts.php') ?>

                    <form action="handler/create-account.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleInputname" class="form-label text-capitalize">user name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputname" aria-describedby="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label text-capitalize">email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label text-capitalize">password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputname" class="form-label text-capitalize">image</label>
                            <input type="file" name="image" class="form-control" id="exampleInputname" aria-describedby="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputname" class="form-label text-capitalize">bio</label>
                            <input type="text" name="bio" class="form-control" id="exampleInputname" aria-describedby="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputname" class="form-label text-capitalize">address</label>
                            <input type="text" name="address" class="form-control" id="exampleInputname" aria-describedby="name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputname" class="form-label text-capitalize">phone number</label>
                            <input type="text" name="phone" class="form-control" id="exampleInputname" aria-describedby="name">
                        </div>
                        <!-- <div class="mb-3">
                            <label for="exampleInputname" class="form-label text-capitalize">pay account</label>
                            <select name="pay_account" class="form-select" aria-label="Default select example">
                                <option value=""></option>
                                <option value="PayPal">PayPal</option>
                                <option value="PalPay">PalPay</option>
                                <option value="JawwalPay">JawwalPay</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputname" class="form-label text-capitalize">pay number</label>
                            <input type="text" name="pay_number" class="form-control" id="exampleInputname" aria-describedby="name">
                        </div> -->
                        <div class="mb-3">
                            <label for="exampleInputname" class="form-label text-capitalize">Type of account</label>
                            <select name="type" class="form-select" aria-label="Default select example">
                                <option value="customers" selected>customer (You can buy products)</option>
                                <option value="producers">producer (You can display and sell your products)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn text-capitalize rounded-pill mt-2 py-2 px-3">sign up</button>
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