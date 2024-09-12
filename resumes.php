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
        <link rel="manifest" href="site.webmanifest">
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
                /* Add this to your style section */
.modal-content embed {
    width: 100%;
    height: 100%;
    border: none;
    overflow: hidden; /* Disable scroll */
}

                .d-flex{
                    justify-content:center;
                }
                .icon-btn{
                    color:black;
                    background:white;
                    border:0;
                    border-top-left-radius: 25px;
                    border-bottom-left-radius: 25px;
                }
                .select-input{
                    width: 34%;
                    border:none;
                    
                }
                .search-btn{
                    border-top-right-radius: 25px;
                    border-bottom-right-radius: 25px;
                    background: #fb246a;
	                color:white;
	                display: inline-block;
	                padding: 18px 44px;
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
                                <h2>Resumes</h2>
                                <form class="d-flex mt-4" method="GET" action="resumes.php">
                                <button class="icon-btn" type="button" disabled><i class="fa-solid fa-magnifying-glass"></i></button>
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

// Base query
$sql = "SELECT * FROM applications WHERE recruiter_id = '$recruiter_id'";

// Check if the search keyword is set and not empty
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchKeyword = mysqli_real_escape_string($conn, $_GET['search']);
    // Add an additional condition for searching by firstname
    $sql .= " AND firstname LIKE '%$searchKeyword%'";
}

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if results are found
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="mt-3 ml-3 mr-3 mb-3" style="border-radius:5px;">
            <div class="card" style="width: 11rem; height:15rem;">
                <embed src="/e-recruitment/cv/<?php echo $row['resume']; ?>" type="application/pdf" width="100%" height="200px" />
                <div class="card-body" style="border-top:1px solid rgba(0, 0, 0, .125); height: 70px;">
                    <span class="row">
                        <p style="font-size: 12px; width:80px;"> <?php echo $row['firstname']; ?></p>
                        <span>
                            <span class="ml-2">
                                <img src="assets/img/go-to.png" style="width: 15px; margin-top:-7px; cursor:pointer;" alt="">
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
        <!-- Job List Area End -->
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