<?php

session_start();
include "connection.php";

?>



<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
         <title>E-Recruitment system</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/fav.png">
		<!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/price_rangs.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
            
   </head>

   <body>
   <!-- Preloader Start -->
   <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <?php include "navbar.php"; ?>


    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Resumes</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            <div class="form-container ml-5 mr-5">
                <h3>Users Resumes</h3>
                <div class="row">
                <div class="mt-3 ml-3 mr-3 mb-3" style="border-radius:5px;">
                    <div class="card" style="width: 17rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <span><p>Name : </p> <span class="ml-5 mr-5"><i class="fa-solid fa-paperclip fa-lg"></i></span> <span class="ml-5 mr-5"><i class="fa-solid fa-download fa-lg"></i></span></span>
                        </div>
                    </div>
                </div>

                <div class="mt-3 ml-3 mr-3 mb-3" style="border-radius:5px;">
                    <div class="card" style="width: 17rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <span><p>Name : </p> <span class="ml-5 mr-5"><i class="fa-solid fa-paperclip fa-lg"></i></span> <span class="ml-5 mr-5"><i class="fa-solid fa-download fa-lg"></i></span></span>
                        </div>
                    </div>
                </div>

                <div class="mt-3 ml-3 mr-3 mb-3" style="border-radius:5px;">
                    <div class="card" style="width: 17rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <span><p>Name : </p> <span class="ml-5 mr-5"><i class="fa-solid fa-paperclip fa-lg"></i></span> <span class="ml-5 mr-5"><i class="fa-solid fa-download fa-lg"></i></span></span>
                        </div>
                    </div>
                </div>

                <div class="mt-3 ml-3 mr-3 mb-3" style="border-radius:5px;">
                    <div class="card" style="width: 17rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <span><p>Name : </p> <span class="ml-5 mr-5"><i class="fa-solid fa-paperclip fa-lg"></i></span> <span class="ml-5 mr-5"><i class="fa-solid fa-download fa-lg"></i></span></span>
                        </div>
                    </div>
                </div>

                
            </div>
            </div>
        </div>
        <!-- Job List Area End -->
    </main>


    <?php include "footer.php"; ?>
    
	<!-- JS here -->
        <script src="https://kit.fontawesome.com/3acead0521.js" crossorigin="anonymous"></script>
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Range -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
        <script src="./assets/js/price_rangs.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
        
    </body>
</html>