<?php
session_start();
include 'connection.php';
if (!isset($_SESSION['name'])) {
    echo "<script>alert('Access Denied! Please login first.');</script>";
    exit;
}

$recruiter_id = $_SESSION['id'];
$jobs_per_page = 10;

// Find out the total number of jobs in the database
$total_jobs_sql = "SELECT COUNT(*) AS total FROM job_post WHERE status = 'active'";
$total_jobs_result = $conn->query($total_jobs_sql);
$total_jobs_row = $total_jobs_result->fetch_assoc();
$total_jobs = $total_jobs_row['total'];

// Calculate the total number of pages
$total_pages = ceil($total_jobs / $jobs_per_page);

// Get the current page number from the query string, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($current_page < 1) {
    $current_page = 1;
}

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $jobs_per_page;

// Ensure the offset is non-negative
if ($offset < 0) {
    $offset = 0;
}

// Fetch the job posts for the current page
$sql = "SELECT * FROM job_post WHERE status = 'active'";


// Add conditions based on filter inputs
$conditions = [];

if (!empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $conditions[] = "(job_title LIKE '%$search%' OR discription LIKE '%$search%' OR company_location LIKE '%$search%' OR requirements LIKE '%$search%')";
}

// Check if category is selected
if (!empty($_GET['categories'])) {
    $categories = $conn->real_escape_string($_GET['categories']);
    $conditions[] = "categories = '$categories'";
}

// Check if job types are selected
if (!empty($_GET['timing'])) {
    $timing = implode("','", array_map([$conn, 'real_escape_string'], $_GET['timing']));
    $conditions[] = "timing IN ('$timing')";
}

// Check if location is selected
if (!empty($_GET['company_location'])) {
    $company_location = $conn->real_escape_string($_GET['company_location']);
    $conditions[] = "company_location = '$company_location'";
}

// Check if the 'posted_within' filter is selected
if (!empty($_GET['posted_within'])) {
    // Get the number of days from the radio button
    $posted_within_days = (int)$_GET['posted_within'];

    // Calculate the date to compare against the 'created_at' column
    $posted_within_date = date('Y-m-d H:i:s', strtotime("-$posted_within_days days"));

    // Add the condition to filter jobs posted within the specified date range
    $conditions[] = "created_at >= '$posted_within_date'";
}

// Count jobs that match the current filter
$count_sql = "SELECT COUNT(*) AS total FROM job_post WHERE status = 'active'";
if (count($conditions) > 0) {
    $count_sql .= " AND " . implode(" AND ", $conditions);
}

$count_result = $conn->query($count_sql);
$count_row = $count_result->fetch_assoc();
$total_entries = $count_row['total'];

