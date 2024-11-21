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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $recruiter_id = $_SESSION['id'];
    $job_id = $_POST['job_id'];

    $job_title = $_POST['job_title'];
    $company_name = $_POST['company_name'];
    $requirements = $_POST['requirements'];
    $company_email = $_POST['company_email'];
    $company_location = $_POST['company_location'];
    $company_web = $_POST['company_web'];
    $salary = $_POST['salary'];
    $timing = $_POST['timing'];
    $categories = $_POST['categories'];
    $discription = $_POST['discription'];
    $experience = $_POST['experience'];
    $due_date = $_POST['due_date'];
    $vacancy = $_POST['vacancy'];
    
    $sql = "UPDATE job_post SET 
        job_title = '$job_title', 
        company_name = '$company_name', 
        requirements = '$requirements', 
        company_email = '$company_email', 
        company_location = '$company_location', 
        company_web = '$company_web', 
        salary = '$salary', 
        timing = '$timing', 
        categories = '$categories', 
        discription = '$discription', 
        experience = '$experience', 
        due_date = '$due_date', 
        vacancy = '$vacancy' 
        WHERE job_id = '$job_id'";

    if ($conn->query($sql) === TRUE) {
        header('location:posted_jobs.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
        /* Add some basic styling to make the form look better */
        .form-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Make the form responsive */
    @media (max-width: 768px) {
        .form-container {
            margin: 20px auto;
        }
        .inputfirst {
            padding-left: 0;
        }
    }

    @media (max-width: 480px) {
        .form-container {
            padding: 10px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        
    }
    .modal-confirm {
color: #fb246a;
width: 325px;
}
.modal-confirm .modal-content {
padding: 20px;
border-radius: 5px;
margin-top:35%;
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
                                <h2>Edit Job</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->

        

        <div class="job-listing-area pt-120 pb-120">
            <div class="ml-5 mr-5">
                <?php

                    
                    if($_GET['job_id']){
                    
                    $job_id = $_GET['job_id'];
                    
                    $sql = "SELECT * FROM job_post WHERE job_id = '$job_id' ";
                    $result = mysqli_query($conn, $sql);

                
                    if (mysqli_num_rows($result)>0) {
                        while($row = mysqli_fetch_assoc($result)){
                        ?>


            <div class="form-container">
        <h2 class="mb-3 ml-4 mr-4">Edit Form</h2>
        <form action="edit_job.php" method="POST" class="">
        <input type="hidden" class="form-control" id="job_id" name="job_id" value="<?php echo $row['job_id']; ?>">

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo $row['job_title']; ?>" required>
                </div>

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo $row['company_name']; ?>" required>
                </div>

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Job Description</label>
                    <input type="text" class="form-control" id="discription" name="discription" value="<?php echo $row['discription']; ?>" required>
                </div>

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Company Email</label>
                    <input type="email" class="form-control" id="company_email" name="company_email" value="<?php echo $row['company_email']; ?>" required>
                </div>

                <div class="mb-1 ml-4 mr-4">
                <label  class="form-label">Categories</label><br>
                <select name="categories" required>
                    <option value="Design & Creative" <?php if ($row['categories'] == 'Design & Creative') echo 'selected'; ?>>Design & Creative</option>
                    <option value="Design & Development" <?php if ($row['categories'] == 'Design & Development') echo 'selected'; ?>>Design & Development</option>
                    <option value="Sales & Marketing" <?php if ($row['categories'] == 'Sales & Marketing') echo 'selected'; ?>>Sales & Marketing</option>
                    <option value="Mobile Application" <?php if ($row['categories'] == 'Mobile Application') echo 'selected'; ?>>Mobile Application</option>
                    <option value="Construction" <?php if ($row['categories'] == 'Construction') echo 'selected'; ?>>Construction</option>
                    <option value="Information Technology" <?php if ($row['categories'] == 'Information Technology') echo 'selected'; ?>>Information Technology</option>
                    <option value="Real Estate" <?php if ($row['categories'] == 'Real Estate') echo 'selected'; ?>>Real Estate</option>
                    <option value="Content Writer" <?php if ($row['categories'] == 'Content Writer') echo 'selected'; ?>>Content Writer</option>
                    <option value="Other" <?php if ($row['categories'] == 'Other') echo 'selected'; ?>>Other</option>
                </select>
                </div><br><br>

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Company URL</label>
                    <input type="text" class="form-control" id="company_web" name="company_web" value="<?php echo $row['company_web']; ?>" required>
                </div>

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Required Knowledge, Skills, and Abilities</label>
                    <textarea type="text" class="form-control" id="requirements" name="requirements" rows="5" required><?php echo $row['requirements']; ?></textarea>
                </div>

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Education + Experience</label>
                    <textarea type="text" class="form-control" id="experience" name="experience" rows="5" required><?php echo $row['experience']; ?></textarea>
                </div>

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Location</label>
                    <input type="text" class="form-control" id="company_location" name="company_location" value="<?php echo $row['company_location']; ?>" required>
                </div>

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Salary</label>
                    <input type="number" class="form-control" id="salary" name="salary" value="<?php echo $row['salary']; ?>" required>
                </div>

                <div class="mb-4 ml-4 mr-4">
                    <label  class="form-label">Job Timing</label><br>
                    <select name="timing" required>
                        <option value="Full Time" <?php if ($row['timing'] == 'Full Time') echo 'selected'; ?>>Full Time</option>
                        <option value="Part Time" <?php if ($row['timing'] == 'Part Time') echo 'selected'; ?>>Part Time</option>
                        <option value="Remote" <?php if ($row['timing'] == 'Remote') echo 'selected'; ?>>Remote</option>
                        <option value="Freelance" <?php if ($row['timing'] == 'Freelance') echo 'selected'; ?>>Freelance</option>
                    </select>
                </div><br>

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Due Date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" value="<?php echo $row['due_date']; ?>" required>
                </div>

                <div class="mb-3 ml-4 mr-4">
                    <label  class="form-label">Vacancy</label>
                    <input type="number" class="form-control" id="vacancy" name="vacancy" value="<?php echo $row['vacancy']; ?>" required>
                </div>
                    
                <div class="form-group mt-4 ml-4">
                    <button type="submit" name="submit" class="button button-contactForm boxed-btn">Edit Job</button>
                </div>
            </form>
        </div>
            <?php
                        }
                } else {
                    echo "<script> alert('Job not found or you don\'t have permission to edit this job.')</script>";
                    exit();
                }
            }
            $conn->close();
            ?>
            </div>
            
        </div>
        <!-- Job List Area End -->
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