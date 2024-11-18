<?php
session_start();
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $feedback_id = $_POST['feedback_id'];

    $sql = "DELETE FROM feedback WHERE feedback_id = '$feedback_id'";

    if($conn->query($sql) === True){
        header("Location: candidate_feedback.php"); // Replace with the actual page name
    
    }
    exit();
}
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
            <style>
.message-cell {
    max-width: 250px; /* Adjust the width according to your design */
    word-wrap: break-word; /* Break long words */
    white-space: pre-wrap; /* Preserve white spaces and wrap text */
    overflow-wrap: break-word; /* Break long words if necessary */
}
.tooltip-container {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.tooltip-icon {
    font-size: 24px;
    padding: 5px;
    border: none;
}

.tooltip-text {
    visibility: hidden;
    width: 100px;
    background-color: #fff;
    color: #000;
    text-align: center;
    border-radius: 10px;
    border: 1px solid #ccc;
    padding: 10px;
    position: absolute;
    top: 130%; /* Adjusts tooltip to appear below the icon */
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1;
    white-space: nowrap;
}

.tooltip-text svg {
    display: block;
    margin: 0 auto;
}

.tooltip-arrow {
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: 10px solid #ccc;
    position: absolute;
    bottom: 100%; /* Places the arrow above the tooltip */
    left: 50%;
    transform: translateX(-50%);
}

.tooltip-container:hover .tooltip-text {
    visibility: visible;
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
                                <h2>Candidate Feedback</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
    
        <main class="ml-5 mr-5 mt-5 mb-5">

            <!-- Candidate Feedbacks -->
            <div class='mt-5'>
                <h2 class="mt-3 mb-3">Candidate Feedbacks</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sr</th>
                            <th scope="col">Name</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Rating</th>
                            <th scope="col" colspan="2"><span style="margin-left:100px;">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include "connection.php";
                            // Define the limit of feedback entries per page
                            $limit = 15;

                            // Get the current page number from the URL, default to 1
                            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $current_page = max(1, $current_page);

                            // Calculate the offset for the SQL query
                            $offset = ($current_page - 1) * $limit;

                            // Get the total number of feedback entries
                            $total_sql = "SELECT COUNT(*) AS total FROM feedback WHERE user_type = 'Candidate'";
                            $total_result = $conn->query($total_sql);
                            $total_row = $total_result->fetch_assoc();
                            $total_feedbacks = $total_row['total'];

                            // Calculate the total number of pages
                            $total_pages = ceil($total_feedbacks / $limit);

                            // Fetch feedback entries for the current page
                            $sql = "SELECT * FROM feedback WHERE user_type = 'Candidate' LIMIT $limit OFFSET $offset";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $user_type = $row['user_type'];
                                    if($user_type === 'Candidate'){
                        ?>
                        <tr>
                            <th scope="row"><?php echo $row['feedback_id']; ?></th>
                            <td><?php echo $row['user_name']; ?></td>
                            <td class="message-cell"><?php echo $row['comment']; ?></td>
                            <td><?php echo $row['rating']; ?></td>
                            <form action="candidate_feedback.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="feedback_id" value="<?php echo $row['feedback_id']; ?>">
                            <td>
                                <div class="tooltip-container">
                                    <span class="tooltip-icon"><button type="submit" style="border:none;background:none;">
                                    <i class="fa-solid fa-trash" style="color:#FF0000; cursor: pointer;"></i>
                                    </button></span>
                                    <div class="tooltip-text">
                                        <!-- Replace the SVG with your text -->
                                        Delete 
                                        <div class="tooltip-arrow"></div>
                                    </div>
                            </td>
                            <td>
                               
                                    <div class="tooltip-container">
                                    <span class="tooltip-icon"> <a href='job_details.php?job_id=<?php echo $row['job_id']; ?>&recruiter_id=<?php echo $row['recruiter_id']; ?>'>
                                        <i class="fa-solid fa-file-import  ml-2" style="color:#000080;"></i>
                                    </a></span>
                                    <div class="tooltip-text">
                                        <!-- Replace the SVG with your text -->
                                        Go to post
                                        <div class="tooltip-arrow"></div>
                                    </div>
                            </td>
                        </form>
                        </tr>
                        <?php
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
    <?php if ($total_feedbacks > $limit): ?>
        <div class="pagination-area pb-115 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav>
                                <ul class="pagination">
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

		<!-- Jquery Slick , Owl-Carousel Plugins -->
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