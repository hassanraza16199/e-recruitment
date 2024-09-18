<?php
session_start();

if(!isset($_SESSION['name'])){
    header("Location: login.php");
}
include 'connection.php';


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
                                <form class="d-flex mt-4" method="GET" action="resumes.php">
                                <button class="icon-btn" type="button" disabled><i class="fa-solid fa-magnifying-glass ml-2 mr-1"></i></button>
                                    <input class="select-input" type="search" name="search" placeholder="     Search Keyword" aria-label="Search">
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
                                    <div class="ion"> <svg 
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="20px" height="12px">
                                    <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                        d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                                    </svg>
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
                                        <option selected>Select Job Category</option>
                                        <option value="">All Category</option>
                                        <option value="Design & Creative">Design & Creative</option>
                                        <option value="Design & Development">Design & Development</option>
                                        <option value="Sales & Marketing">Sales & Marketing</option>
                                        <option value="Mobile Application">Mobile Application</option>
                                        <option value="Construction">Construction</option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Real Estate">Real Estate</option>
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
                                        <!-- <option value="">Anywhere</option> -->
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
                                    <label class="container">Any
                                        <input type="checkbox" >
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Today
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 2 days
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 3 days
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 5 days
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 10 days
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <!-- select-Categories End -->
                            </div>

                            <div class="single-listing">
                                <!-- Range Slider Start -->
                                <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow">
                                    <div class="small-section-tittle2">
                                        <h4>Filter Jobs</h4>
                                    </div>
                                    <div class="widgets_inner">
                                        <div class="range_item">
                                            <!-- <div id="slider-range"></div> -->
                                            <input type="text" class="js-range-slider" value="" />
                                            <div class="d-flex align-items-center">
                                                <div class="price_text">
                                                    <p>Price :</p>
                                                </div>
                                                <div class="price_value d-flex justify-content-center">
                                                    <input type="text" class="js-input-from" id="amount" readonly />
                                                    <span>to</span>
                                                    <input type="text" class="js-input-to" id="amount" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                            <?php
                                            $count_sql = "SELECT COUNT(*) AS total FROM job_post";
                                            $count_result = $conn->query($count_sql);
                                            $count_row = $count_result->fetch_assoc();
                                            $total_entries = $count_row['total'];
                                            $conn->close();
                                            ?>
                                            <span> Jobs found <?php echo $total_entries; ?></span>
                                            <!-- Select job items start -->
                                            <div class="select-job-items">
                                                <span>Sort by</span>
                                                <select name="select">
                                                    <option value="">None</option>
                                                    <option value="">job list</option>
                                                    <option value="">job list</option>
                                                    <option value="">job list</option>
                                                </select>

                                                
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

// Make sure the current page is within the valid range
if ($current_page < 1) {
    $current_page = 1;
} elseif ($current_page > $total_pages) {
    $current_page = $total_pages;
}

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $jobs_per_page;

// Fetch the job posts for the current page
$sql = "SELECT * FROM job_post WHERE status = 'active'";

// Add conditions based on filter inputs
$conditions = [];

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

// Check if experience is selected
if (!empty($_GET['experience'])) {
    $experience = implode("','", array_map([$conn, 'real_escape_string'], $_GET['experience']));
    $conditions[] = "experience IN ('$experience')";
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
        echo "<li> Categories: " . $row['categories'] . "</li> <br>";
        
        $discriptionPreview = substr($row['discription'], 0, 65) . (strlen($row['discription']) > 15 ? '...' : '');
        echo "<li >" . $discriptionPreview . "</li> <br>";
        $requirementsPreview = substr($row['requirements'], 0, 65) . (strlen($row['requirements']) > 15 ? '...' : '');
        echo "<li class='mt-2'>" . $requirementsPreview . "</li>";
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        echo "<div class='items-link items-link2 f-right'>";
        echo "<a href='job_details.php?job_id=" . $row['job_id'] . "&recruiter_id=" . $row['recruiter_id'] . "'>" . $row['timing'] . "</a> <br>";
        echo "<span><i class='fas fa-map-marker-alt'></i> " . $row['company_location'] . "</span>";
        echo "<span class='mt-2'>Salary:  " . $row['salary'] . "</span>";
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