// Add sorting or pagination if needed
$sql .= " ORDER BY created_at DESC LIMIT $offset, $jobs_per_page";
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
            .d-flex{
                justify-content:center;
            }
            .icon-btn{
                color:black;
                background:white;
                border:0;
                height: 50px;
                border-top-left-radius: 25px;
                border-bottom-left-radius: 25px;
            }
            .select-input{
                width: 35%;
                height: 50px;
                border:none;
                
            }
            .search-btn{
                border-top-right-radius: 25px;
                border-bottom-right-radius: 25px;
                background: #fb246a;
                color:white;
                height: 50px;
                display: inline-block;
                padding: 13px 35px;
                font-family: "Muli", sans-serif;
                font-size: 14px;
                font-weight: 400;
                border: 1px solid #fb246a;
                letter-spacing: 3px;
                text-align: center;
                text-transform: uppercase;
                cursor: pointer
            }
            .modal-confirm {
                color: #fb246a;
                width: 325px;
            }
            .modal-confirm .modal-content {
                padding: 20px;
                border-radius: 5px;
                margin-top:30%;
                border: none;
            }
            .modal-confirm .modal-header {
                border-bottom: none;
                position: relative;
            }
            .modal-confirm h4 {
                text-align: center;
                font-size: 26px;
                margin: 30px 0 -15px;
            }
            .modal-confirm .form-control, .modal-confirm .btn {
                min-height: 40px;
                border-radius: 3px;
            }
            .modal-confirm .close {
                position: absolute;
                top: -5px;
                right: -5px;
            }
            .modal-confirm .modal-footer {
                border: none;
                text-align: center;
                border-radius: 5px;
                font-size: 13px;
            }
            .modal-confirm .icon-box {
                color: #fff;
                position: absolute;
                margin: 0 auto;
                left: 0;
                right: 0;
                top: -70px;
                width: 95px;
                height: 95px;
                border-radius: 50%;
                z-index: 9;
                background: #fb246a;
                padding: 15px;
                text-align: center;
                box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
            }
            .modal-confirm .icon-box i {
                font-size: 58px;
                position: relative;
                top: 3px;
            }
            .modal-confirm.modal-dialog {
                margin-top: 80px;
            }
            .modal-confirm .btn {
                color: #fff;
                border-radius: 4px;
                background: #fb246a;
                text-decoration: none;
                transition: all 0.4s;
                line-height: normal;
                border: none;
            }
            .modal-confirm .btn:hover, .modal-confirm .btn:focus {
                background: #fb246a;
                outline: none;
            }
            .trigger-btn {
                display: inline-block;
                margin: 100px auto;
            }
            .icons{
                justify-content:center;
            }
            .icons a{
                display: flex;
                align-items: center;
                margin:7px 18px;
                border-radius: 50%;
                justify-content: center;
                transition: all 0.3s ease-in-out;
            }
            .icons a{
                height: 50px;
                width: 50px;
                font-size: 20px;
                text-decoration: none;
                border: 1px solid transparent;
            }
            .icons a i{
                transition: transform 0.3s ease-in-out;
            }
            .icons a:nth-child(1){
                color: #1877F2;
                border-color: #b7d4fb;
            }
            .icons a:nth-child(1):hover{
                background: #1877F2;
            }
            .icons a:nth-child(2){
                color: #46C1F6;
                border-color: #b6e7fc;
            }
            .icons a:nth-child(2):hover{
                background: #46C1F6;
            }
            .icons a:nth-child(3){
                color: #e1306c;
                border-color: #f5bccf;
            }
            .icons a:nth-child(3):hover{
                background: #e1306c;
            }
            .icons a:hover{
                color: #fff;
                border-color: transparent;
            }
            .icons a:hover i{
                transform: scale(1.2);
            }
            .field{
                display:flex;
                margin: 12px 0 -5px 0;
                height: 45px;
                border-radius: 4px;
                padding: 0;
                border: 1px solid #757171;
            }
            .field.active{
                border-color: #7d2ae8;
            }
            .field i{
                margin:10px 2px;
                width: 50px;
                font-size: 18px;
                text-align: center;
                color:black;
            }
            .field input{
                width: 100%;
                height: 100%;
                border: none;
                outline: none;
                font-size: 15px;
            }
            .input_btn{
                color: black;
                padding-top: 10px;
                padding-bottom: 9px;
                padding-right: 18px;
                padding-left: 18px;
                border:none;
            }
            .input_btn:hover{
                color:#fff;
                background: #fb246a;
            }
            .share_btn {
                color: #8b92dd;
                display: block;
                width:100%;
                border: 1px solid #8b92dd;
                border-radius: 30px;
                padding: 4px 33px;
                text-align: center;
                margin-bottom: 25px;
                cursor: pointer;
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
    <?php include "navbar.php"; ?>


    <main>
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Get your job</h2>
                                <form class="d-flex mt-4" method="GET" action="job_listing.php">
                                    <button class="icon-btn" type="button" disabled><i class="fa-solid fa-magnifying-glass ml-2 mr-1"></i></button>
                                    <input class="select-input" type="search" name="search" placeholder="Search by keyword or location" aria-label="Search">
                                    <button class="search-btn" type="submit">Search</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <!-- Left content -->
                    <div class="col-xl-3 col-lg-3 col-md-4">
                        <div class="row">
                            <div class="col-12">
                                    <div class="small-section-tittle2 mb-45">
                                        <div class="ion"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="12px"><path fill-rule="evenodd"  fill="rgb(27, 207, 107)" d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/></svg>
                                    </div>
                                    <h4>Filter Jobs</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Job Category Listing start -->
                        <div class="job-category-listing mb-50">
                            <!-- single one -->
                            <div class="single-listing">
                               <div class="small-section-tittle2">
                                     <h4>Job Category</h4>
                               </div>
                                <!-- Select job items start -->
                                <form method="GET" action="job_listing.php">
                                    <div class="select-job-items2">
                                        <select name="categories" required>
                                            <option selected disabled>Select Job Category</option>
                                            <option value="Design & Creative">Design & Creative</option>
                                            <option value="Design & Development">Design & Development</option>
                                            <option value="Sales & Marketing">Sales & Marketing</option>
                                            <option value="Mobile Application">Mobile Application</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Content Writer">Content Writer</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <!--  Select job items End-->
                                    <!-- select-Categories start -->
                                    <div class="select-Categories pt-80 pb-50">
                                        <div class="small-section-tittle2">
                                            <h4>Job Type</h4>
                                        </div>
                                        <label class="container">Full Time
                                            <input type="checkbox" name="timing[]" value="Full Time">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container">Part Time
                                            <input type="checkbox" name="timing[]" value="Part Time">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container">Remote
                                            <input type="checkbox" name="timing[]" value="Remote">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container">Freelance
                                            <input type="checkbox" name="timing[]" value="Freelance">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                <!-- select-Categories End -->
                            </div>
                            <!-- single two -->
                            <div class="single-listing">
                                <div class="small-section-tittle2">
                                    <h4>Job Location</h4>
                               </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="company_location">
                                        <option selected disabled>Anywhere</option>
                                        <option value="Lahore">Lahore</option>
                                        <option value="Islamabad">Islamabad</option>
                                        <option value="Karachi">Karachi</option>
                                        <option value="Sialkot">Sialkot</option>
                                    </select>
                                </div>
                                <!--  Select job items End-->
                            </div>
                            <!-- single three -->
                            <div class="single-listing">
                                <!-- select-Categories start -->
                                <div class="select-Categories pb-50">
                                    <div class="small-section-tittle2">
                                        <h4>Posted Within</h4>
                                    </div>
                                    <label class="container">Today
                                        <input type="radio" name="posted_within" value="1">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 2 days
                                        <input type="radio" name="posted_within" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 3 days
                                        <input type="radio" name="posted_within" value="3">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 5 days
                                        <input type="radio" name="posted_within" value="5">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 10 days
                                        <input type="radio" name="posted_within" value="10">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <!-- select-Categories End -->
                            </div>

                            <div class="single-listing">
                                <!-- Range Slider Start -->
                                <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow">
                                    <button type="submit" class='btn mt-5'>Filter Jobs</button>
                                </aside>
                                </form>
                              <!-- Range Slider End -->
                            </div>
                        </div>
                        <!-- Job Category Listing End -->
                    </div>
                    <!-- Right content -->
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                                <!-- Count of Job list Start -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="count-job mb-35">
                                            
                                            <span> Jobs found <?php echo $total_entries; ?></span>
                                            <!-- Select job items start -->
                                            <div class="select-job-items">
                                                
                                            </div>
                                            <!--  Select job items End-->
                                        </div>
                                    </div>
                                </div>
                                <!-- Count of Job list End -->
                                <!-- single-job-content -->
                                <?php
include "connection.php";
$jobs_per_page = 10;

// Find out the total number of jobs in the database
$total_jobs_sql = "SELECT COUNT(*) AS total FROM job_post WHERE status = 'active'";
$total_jobs_result = $conn->query($total_jobs_sql);
$total_jobs_row = $total_jobs_result->fetch_assoc();
$total_jobs = $total_jobs_row['total'];

// Calculate the total number of pages
$total_pages = ceil($total_jobs / $jobs_per_page);

// Get the current page number from the query string, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

if ($current_page < 1) {
    $current_page = 1;
}

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $jobs_per_page;

// Ensure the offset is non-negative
if ($offset < 0) {
    $offset = 0;
}

// Fetch the job posts for the current page
$sql = "SELECT * FROM job_post WHERE status = 'active'";


// Add conditions based on filter inputs
$conditions = [];

if (!empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $conditions[] = "(job_title LIKE '%$search%' OR discription LIKE '%$search%' OR company_location LIKE '%$search%' OR requirements LIKE '%$search%')";
}

// Check if category is selected
if (!empty($_GET['categories'])) {
    $categories = $conn->real_escape_string($_GET['categories']);
    $conditions[] = "categories = '$categories'";
}

// Check if job types are selected
if (!empty($_GET['timing'])) {
    $timing = implode("','", array_map([$conn, 'real_escape_string'], $_GET['timing']));
    $conditions[] = "timing IN ('$timing')";
}

// Check if location is selected
if (!empty($_GET['company_location'])) {
    $company_location = $conn->real_escape_string($_GET['company_location']);
    $conditions[] = "company_location = '$company_location'";
}

// Check if the 'posted_within' filter is selected
if (!empty($_GET['posted_within'])) {
    // Get the number of days from the radio button
    $posted_within_days = (int)$_GET['posted_within'];

    // Calculate the date to compare against the 'created_at' column
    $posted_within_date = date('Y-m-d H:i:s', strtotime("-$posted_within_days days"));

    // Add the condition to filter jobs posted within the specified date range
    $conditions[] = "created_at >= '$posted_within_date'";
}

// Add conditions to the SQL query
if (count($conditions) > 0) {
    $sql .= " AND " . implode(" AND ", $conditions);
}

// Add sorting or pagination if needed
$sql .= " ORDER BY created_at DESC LIMIT $offset, $jobs_per_page";

// Execute the query and fetch the results
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    // Output the SQL error message
    echo "Error: " . $conn->error;
} else {
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $created_at = new DateTime($row['created_at']);
        $now = new DateTime();
        $interval = $now->diff($created_at);

    // Formatting the time difference
    if ($interval->y > 0) {
        $time_ago = $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
    } elseif ($interval->m > 0) {
        $time_ago = $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
    } elseif ($interval->d > 0) {
        $time_ago = $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
    } elseif ($interval->h > 0) {
        $time_ago = $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
    } elseif ($interval->i > 0) {
        $time_ago = $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
    } else {
        $time_ago = "Just now";
    }
        echo "<div class='single-job-items mb-30'>";
        echo "<div class='job-items'>";
        echo "<div class='company-img'>";
        // Including both job_id and recruiter_id in the URL
        echo "<a href='job_details.php?job_id=" . $row['job_id'] . "&recruiter_id=" . $row['recruiter_id'] . "'><img style='width:120px; height:120px;' src='/e-recruitment/upload/" . $row['company_logo'] . "'></a>";
        echo "</div>";
        echo "<div class='job-tittle job-tittle2'>";
        echo "<a href='job_details.php?job_id=" . $row['job_id'] . "&recruiter_id=" . $row['recruiter_id'] . "'>";
        echo "<h4>" . $row['job_title'] . "</h4>";
        echo "</a>";
        echo "<ul>";
        echo "<li>" . $row['company_name'] . "</li>";
        echo "<li>     </li>";
        echo "<li> Category:" . $row['categories'] . "</li> <br>";
        
        $discriptionPreview = substr($row['discription'], 0, 50) . (strlen($row['discription']) > 15 ? '...' : '');
        echo "<li >" . $discriptionPreview . "</li> <br>";
        $requirementsPreview = substr($row['requirements'], 0, 50) . (strlen($row['requirements']) > 15 ? '...' : '');
        echo "<li class='mt-2'>" . $requirementsPreview . "</li>";
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        echo "<div class='items-link f-right'>";
        echo "<a href='job_details.php?job_id=" . $row['job_id'] . "&recruiter_id=" . $row['recruiter_id'] . "'>" . $row['timing'] . "</a> <br>";

        echo "<button class='share_btn' style='margin-top:-25px; cursor: pointer;' data-url='job_details.php?job_id=" . $row['job_id'] . "' data-toggle='modal' data-target='#shareModal'>Share</button> <br>";

        echo "<span><i class='fas fa-map-marker-alt'></i> " . $row['company_location'] . "</span>";
        echo "<span class='mt-2'>Salary:  " . $row['salary'] . "</span>";
        echo "<span class='mt-2'>  " . $time_ago . "</span>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No job posts found.";
}}
?>                
                    
                        </section>
                        <!-- Featured_job_end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Job List Area End -->
        <!-- Pagination -->
