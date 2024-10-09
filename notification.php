<?php
session_start();
include "connection.php";

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch notifications
$sql = "SELECT * FROM job_post WHERE created_at >= NOW() - INTERVAL 1 DAY"; // Limit to 5 results
$result = $conn->query($sql);

// Count total notifications
$count_sql = "SELECT COUNT(*) as total FROM job_post WHERE created_at >= NOW() - INTERVAL 1 DAY";
$count_result = $conn->query($count_sql);
$count_row = $count_result->fetch_assoc();
$total_notifications = $count_row['total'];

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
            <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            
            <style>
                .bell-icon {
                position: relative; /* Make the bell icon a positioning context */
                color: #fb246a;
            }

            .notification-count {
                position: absolute;
                top: 35px; /* Adjust as needed to position it properly on top */
                right: 305px; /* Move the notification bubble slightly to the right */
                color: #28395a;
                border-radius: 50%;
                padding: 2px 6px;
                font-size: 13px;
                font-weight: bold;
                line-height: 1;
                min-width: 15px;
                text-align: center;
                background-color: #ffffff; /* Background for visibility */
            }

            .drop-icon {
                background-color: #fff;
                border: none;
                width: 30px;
                margin-top: -10px;
            }
            
    /* Add some basic styling to make the form look better */
    .form-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    <header>
        <!-- Header Start -->
       <div class="header-area header-transparrent" style="background-color:">
           <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-2">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="index.php"><img src="assets/img/logo/pic.png" class="logohead" alt=""></a>
                            </div>  
                        </div>
                        <div class="col-lg-9 col-md-9">
                            <div class="menu-wrapper">
                                <!-- Main-menu -->
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <?php
                                                if($_SESSION['user_type'] === 'Candidate'){
                                            ?>
                                            <li><a href="dashboard.php">Home</a></li>
                                            <li><a href="job_listing.php">Jobs </a></li>
                                            <li><a href="about_us.php">About</a></li>
                                            <li><a href="#">Calender Integration</a></li>

                                            <?php
                                                }elseif($_SESSION['user_type'] === 'Recruiter'){
                                            ?>
                                            <li><a href="dashboard.php">Home</a></li>
                                            <li><a href="posted_jobs.php">Jobs </a></li>
                                            <li><a href="resumes.php">Resumes</a></li>
                                            <li><a href="#">Pages</a>
                                            
                                                <ul class="submenu">
                                                    <li><a href="applications.php">Applications</a></li>
                                                    <li><a href="users_feedback.php">Feedbacks</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="users_contact.php">Contacts</a></li>

                                            <?php
                                                }else{
                                            ?>
                                            <li><a href="users.php">User</a></li>
                                            <li><a href="posted_jobs.php">Posted Jobs </a></li>
                                            <li><a href="#">Pages</a>
                                                <ul class="submenu">
                                                    <li><a href="applications.php">Applications</a></li>
                                                    <li><a href="about_us.php">Interview scheduler</a></li>
                                                    <li><a href="#">/</a></li>
                                                </ul>
                                            </li>
                                            
                                            <li><a href="users_feedback.php">Feedbacks</a></li>
                                            <li><a href="users_contact.php">Users Contacts</a></li>
                                            <?php
                                                }
                                            ?>
                                        </ul>
                                    </nav>
                                </div>  
                                <div class="drop-icon">
                                    <i class="fa-solid fa-bell fa-xl bell-icon" ></i>
                                    <p class="notification-count"><?php echo $total_notifications; ?></p>
                                </div>
                                
                                 
                                <div class="header-btn d-none f-right d-lg-block">
                                
                                <div class="dropdown">
                                    <button class="btn head-btn2 btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-regular fa-user fa-xl mr-2"></i> <?php echo $_SESSION['name']?>
                                    </button>
                                    <?php
                                    if($_SESSION['user_type'] === 'Candidate'){
                                        ?>
                                    <div class="dropdown-menu" style="width: 100%" aria-labelledby="dropdownMenu2">
                                        <a href='profile.php' class="dropdown-item" type="button">Profile</a>
                                        <a class="dropdown-item" href="logout.php" type="button">Logout</a>
                                    </div>
                                    <?php
                                    }elseif($_SESSION['user_type'] === 'Recruiter'){
                                    ?>
                                    <div class="dropdown-menu" style="width: 100%" aria-labelledby="dropdownMenu2">
                                        <a href='profile.php' class="dropdown-item" type="button">Profile</a>
                                        <a class="dropdown-item" href="logout.php" type="button">Logout</a>
                                    </div>
                                    <?php
                                    }else{
                                    ?>
                                    <div class="dropdown-menu" style="width: 100%" aria-labelledby="dropdownMenu2">
                                        <a href='profile.php' class="dropdown-item" type="button">Profile</a>
                                        <a class="dropdown-item" href="logout.php" type="button">Logout</a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
           </div>
       </div>
        <!-- Header End -->
    </header>


    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Notification</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            
            <div class="ml-5 mr-5">
                <h2>Notification</h2>
        <?php


// Check if the query was successful
if ($result === false) {
    // Output the error message
    echo "Error: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Display job notifications
            ?>
            <div class="single-job-items mb-30">
                <div class="job-items">
                    <div class="job-tittle">
                            <a href="job_details.php?job_id=<?php echo $row['job_id']; ?>&recruiter_id= <?php echo $row['recruiter_id']; ?>"><h6><?php echo htmlspecialchars($row['job_title']); ?></h6></a> 
                        
                        <ul>
                            <li><?php echo htmlspecialchars($row['company_name']); ?></li>
                            <li><i class="fas fa-map-marker-alt"></i><?php echo htmlspecialchars($row['company_location']); ?></li>
                            <li><?php echo htmlspecialchars($row['salary']); ?></li>
                        </ul>
                    </div>
                </div>
                <div class="items-link f-right">
                    <span><?php echo htmlspecialchars($row['date']); ?></span>
                </div>
            </div>
            <?php
        }
    }
}

                        ?>
        </div>
        </div>
        
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