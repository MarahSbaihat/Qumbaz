<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
$_SESSION['HTTP_REFERER'] = basename($_SERVER['PHP_SELF']);
// echo $_SESSION['HTTP_REFERER'];
?>
<footer class="footer" id="contact">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-3 px-2">
                <h5 class="h5 text-capitalize">about us</h5>
                <p class="p">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus exercitationem delectus hic nam repellat alias veritatis eaque doloribus laborum at distinctio, accusamus aspernatur eos laudantium iusto, quibusdam optio fugit. Delectus ad nisi, id dicta quo corrupti officiis at maiores et?</p>
            </div>
            <div class="col-md-3 px-2">
                <h5 class="h5 text-capitalize">contact details</h5>
                <ul class="p">
                    <li>
                        <i class="pink fa-solid fa-location-dot"></i>
                        <span>FREE PALESTINE</span>
                    </li>
                    <li>
                        <i class="pink fa-solid fa-phone"></i>
                        <span><a class="links" href="tel:+1234567890">+1234567890</a></span>
                    </li>
                    <li>
                        <i class="pink fa-solid fa-message"></i>
                        <span><a class="links" href="mailto:qumbaz@gmail.com">qumbaz@gmail.com</a></span>
                    </li>
                    <li class="no-border">
                        <i class="pink fa-solid fa-earth-asia"></i>
                        <span><a class="links" href="http://www.Qumbaz.com">http://www.Qumbaz.com</a></span>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 px-5">
                <h5 class="h5 text-capitalize">contact</h5>

                    <!-- alerts -->
                    <?php require('./include/alerts.php') ?>

                <form class="p" method="POST" action="./handler/send-message.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div>
                        <label for="exampleInputmessage" class="form-label">Your Message</label>
                        <textarea name="message" class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    </div>
                    <button type="submit" class="btn rounded-pill py-2 px-3 mt-3 text-capitalize">send</button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer2 py-1">
        <div class="container d-flex align-items-center justify-content-between">
            <div>
                <p class="p">Copyright &#169; All rights reserved.</p>
            </div>
            <div>
                <a href="map.php" class="p1">site map</a>
            </div>
            <div>
                <ul class="p d-flex ms-auto">
                    <li><i class="fa-brands fa-facebook-f fb rounded-pill px-3 py-2 mx-2"></i></li>
                    <li><i class="fa-brands fa-instagram ig rounded-pill px-3 py-2 mx-2"></i></li>
                    <li><i class="fa-brands fa-linkedin-in lin rounded-pill px-3 py-2 mx-2"></i></li>
                    <li><i class="fa-brands fa-twitter tt rounded-pill px-3 py-2 mx-2"></i></li>
                </ul>
            </div>
        </div>
    </div>
</footer>