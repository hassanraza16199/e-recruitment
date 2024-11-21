<?php
session_start();
include "connection.php";
if (!isset($_SESSION['name'])) {
    echo "<script>alert('Access Denied! Please login first.');</script>";
    exit;
}elseif ($_SESSION['user_type'] != 'Recruiter' && $_SESSION['user_type'] != 'Admin') {
    echo "Access denied.";
    exit;
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
/* Style for the main filter container */
.filter-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 8px;
}

/* Styling for the search icon button */
.icon-btn {
    color: #333;
    background: #fff;
    border: none;
    height: 50px;
    border-top-left-radius: 25px;
    border-bottom-left-radius: 25px;
    padding: 0 15px;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Styling for the search input field */
.select-input {
    width: 100%;
    max-width: 500px;
    height: 50px;
    border: none;
    padding-left: 15px;
    font-size: 16px;
    color: #333;
    background: #fff;
    outline: none;
}
.hero-cap {
    text-align: center;
}

.hero-cap form {
    display: flex;
    justify-content: center;
    align-items: center;
    max-width: 600px;
    margin: 0 auto; /* Center align the form */
}

/* Styling for the search button */
.search-btn {
    border-top-right-radius: 25px;
    border-bottom-right-radius: 25px;
    background: #fb246a;
    color: white;
    height: 50px;
    padding: 0 30px;
    font-size: 16px;
    font-weight: 600;
    text-transform: uppercase;
    border: 1px solid #fb246a;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.resumes-embed {
    width: 100%;
    height: 200px; /* Set a fixed height appropriate for your layout */
    overflow: hidden; /* Hide overflow to prevent scrollbars */
    display: block; /* Ensure it displays as a block element */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .filter-container {
        flex-direction: column;
        width: 90%;
        margin: auto;
    }

    .icon-btn, .select-input, .search-btn {
        width: 100%;
        border-radius: 25px;
    }

    .select-input {
        font-size: 14px;
    }

    .search-btn, .icon-btn {
        height: 45px;
        font-size: 14px;
        margin-top: 10px;
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
                                <form class="d-flex mt-4" method="GET" action="resumes.php">
                                <button class="icon-btn" type="button" disabled><i class="fa-solid fa-magnifying-glass ml-2 mr-1"></i></button>
                                    <input class="select-input" type="search" name="search" placeholder="     Search Resumes" aria-label="Search">
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
            <div class="form-container ml-5 mr-5">
                <h3>Users Resumes</h3>
                <div class="row">
                    <?php
                    include "connection.php";
                    $recruiter_id = $_SESSION['id'];

                    // Base query for counting total resumes
                    $count_sql = "SELECT COUNT(*) AS total FROM applications WHERE recruiter_id = '$recruiter_id'";

                    // Check if the search keyword is set and not empty
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $searchKeyword = mysqli_real_escape_string($conn, $_GET['search']);
                        $count_sql .= " AND firstname LIKE '%$searchKeyword%'";
                    }

                    // Execute count query
                    $count_result = mysqli_query($conn, $count_sql);
                    $count_row = mysqli_fetch_assoc($count_result);
                    $total_resumes = $count_row['total'];
                    $items_per_page = 18;
                    $total_pages = ceil($total_resumes / $items_per_page);

                    // Determine the current page
                    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($current_page - 1) * $items_per_page;

                    // Modify main query to limit results based on pagination
                    $sql = "SELECT * FROM applications WHERE recruiter_id = '$recruiter_id'";
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $sql .= " AND firstname LIKE '%$searchKeyword%'";
                    }
                    $sql .= " LIMIT $offset, $items_per_page";

                    // Execute main query
                    $result = mysqli_query($conn, $sql);

                    // Check if results are found
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $application_id = $row['application_id'];
                    ?>
                            <div class="mt-3 ml-4 mr-4 mb-3" style="border-radius:5px;">
                                <div class="card" style="width: 11rem; height:17rem;">
                                    <embed class="resumes-embed" src="/e-recruitment/cv/<?php echo $row['resume']; ?>" type="application/pdf" />
                                    <div class="card-body" style="border-top:1px solid rgba(0, 0, 0, .125); height: 70px;">
                                        <span class="row">
                                            <p style="font-size: 12px; width:80px;"> <?php echo $row['firstname']; ?></p>
                                            <span>
                                                <span class="ml-2">
                                                    <a href="application_status.php?application_id=<?php echo $application_id; ?>"><img src="assets/img/go-to.png" style="width: 15px; margin-top:-7px; cursor:pointer;" alt=""></a>
                                                    
                                                </span> 
                                                <span class="ml-2">
                                                    <i class="fa-solid fa-paperclip open-pdf" data-pdf="/e-recruitment/cv/<?php echo $row['resume']; ?>" style="cursor:pointer;"></i>
                                                </span>  
                                                <span class="ml-2">
                                                    <i class="fa-solid fa-download" style="cursor:pointer;" onclick="openPdfPopup('/e-recruitment/cv/<?php echo $row['resume']; ?>')"></i>
                                                </span>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No resumes found.</p>";
                    }
                    ?>   
                </div>
            </div>
        </div>
        
        <!-- Pagination Links -->
