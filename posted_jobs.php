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
    .post_btn {
        padding-left: 60%; /* Default for larger screens */
    }

    @media screen and (max-width: 992px) { /* For tablet screens and smaller */
        .post_btn {
            padding-left: 40%;
        }
    }

    @media screen and (max-width: 768px) { /* For mobile screens */
        .post_btn {
            padding-left: 20%;
        }
    }

    @media screen and (max-width: 576px) { /* For very small screens */
        .post_btn {
            padding-left: 10%;
        }
    }

    @media screen and (max-width: 480px) { /* For extra small mobile screens */
        .post_btn {
            padding-left: 0;
            text-align: center; /* Centers the button on small screens */
        }
    }
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
    .dropdown-toggle {
    background-image: none !important; /* Remove default arrow */
    border: none; /* Optional: remove border */
    box-shadow: none; /* Optional: remove shadow */
    outline: none; /* Remove focus outline */
    margin-bottom:5%;
}
.dropdown{
    padding: 10px 0px 20px 73px;
}
.btn-link{
    margin: 0px 0px 60px 90px;
}
.btn-link i{
    color:black;
}
.dropdown-toggle::after {
    display: none !important; /* Remove arrow that comes with Bootstrap dropdowns */
}

.dropdown-menu {
    margin-top: 0; /* Optional: Adjust margin to ensure proper placement */
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
                background-color:#fff;
                display: block;
                width:100%;
                border: 1px solid #8b92dd;
                border-radius: 30px;
                padding: 4px 33px;
                text-align: center;
            }
            .share_btn:hover{
                color:#fff;
                background: #8b92dd;
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

<!-- Hero Area Start-->
<div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Posted Jobs</h2>
                                <form class="d-flex mt-4" method="GET" action="posted_jobs.php">
                                    <button class="icon-btn" type="button" disabled><i class="fa-solid fa-magnifying-glass ml-2 mr-1"></i></button>
                                    <input class="select-input" type="search" name="search" placeholder="Search by keyword or location" aria-label="Search" required>
                                    <button class="search-btn" type="submit">Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
    <main>

        
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            
            <div  style='margin-left:7%; margin-right:7%;'>
                <div class="row">
                <h2 class="ml-5 mb-2">Posted Jobs</h2>
                <?php
                if($_SESSION['user_type'] === 'Recruiter'){?>
                <div class="post_btn">
                    <a class="btn" href="post_job.php">Post New Jobs</a>
                </div>
                <?php }?>
            </div>
                <hr>
                <?php
                // Pagination configuration
$jobs_per_page = 10; // Number of jobs per page
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $jobs_per_page;

// Modify the query to count total jobs for pagination
$conditions = [];
if (!empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $conditions[] = "(job_title LIKE '%$search%' OR discription LIKE '%$search%' OR company_location LIKE '%$search%' OR requirements LIKE '%$search%')";
}

$base_query = "SELECT * FROM job_post ";
$base_count_query = "SELECT COUNT(*) as total_jobs FROM job_post ";

// Adjust the query based on user type
if ($_SESSION['user_type'] === 'Recruiter') {
    $recruiter_id = $_SESSION['id'];
    $base_query .= "WHERE recruiter_id = '$recruiter_id' ";
    $base_count_query .= "WHERE recruiter_id = '$recruiter_id' ";
}

// Add search conditions if any
if (count($conditions) > 0) {
    $condition_sql = implode(" AND ", $conditions);
    $base_query .= $_SESSION['user_type'] === 'Recruiter' ? "AND $condition_sql " : "WHERE $condition_sql ";
    $base_count_query .= $_SESSION['user_type'] === 'Recruiter' ? "AND $condition_sql " : "WHERE $condition_sql ";
}

// Get the total number of jobs for pagination calculation
$total_jobs_result = $conn->query($base_count_query);
$total_jobs_row = $total_jobs_result->fetch_assoc();
$total_jobs = $total_jobs_row['total_jobs'];
$total_pages = ceil($total_jobs / $jobs_per_page);

// Fetch paginated jobs
$job_query = $base_query . "ORDER BY date DESC LIMIT $jobs_per_page OFFSET $offset";
$result = $conn->query($job_query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='single-job-items mb-30' style='margin-left:5%; margin-right:5%;'>";
        echo "<div class='job-items'>";
        echo "<div class='company-img'>";
        echo "<a href='job_details.php?job_id=" . $row['job_id'] . "&recruiter_id=" . $row['recruiter_id'] . "'><img style='width:120px; height:120px;' src='/e-recruitment/upload/" . $row['company_logo'] . "'></a>";
        echo "</div>";
        echo "<div class='job-tittle job-tittle2'>";
        echo "<a href='job_details.php?job_id=" . $row['job_id'] . "&recruiter_id=" . $row['recruiter_id'] . "'>";
        echo "<h4>" . $row['job_title'] . "</h4>";
        echo "</a>";
        echo "<ul>";
        echo "<li>" . $row['company_name'] . "</li>";
        echo "<li> Category: " . $row['categories'] . "</li><br>";
        
        $discriptionPreview = substr($row['discription'], 0, 50) . (strlen($row['discription']) > 15 ? '...' : '');
        echo "<li>" . $discriptionPreview . "</li><br>";
        $requirementsPreview = substr($row['requirements'], 0, 50) . (strlen($row['requirements']) > 15 ? '...' : '');
        echo "<li class='mt-2'>" . $requirementsPreview . "</li>";
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        echo "<div class='items-link items-link2 f-right'>";
        echo "<div class='dropdown'>
                <button class='btn-link dropdown-toggle' type='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                <i class='fas fa-ellipsis-v fa-lg'></i></button>
                <div class='dropdown-menu dropdown-menu-right'>
                    <a class='dropdown-item' href='edit_job.php?job_id=". $row['job_id'] ."'>Edit</a>
                    <a class='dropdown-item' href='delete_job.php?job_id=". $row['job_id']. "'>Delete</a>
                    <a class='dropdown-item' href='deactive_job.php?job_id=". $row['job_id'] ."' onclick='toggleJobStatus(" .$row['job_id'] .")'>". ($row['status'] === 'active' ? 'Deactivate' : 'Activate') ."</a>
                    <button class='share_btn mt-3' style='margin-top:-25px; cursor: pointer;' data-url='job_details.php?job_id=" . $row['job_id'] . "' data-toggle='modal' data-target='#shareModal'>Share</button>
                </div>
              </div>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "No job posts found.";
}
?>
                                </div>
        </div>

 <!-- Pagination Links -->
 <?php if ($total_jobs > 10): ?>
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
<?php endif; ?>
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
                    <a href="#" id="fbIcon" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" id="twitterIcon" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" id="linkedinIcon" target="_blank"><i class="fab fa-linkedin"></i></a>
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
        function toggleJobStatus(jobId) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "deactive_job.php?id=" + jobId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload(); // Reload the page to reflect the changes
                }
            };
            xhr.send();
        }

        $(document).ready(function () {
    // Use event delegation for dynamically generated share buttons
    $(document).on('click', '.share_btn', function() {
        let url = $(this).attr("data-url");
        let baseUrl = window.location.origin;
        
        // Update base URL if on localhost
        if (baseUrl === 'http://localhost') {
            baseUrl = baseUrl + '/' + 'e-recruitment';
        }
        
        let fullURL = baseUrl + '/' + url;
        
        // Prepare URLs for social media
        let fb_url = "https://www.facebook.com/sharer/sharer.php?u=" + fullURL;
        let twitter_url = "https://twitter.com/intent/tweet?url=" + fullURL;
        let linkedin_url = "https://www.linkedin.com/sharing/share-offsite/?url=" + fullURL;
        
        // Update modal fields with the URL and social media links
        $("#jobLink").val(fullURL);           // Update the job link input field
        $("#fbIcon").attr("href", fb_url).attr("target", "_blank");    // Set Facebook share link
        $("#twitterIcon").attr("href", twitter_url).attr("target", "_blank");  // Set Twitter share link
        $("#linkedinIcon").attr("href", linkedin_url).attr("target", "_blank");  // Set LinkedIn share link
    });

    // Copy the job link to clipboard when the "Copy" button is clicked
    $('.input_btn').on('click', function() {
        var copyText = $('#jobLink'); // Select the input field with job link
        copyText.select();
        document.execCommand('copy'); // Copy the link to clipboard
        
        // Alert message for feedback
        alert("Copied the link: " + copyText.val());
    });
});

    </script>
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