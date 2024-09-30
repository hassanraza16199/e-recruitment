<?php

session_start();
include "connection.php";

if (isset($_GET['application_id'])) {
    $application_id = intval($_GET['application_id']);

    $sql = "DELETE FROM applications WHERE application_id = $application_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: applications.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
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
    width: 150px;
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
            /* The Modal (background) */
            .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    display: flex;
    align-items: center;
    justify-content: center;
}
.modal-content {
    background-color: #fefefe;
    margin-top:20px;
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Default width for larger screens */
    max-width: 600px; /* Maximum width */
    max-height: 90vh; /* Set maximum height for the modal */
    overflow-y: auto; /* Enable scrolling for modal content */
    margin: auto; /* Center horizontally */
    box-sizing: border-box;
    border-radius: 8px;
}
@media (max-width: 768px) {
    .modal-content {
        width: 80%; /* Adjust width for tablets */
    }
}
@media (max-width: 480px) {
    .modal-content {
        width: 90%; /* Adjust width for mobile devices */
        padding: 15px;
    }
}
/* The Close Button */
.close {
    position: absolute;
    top: 10px;
    right: 20px;
    color: #aaa;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}
.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
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
                                <h2>Applications</h2>
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
                <h3>Applications</h3>
                <table class="table w-100">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">CNIC</th>
      <th scope="col">Contact</th>
      <th scope="col">Date of Birth</th>
      <th scope="col">Country</th>
      <th scope="col">Resume</th>
      <?php
      if($_SESSION['user_type'] === 'admin'){ ?>
        <th scope="col" colspan="2"><center>Action</center></th>
      <?php } else { ?>
        <th scope="col" >Action</th>
      <?php }?>
      
    </tr>
  </thead>
  <tbody>
  <?php
include "connection.php";
if($_SESSION['user_type'] === 'Recruiter'){
$recruiter_id = $_SESSION['id'];

// Base query
$sql = "SELECT * FROM applications WHERE recruiter_id = '$recruiter_id'";
}elseif($_SESSION['user_type'] === 'admin'){

    $sql = "SELECT * FROM applications";
}
// Execute the query
$result = mysqli_query($conn, $sql);

// Check if results are found
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $application_id = $row['application_id'];
        $candidate_education = $row['candidate_education'];
        $candidate_skill = $row['candidate_skill'];
        $candidate_experience = $row['candidate_experience'];
?>
    <tr data-education="<?php echo $candidate_education; ?>" 
    data-skill="<?php echo $candidate_skill; ?>" 
    data-experience="<?php echo $candidate_experience; ?>" >
      <th scope="row"><?php echo $row['application_id']; ?></th>
      <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
      <td><?php echo $row['email_address']; ?></td>
      <td><?php echo $row['cnic']; ?></td>
      <td><?php echo $row['contact_number']; ?></td>
      <td><?php echo $row['date_birth']; ?></td>
      <td><?php echo $row['country']; ?></td>
      <td>
        <div class="tooltip-container ml-2">
                <span class="tooltip-icon"><i class="fa-regular fa-file open-pdf" data-pdf="/e-recruitment/cv/<?php echo $row['resume']; ?>" style="color:#010b1d; cursor: pointer;"></i></span>
                <div class="tooltip-text">
                    <!-- Replace the SVG with your text -->
                    Preview Resume 
                <div class="tooltip-arrow"></div>
            </div>
      </td>
      <td>
        <div class="tooltip-container ml-2">
                <span class="tooltip-icon"><a href="application_status.php?application_id=<?php echo $application_id; ?>"><i class="fa-regular fa-eye "  style="color:#010b1d; cursor: pointer;"></i></a></span>
                <div class="tooltip-text">
                    <!-- Replace the SVG with your text -->
                    View Application 
                <div class="tooltip-arrow"></div>
            </div>
    </td>
        <td>
                <?php
                if($_SESSION['user_type'] === 'admin'){
                    ?>
                <div class="tooltip-container ml-2">
                <span class="tooltip-icon"><i id ="delete-<?php echo $row['application_id']; ?>" class="fa-solid fa-trash" style="color:#FF0000; cursor: pointer;"></i></span>
                <div class="tooltip-text">
                    <!-- Replace the SVG with your text -->
                    Delete 
                <div class="tooltip-arrow"></div>
            </div>
            <?php } ?>
      </td>
    </tr>
    <?php
    }
}
?>
  </tbody>
</table>
            </div>
        </div>
        <!-- Job List Area End -->
    </main>


<!-- Modal for displaying the PDF -->
<div id="pdfModal" class="modal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; background-color:rgba(0, 0, 0, 0.5);">
    <div class="modal-content mt-2" style="margin:auto; background-color:white; padding:61px; width:100%; height:100%;">
        <span id="closeModal" style="float:right; cursor:pointer; position: absolute; top: 10px; right: 20px; font-size:24px;">&times;</span>
        <embed id="pdfViewer" src="" type="application/pdf" width="110%" height="100%" />
    </div>
</div>

    <?php include "footer.php"; ?>
    
    <script>
    document.querySelectorAll('.fa-trash').forEach(function(deleteBtn) {
        deleteBtn.onclick = function(event) {
            var userApplicationId = event.target.id.split('-')[1];
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "applications.php?application_id=" + userApplicationId;
            }
        };
    });



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