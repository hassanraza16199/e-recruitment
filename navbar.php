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

// Fetch unread notification count
$unread_count_sql = "SELECT COUNT(*) as unread_count FROM notification 
        WHERE created_at >= NOW() - INTERVAL 20 DAY 
        AND (notification_title = 'Job' OR (notification_title = 'Status' AND candidate_id = $candidate_id)) 
        AND read_as = 0";
$unread_count_result = $conn->query($unread_count_sql);
$unread_count = 0;
if ($unread_count_result && $unread_count_result->num_rows > 0) {
    $row = $unread_count_result->fetch_assoc();
    $unread_count = $row['unread_count'];
}

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
            <style>
                .header {
                width: 70%;
                padding: 10px;
                background-color: #f1f1f1;
                font-size: 23px;
                font-weight: bold;
                }
                .header-del{
                background-color:#f1f1f1;
                color:#007bff;
                border:none;
                height: 50px;
                width: 30%;
                font-size:12px;
                cursor: pointer;
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
                                            <!-- <li><a href="dashboard.php">Home</a></li> -->
                                            <li><a href="job_listing.php">Jobs </a></li>

                                            <?php
                                                }elseif($_SESSION['user_type'] === 'Recruiter'){
                                            ?>
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
                                        <button id="bell-icon" class="drop-icon"><i class="fa-solid fa-bell fa-xl bell-icon"></i></button>
                                        <p class="notification-count"><?php echo $unread_count; ?></p>
                                        <div id="notification-dropdown-content" class="dropdown-content">
                                            <!-- Unread Messages -->
                                            <div class="main-div">
                                                <div class="header">Notifications</div>
                                                <button class="header-del">Mark All as Read</button>
                                            </div>
                                            <!-- HTML part for the buttons in the Unread and Read sections -->
                                <div class="unread">
                                    <h6>Unread Messages</h6>
                                    <div id="unread-messages">
                                        <?php
                                        if ($unread_result && $unread_result->num_rows > 0) {
                                            while ($row = $unread_result->fetch_assoc()) {
                                        ?>
                                        <div class="message unread_message">
                                            <i class="fa-solid fa-envelope mr-3 fa-xl"></i>
                                            <a><?php echo $row['message']; ?></a>
                                            <?php if ($row['notification_title'] === 'Job') { ?>
                                                <span class="action-icon ml-3">
                                                    <a href="job_details.php?job_id=<?php echo $row['job_or_status_id']; ?>&recruiter_id=<?php echo $row['recruiter_id']; ?>"> 
                                                        <i class="fa-solid fa-up-right-from-square fa-lg"></i>
                                                    </a>
                                                </span>
                                            <?php } ?>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div id="show-more-unread" class="show-more mt-3">Show all unread messages</div>
                                </div>

                                <div class="read">
                                    <h6>Read Messages</h6>
                                    <div id="read-messages">
                                        <?php
                                        if ($read_result && $read_result->num_rows > 0) {
                                            while ($row = $read_result->fetch_assoc()) {
                                        ?>
                                        <div class="message read_message">
                                            <i class="fa-solid fa-envelope mr-3 fa-xl"></i>
                                            <a><?php echo $row['message']; ?></a>
                                            <?php if ($row['notification_title'] === 'Job') { ?>
                                                <span class="action-icon ml-3">
                                                    <a href="job_details.php?job_id=<?php echo $row['job_or_status_id']; ?>&recruiter_id=<?php echo $row['recruiter_id']; ?>"> 
                                                        <i class="fa-solid fa-up-right-from-square fa-lg"></i>
                                                    </a>
                                                </span>
                                            <?php } ?>
                                        </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
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
document.addEventListener('DOMContentLoaded', function () {
    const bellIcon = document.getElementById('bell-icon');
    const dropdownContent = document.getElementById('notification-dropdown-content');

    bellIcon.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent click from propagating
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!dropdownContent.contains(event.target) && event.target !== bellIcon) {
            dropdownContent.style.display = 'none';
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    let unreadOffset = 0;
    let readOffset = 0;
    const limit = 5; // Set how many messages to load each time

    document.getElementById('show-more-unread').addEventListener('click', function () {
        loadMoreMessages('unread', unreadOffset);
        unreadOffset += limit; // Increase the offset after each load
    });
    document.getElementById('show-more-read').addEventListener('click', function () {
        loadMoreMessages('read', readOffset);
        readOffset += limit; // Increase the offset after each load
    });

    function loadMoreMessages(type, offset) {
        const url = type === 'unread' ? 'fetch_unread_notifications.php' : 'fetch_read_notifications.php';

        fetch(`${url}?limit=${limit}&offset=${offset}`)
            .then(response => response.text())
            .then(data => {
                if (type === 'unread') {
                    document.getElementById('unread-messages').innerHTML += data; // Append new messages
                } else {
                    document.getElementById('read-messages').innerHTML += data; // Append new messages
                }
            })
            .catch(error => console.error('Error loading notifications:', error));
    }
});

 document.addEventListener('DOMContentLoaded', function() {
    const headerDelButton = document.querySelector('.header-del');

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
});


</script>
        
    </body>
</html>