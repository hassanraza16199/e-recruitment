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
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/fav.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="assets/css2/aplication.css">

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
        <div class="job-listing-area pt-120 pb-120 ml-5 mr-5">
            <div class="form-container ">
                <div class="head-bar">
                    <h3>Applications</h3>
                    <div class="filter-side">
                        <p class="filter" id="filter-button">
                            Filters<img src="assets/img/filter.png" width="16px" alt="">
                        </p>
                        <a href="<?php 
                            // Check if there are any search parameters
                            if (!empty($_GET['candidate_education']) || !empty($_GET['candidate_skill']) || !empty($_GET['candidate_experience'])) {
                                // If there are search parameters, export with filters
                                echo "export_application.php?candidate_education=" . urlencode($_GET['candidate_education']) . 
                                 "&candidate_skill=" . urlencode($_GET['candidate_skill']) . 
                                "&candidate_experience=" . urlencode($_GET['candidate_experience']);
                            } else {
                                // If no search parameters, export all applications
                                echo "export_application.php";
                            }
                            ?>">
                            <button>Export</button>
                        </a>
                        
                    </div>
                </div>
                <div class="filter-dropdown" id="filter-dropdown">
                    <div class="filter-div">
                        <p class="rest"><a >FILTERS</a></p>
                        <form  action="applications.php" method="GET" id="filterForm">
                            <div id="education-field mt-2" >
                                <label for="Experience">Education:</label> <br>
                                <input type="text" class="form-control" id="candidate_education" name="candidate_education" placeholder="Enter the education">
                            </div>
                            <div id="skills-field mt-2" >
                                <label for="Skills">Skills:</label><br>
                                <input type="text" class="form-control" id="candidate_skill" name="candidate_skill" placeholder="Enter the Skills">
                            </div>
                            <div id="experience-field mt-2">
                                <label for="Experience">Experience:</label><br>
                                <input type="text" id="candidate_experience" name="candidate_experience" class="form-control" placeholder="Enter the Experience">
                            </div>
                            <button class="form-control btn mt-3">Apply</button>
                        </form>
                    </div>
                </div>
            </div>
                
                <table class="table w-100">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Education</th>
      <th scope="col">Skill</th>
      <th scope="col">Experience</th>
      <th scope="col">Job type</th>
      <th scope="col">Status</th>
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

$filters = [];

// Check if a filter is set and build the query conditionally
if (isset($_GET['candidate_education']) && !empty($_GET['candidate_education'])) {
    $education = mysqli_real_escape_string($conn, $_GET['candidate_education']);
    $filters[] = "candidate_education LIKE '%$education%'";
}

if (isset($_GET['candidate_skill']) && !empty($_GET['candidate_skill'])) {
    $skill = mysqli_real_escape_string($conn, $_GET['candidate_skill']);
    $filters[] = "candidate_skill LIKE '%$skill%'";
}

if (isset($_GET['candidate_experience']) && !empty($_GET['candidate_experience'])) {
    $experience = mysqli_real_escape_string($conn, $_GET['candidate_experience']);
    $filters[] = "candidate_experience LIKE '%$experience%'";
}

// Base query
if ($_SESSION['user_type'] === 'Recruiter') {
    $recruiter_id = $_SESSION['id'];
    $sql = "SELECT * FROM applications WHERE recruiter_id = '$recruiter_id'";
} elseif ($_SESSION['user_type'] === 'admin') {
    $sql = "SELECT * FROM applications";
}

// Append filters if there are any
if (!empty($filters)) {
    $sql .= " AND " . implode(' AND ', $filters);
}

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if results are found
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $application_id = $row['application_id'];
?>
    <tr>
      <th scope="row"><?php echo $row['application_id']; ?></th>
      <td><?php echo $row['firstname'] . ' ' . $row['lastname'] ; ?></td>
      <td><?php echo $row['email_address']; ?></td>
      <td><?php echo $row['candidate_education']; ?></td>
      <td><?php echo $row['candidate_skill']; ?></td>
      <td><?php echo $row['candidate_experience']; ?></td>
      <td><?php echo $row['job_title']; ?></td>
      <td><?php echo $row['status']; ?></td>
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


    <script src="./assets/js/multi-select.js"></script>
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