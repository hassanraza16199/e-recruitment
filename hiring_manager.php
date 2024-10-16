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
        <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            .form-container {
                max-width: 800px;
                margin: 40px auto;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .main-div {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                margin: 0 auto;
                max-width: 1300px;
                padding: 20px;
            }

            .detail-div, .status-div {
                background: #f9f9f9;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 50%;
            }

            .detail-div h2, .status-div h2 {
                font-size: 24px;
                margin-bottom: 20px;
                color: #333;
            }

            .detail-div p, .status-div p {
                font-size: 16px;
                margin-bottom: 10px;
                color: #555;
            }

            .status-div form select {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                margin-bottom: 15px;
            }

            /* Modal Styling */
            .modal-content {
                background-color: #f9f9f9;
                border-radius: 10px;
                padding: 20px;
            }

            .modal-header {
                border-bottom: 1px solid #ddd;
                margin-bottom: 10px;
            }

            .modal-title {
                font-size: 20px;
                color: #333;
            }

            .modal-body {
                padding: 20px;
            }

            .modal-body .form-group label {
                color: #555;
                font-size: 14px;
                margin-bottom: 5px;
            }

            .email-btn{
                margin-left:190px;
            }

            /* Responsive Styling */
            @media (max-width: 768px) {
                .main-div {
                    flex-direction: column;
                }

                .detail-div, .status-div {
                    width: 100%;
                }

                .status-div button {
                    width: 100%;
                }
            }

            /* Make the form responsive */
            @media (max-width: 768px) {
                .form-container {
                    margin: 20px auto;
                }
                .inputfirst {
                    padding-left: 0;
                }
            }

            @media (max-width: 480px) {
                .form-container {
                    padding: 10px;
                }
                .form-group {
                    margin-bottom: 10px;
                }
                
            }
        </style>

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
                                    <h2>Hiring Manager</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Area End -->

            <!-- Job List Area Start -->
            <div class="job-listing-area pt-120 pb-120">
                <div class="main-div">
                    <div class="detail-div">
                        <h2>Hiring Managers</h2>
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Avalibility</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include "connection.php";
                                
                                    $sql = "SELECT * FROM hiring_managers  ";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result)>0) {
                                        while($row = mysqli_fetch_assoc($result)){
                                        ?>
                        
                            
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['designation']; ?></td>
                                    <td><?php echo $row['avalibility']; ?></td>
                                </tr>
                            
        
                        <?php 
                                }
                            }else{
                                echo " No hiring Manager Found";
                            }
                        ?>
                        </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="status-div">
                        <div style="display:flex; margin-bottom:20px;">
                            <h2>Calender</h2>
                            <span  class=" email-btn">
                                <button class="btn head-btn1" data-toggle="modal" data-target="#emailModal">Hiring Manager</button>
                            </span>
                        </div>
                        <p>This place fix the calender</p>
                    </div>
                </div>
            </div>
            <!-- Job List Area End -->
        </main>

        <!-- Email Modal -->
        <div id="emailModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog " role="document">
                <div class="modal-content" style='margin-top:120px;'>
                    <div class="modal-header">
                        <h5 class="modal-title">Hiring Manager</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="hiring_manager.php" method="POST">
                            <div class="form-group">
                                <label for="to_email">Name:</label>
                                <input type="email" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="designation">Designation:</label>
                                <input type="text" class="form-control" id="designation" name="designation">
                            </div>
                            <div class="form-group">
                                <label for="avalibility">Avalibility:</label>
                                <input type="text" class="form-control" id="avalibility" name="avalibility">
                            </div>
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Send Email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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