<?php if ($total_resumes > 18): ?>
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

    <!-- Modal for displaying the PDF -->
    <div id="pdfModal" class="modal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; background-color:rgba(0, 0, 0, 0.5);">
        <div class="modal-content" style="margin:auto; background-color:white; padding:20px; width:80%; height:80%;">
            <span id="closeModal" style="float:right; cursor:pointer; font-size:24px;">&times;</span>
            <embed id="pdfViewer" src="" type="application/pdf" width="100%" height="100%" />
        </div>
    </div>

    <?php include "footer.php"; ?>
    <script>
    function openPdfPopup(pdfUrl) {
        var modal = document.createElement('div');
        modal.style.position = 'fixed';
        modal.style.top = '0';
        modal.style.left = '0';
        modal.style.width = '100%';
        modal.style.height = '100%';
        modal.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        modal.style.display = 'flex';
        modal.style.alignItems = 'center';
        modal.style.justifyContent = 'center';
        modal.style.zIndex = '1000';
        
        var iframe = document.createElement('iframe');
        iframe.src = pdfUrl;
        iframe.style.width = '80%';
        iframe.style.height = '80%';
        iframe.style.border = 'none';
        
        var closeButton = document.createElement('button');
        closeButton.innerText = 'x';
        closeButton.style.position = 'absolute';
        closeButton.style.top = '10px';
        closeButton.style.right = '10px';
        closeButton.style.backgroundColor = 'black';
        closeButton.style.border = 'none';
        closeButton.style.padding = '10px';
        closeButton.style.cursor = 'pointer';
        closeButton.onclick = function() {
            document.body.removeChild(modal);
        };

        modal.appendChild(iframe);
        modal.appendChild(closeButton);
        document.body.appendChild(modal);
    }
    // Get the modal element and close button
    var modal = document.getElementById("pdfModal");
    var closeModal = document.getElementById("closeModal");
    var pdfViewer = document.getElementById("pdfViewer");

    // Add click event listener to all elements with the 'open-pdf' class (both img and icon)
    document.querySelectorAll('.open-pdf').forEach(function (element) {
        element.addEventListener('click', function () {
            // Get the PDF file path from the data-pdf attribute
            var pdfPath = this.getAttribute('data-pdf');
            // Set the src of the embed element to display the PDF
            pdfViewer.setAttribute('src', pdfPath);
            // Show the modal
            modal.style.display = 'block';
        });
    });

    // Close the modal when the 'close' button is clicked
    closeModal.onclick = function () {
        modal.style.display = 'none';
    };

    // Close the modal when clicking outside the modal content
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
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