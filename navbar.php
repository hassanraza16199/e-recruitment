<?php
include "connection.php";

$candidate_id = $_SESSION['id'];
$limit = isset($_GET['limit']) ? $_GET['limit'] : 5;
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

// Fetch notifications with limit and offset
$sql = "SELECT * FROM notification 
        WHERE created_at >= NOW() - INTERVAL 20 DAY 
        AND (notification_title = 'Job' OR (notification_title = 'Status' AND candidate_id = $candidate_id)) 
        ORDER BY created_at DESC 
        LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Count total notifications
$count_sql = "SELECT COUNT(*) as total 
              FROM notification 
              WHERE created_at >= NOW() - INTERVAL 20 DAY 
              AND (notification_title = 'Job' OR (notification_title = 'Status' AND candidate_id = $candidate_id))";
$count_result = $conn->query($count_sql);
$count_row = $count_result->fetch_assoc();
$total_notifications = $count_row['total'];

$unread_sql = "SELECT * FROM notification 
        WHERE created_at >= NOW() - INTERVAL 20 DAY 
        AND (notification_title = 'Job' OR (notification_title = 'Status' AND candidate_id = $candidate_id)) 
        AND read_as = 0 
        ORDER BY created_at DESC 
        LIMIT $limit OFFSET $offset";
$unread_result = $conn->query($unread_sql);

// Fetch read notifications
$read_sql = "SELECT * FROM notification 
        WHERE created_at >= NOW() - INTERVAL 20 DAY 
        AND (notification_title = 'Job' OR (notification_title = 'Status' AND candidate_id = $candidate_id)) 
        AND read_as = 1 
        ORDER BY created_at DESC 
        LIMIT $limit OFFSET $offset";
