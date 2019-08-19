<!--
 All the scripts goes here
 Please do not write any custom scripts here
 -->


<!-- Footer -->
<footer class="page-footer font-small unique-color-dark">

    <div class="footer-social">
        <div class="container">

            <!-- Grid row-->
            <div class="row py-4 d-flex align-items-center">

                <!-- Grid column -->
                <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
                    <!-- <h6 class="mb-0">Get connected with us on social networks!</h6> -->
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6 col-lg-7 text-center text-md-right">

                    <!-- Facebook -->
                    <a class="fb-ic">
                        <i class="fab fa-facebook-f white-text mr-4"> </i>
                    </a>
                    <!-- Twitter -->
                    <a class="tw-ic">
                        <i class="fab fa-twitter white-text mr-4"> </i>
                    </a>
                    <!-- Google +-->
                    <a class="gplus-ic">
                        <i class="fab fa-google-plus-g white-text mr-4"> </i>
                    </a>
                    <!--Linkedin -->
                    <a class="li-ic">
                        <i class="fab fa-linkedin-in white-text mr-4"> </i>
                    </a>
                    <!--Instagram-->
                    <a class="ins-ic">
                        <i class="fab fa-instagram white-text"> </i>
                    </a>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row-->

        </div>
    </div>

    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5">

        <!-- Grid row -->
        <div class="row mt-3">

            <!-- Grid column -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">

                <!-- Content -->
                <h6 class="text-uppercase font-weight-bold">Project made by:</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <ul style="list-style: none">
                    <li>Petar Todorov</li>
                    <li>Michał Pawlicki</li>
                    <li>Martin Grenchev</li>
                    <li>Berenike Hegedus</li>
                </ul>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold">Account</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <div id="actions">
                    <?php
                    if (!isset($_SESSION['User'])) {
                        ?>
                        <div id="guestActions">
                            <ul>
                                <li><a href="sign-up">Sign up</a></li>
                                <li><a href="index.php">Log in</a></li>    
                            </ul>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div id="userActions">
                            <ul>
                                <li><a href="logout">Log out</a></li>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold"><?= $appName ?></h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <ul>
                    <li><a href="#!">Back to Home</a></li>
                    <?php if (isset($_SESSION['User'])) { ?>
                        <li><a href="create-topic">Create new post</a></li>
                    <?php } ?>
                    <li><a href="category?cat=3">Category: Home</a></li>
                    <li><a href="category?cat=4">Category: Office</a></li>
                    <li><a href="category?cat=5 ">Category: Travel</a></li>
                </ul>
            </div>
            <!-- Grid column -->


        </div>
        <!-- Grid row -->

    </div>
    <!-- Footer Links -->

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        © 2019 Copyright
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.js"
        integrity="sha256-pl1bSrtlqtN/MCyW8XUTYuJCKohp9/iJESVW1344SBM=" crossorigin="anonymous"></script>
<!-- Include jQuery lib. -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/simplemde@1.11.2/dist/simplemde.min.js"
        integrity="sha256-6sZs7OGP0Uzcl7UDsLaNsy1K0KTZx1+6yEVrRJMn2IM=" crossorigin="anonymous"></script>
<script src="static/js/main.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
if (file_exists("static/js/$pageJs.js")) {
    echo '<script src="static/js/' . $pageJs . '.js"></script>';
}
?>


</body>
</html>