<div class="pagination-area pb-115 text-center">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="single-wrap d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-start">
                            <?php if ($current_page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item <?php echo $i == $current_page ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pagination End -->
        
    </main>

<!-- Share Modal Section -->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE80D;</i> <!-- Share icon -->
                </div>
                <h4 class="modal-title">Share this Job!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Help others by sharing this job with your network!</p>
                <ul class="icons row">
                    <a href="#" id="fbIcon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" id="twitterIcon"><i class="fab fa-twitter"></i></a>
                    <a href="#" id="linkedinIcon"><i class="fab fa-linkedin"></i></a>
                </ul>
                <p>Or copy link</p>
                <div class="field align-items-center">
                    <i class="fa-solid fa-link"></i>
                    <input type="text" class="field_input" id="jobLink" readonly>
                    <button class="input_btn">Copy</button>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <?php include "footer.php"; ?>
    
    <script>
        document.querySelector('.input_btn').addEventListener('click', function() {
            var copyText = document.querySelector('.field_input');
            copyText.select();
            document.execCommand('copy');
            alert("Copied the link: " + copyText.value);
        });

        $(".share_btn").on('click', function() {
            let url = $(this).attr("data-url");
            let baseUrl = window.location.origin;
            if(baseUrl === 'http://localhost') {
                baseUrl = baseUrl + '/' + 'e-recruitment'
            }
            let fullURL = baseUrl + '/' + url;
            let fb_url = "https://www.facebook.com/sharer/sharer.php?u=" + fullURL;
            let twitter_url = "https://twitter.com/intent/tweet?url=" + fullURL;
            let linkedin_url = "https://www.linkedin.com/sharing/share-offsite/?url=" + fullURL;

            $("#jobLink").val(fullURL);
            $("#fbIcon").attr("href", fb_url);
            $("#twitterIcon").attr("href", twitter_url);
            $("#linkedinIcon").attr("href", linkedin_url);
        });
    </script>

	<!-- JS here -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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