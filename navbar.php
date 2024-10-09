<?php
include "connection.php";

// Fetch notifications
$sql = "SELECT * FROM job_post WHERE created_at >= NOW() - INTERVAL 1 DAY LIMIT 8"; // Limit to 5 results
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
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/price_rangs.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <style>
            .bell-icon {
                position: relative; /* Make the bell icon a positioning context */
                color: #fb246a;
            }

            .notification-count {
                position: absolute;
                top: 25px; /* Adjust as needed to position it properly on top */
                right: -9px; /* Move the notification bubble slightly to the right */
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
            }
            
            .job-link{
                width: 20px;
            }

            .notification-dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 500px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
        }
        .dropdown-content .unread, .dropdown-content .read {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .dropdown-content .unread {
            background-color: #ffefef;
        }
        .dropdown-content .message {
            display: flex;
            align-items: center;
            padding: 8px 0;
        }
        .dropdown-content .message img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
        .dropdown-content .message a {
            text-decoration: none;
            color: #333;
            flex-grow: 1;
        }
        .dropdown-content .message .action-icon {
            margin-left: auto;
        }
        .action-icon a i{
            color: blue;
        }
        .notification-dropdown:hover .dropdown-content {
            display: block;
        }
        .header {
            padding: 10px;
            background-color: #f1f1f1;
            font-weight: bold;
        }
        .mark-read {
            color: #007bff;
            cursor: pointer;
            font-size: 12px;
            text-align: right;
            margin-top: -10px;
        }
        .show-more {
            text-align: center;
            color: #007bff;
            cursor: pointer;
            font-size: 12px;
        }
            </style>
   </head>

   <body>
   
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
                                <?php
                                include "connection.php";
                                if($_SESSION['user_type'] === 'Candidate'){ ?>

<div class="ml-5">
<div class="notification-dropdown ml-5">
    <button class="drop-icon"><i class="fa-solid fa-bell fa-xl bell-icon" ></i></button>
    <p class="notification-count"><?php echo $total_notifications; ?></p>
    <div class="dropdown-content">
        <!-- Unread Messages -->
        <div class="header">Notifications</div>
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
        <div class="unread">
            <div class="message">
                <i class="fa-solid fa-envelope mr-3 fa-xl"></i>
                <a href="#">
                    <?php echo $row['recruiter_name']; ?> give oppertunity as new <a class="job-link" href="job_details.php?job_id=<?php echo $row['job_id']; ?>&recruiter_id= <?php echo $row['recruiter_id']; ?>"><?php echo $row['job_title']; ?></a> jobs.
                </a>
                <span class="action-icon ml-3"><a href="job_details.php?job_id=<?php echo $row['job_id']; ?>&recruiter_id= <?php echo $row['recruiter_id']; ?>"> <i class="fa-solid fa-up-right-from-square fa-lg"></i></a></span>
            </div>
            <?php
        }
    }
}
                        ?>
            <div class="show-more">Show all unread messages</div>
        </div>
        
    </div>
</div>
</div>
<?php }?>
                                 
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

    
    <script>
function fetchNotifications() {
    $.ajax({
        url: "notification.php", // PHP file to fetch notifications from
        method: "GET",
        success: function(data) {
            $(".job-notification").html(data); // Update the job notification area
        }
    });
}

// Call the function to fetch notifications when the page loads
$(document).ready(function() {
    fetchNotifications();
});
</script>

        
    </body>
</html>