$read_result = $conn->query($read_sql);

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
            <link rel="stylesheet" href="assets/css2/nav.css">
            
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
                                <a href="dashboard.php"><img src="assets/img/logo/logo.png" class="logohead" alt=""></a>
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
                                                    <li><a href="hiring_manager.php">Hiring Manager</a></li>
                                                    <li><a href="interviewer.php">Interviewer</a></li>
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
                                    if($_SESSION['user_type'] === 'Candidate'){ 
                                ?>

<div class="notifications">
    <div class="notification-dropdown ml-5">
        <button class="drop-icon"><i class="fa-solid fa-bell fa-xl bell-icon"></i></button>
        <p class="notification-count"><?php echo $total_notifications; ?></p>
        <div class="dropdown-content">
            <!-- Unread Messages -->
            <div class="main-div">
                <div class="header">Notifications</div>
                <button class="header-del">Mark All as Read</button>
            </div>
            <div class="unread">
                <h4>Unread Messages</h4>
                <?php
                if ($unread_result === false) {
                    // Output the error message
                    echo "Error: " . $conn->error;
                } else {
                    if ($unread_result->num_rows > 0) {
                        while ($row = $unread_result->fetch_assoc()) {
                ?>
                <div class="message unread_message">
                    <i class="fa-solid fa-envelope mr-3 fa-xl"></i>
                    <a><?php echo $row['message']; ?></a>
                    <?php
                    if($row['notification_title'] === 'Job'){ ?>
                        <span class="action-icon ml-3"><a href="job_details.php?job_id=<?php echo $row['job_or_status_id']; ?>&recruiter_id= <?php echo $row['recruiter_id']; ?>"> 
                        <i class="fa-solid fa-up-right-from-square fa-lg"></i></a></span>
                    <?php } ?>
                </div>
                <?php
                        }
                    }
                }
                ?>
                <div id="show-more-unread" class="show-more mt-3">Show all unread messages</div>
            </div>

            <!-- Read Messages -->
            <div class="read">
                <h4>Read Messages</h4>
                <?php
                if ($read_result === false) {
                    // Output the error message
                    echo "Error: " . $conn->error;
                } else {
                    if ($read_result->num_rows > 0) {
                        while ($row = $read_result->fetch_assoc()) {
                ?>
                <div class="message read_message">
                    <i class="fa-solid fa-envelope mr-3 fa-xl"></i>
                    <a><?php echo $row['message']; ?></a>
                    <?php
                    if($row['notification_title'] === 'Job'){ ?>
                        <span class="action-icon ml-3"><a href="job_details.php?job_id=<?php echo $row['job_or_status_id']; ?>&recruiter_id= <?php echo $row['recruiter_id']; ?>"> 
                        <i class="fa-solid fa-up-right-from-square fa-lg"></i></a></span>
                    <?php } ?>
                </div>
                <?php
                        }
                    }
                }
                ?>
                <div id="show-more-read" class="show-more mt-3">Show all read messages</div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    const headerDelButton = document.querySelector('.header-del');
    const showMoreUnreadButton = document.querySelector('#show-more-unread');
    const showMoreReadButton = document.querySelector('#show-more-read');

    if (headerDelButton) {
        headerDelButton.addEventListener('click', function() {
            // Send AJAX request to mark all notifications as read
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'mark_all_read.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Move unread messages to read messages section
                    var unreadMessages = document.querySelector('.unread').getElementsByClassName('message');
                    var readSection = document.querySelector('.read');

                    // Loop through all unread messages and move them to the read section
                    while (unreadMessages.length > 0) {
                        readSection.appendChild(unreadMessages[0]);
                    }

                    // Update notification count to zero
                    document.querySelector('.notification-count').textContent = 0;
                }
            };
            xhr.send();
        });
    }

    if (showMoreUnreadButton) {
        showMoreUnreadButton.addEventListener('click', function() {
            // Send AJAX request to fetch all unread notifications
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_unread_notifications.php?limit=5&offset=0', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var notifications = JSON.parse(xhr.responseText);
                    var unreadDiv = document.querySelector('.unread');
                    unreadDiv.innerHTML = ''; // Clear existing unread notifications

                    // Loop through the notifications and display them
                    notifications.forEach(function(notification) {
                        var messageDiv = document.createElement('div');
                        messageDiv.className = 'unread_message';
                        messageDiv.innerHTML = '<i class="fa-solid fa-envelope mr-3 fa-xl"></i>' + 
                                               '<a>' + notification.message + '</a>';
                        if (notification.notification_title === 'Job') {
                            messageDiv.innerHTML += '<span class="action-icon ml-3">' + 
                                                    '<a href="job_details.php?job_id=' + notification.job_or_status_id + 
                                                    '&recruiter_id=' + notification.recruiter_id + '">' + 
                                                    '<i class="fa-solid fa-up-right-from-square fa-lg"></i></a></span>';
                        }
                        unreadDiv.appendChild(messageDiv);
                    });
                }
            };
            xhr.send();
        });
    }

    if (showMoreReadButton) {
        showMoreReadButton.addEventListener('click', function() {
            // Send AJAX request to fetch all read notifications
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_read_notifications.php?limit=5&offset=0', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var notifications = JSON.parse(xhr.responseText);
                    var readDiv = document.querySelector('.read');
                    readDiv.innerHTML = ''; // Clear existing read notifications

                    // Loop through the notifications and display them
                    notifications.forEach(function(notification) {
                        var messageDiv = document.createElement('div');
                        messageDiv.className = 'read_message';
                        messageDiv.innerHTML = '<i class="fa-solid fa-envelope mr-3 fa-xl"></i>' + 
                                               '<a>' + notification.message + '</a>';
                        if (notification.notification_title === 'Job') {
                            messageDiv.innerHTML += '<span class="action-icon ml-3">' + 
                                                    '<a href="job_details.php?job_id=' + notification.job_or_status_id + 
                                                    '&recruiter_id=' + notification.recruiter_id + '">' + 
                                                    '<i class="fa-solid fa-up-right-from-square fa-lg"></i></a></span>';
                        }
                        readDiv.appendChild(messageDiv);
                    });
                }
            };
            xhr.send();
        });
    }
});


</script>
        
    </body>
</html>