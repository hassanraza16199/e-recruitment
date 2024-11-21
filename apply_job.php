<?php
session_start();
include "connection.php";

if (!isset($_SESSION['name'])) {
    echo "<script>alert('Access Denied! Please login first.');</script>";
    exit;
}

$resume_upload = 0;

if(isset($_POST['submit'])) {
    if (isset($_GET['job_id'])) {
        $job_id = $_GET['job_id'];
        $recruiter_id = $_GET['recruiter_id'];
        $job_title = $_GET['job_title'];
    } else {
        echo "No job ID specified.";
        exit;
    }
    
    $candidate_id = $_SESSION['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $cnic = $_POST['cnic'];
    $email_address = $_POST['email_address'];
    $contact_number = $_POST['contact_number'];
    $date_birth = $_POST['date_birth'];
    $country = $_POST['country'];
    $candidate_education = $_POST['candidate_education'];
    $candidate_skill = $_POST['candidate_skill'];
    $candidate_experience = $_POST['candidate_experience'];
    $date = date('Y-m-d');

    $resume = time().$_FILES['resume']['name'];
    
    if(move_uploaded_file($_FILES['resume']['tmp_name'], $_SERVER['DOCUMENT_ROOT']. '/e-recruitment/cv/' . $resume)){
        $target_file = $_SERVER['DOCUMENT_ROOT']. '/e-recruitment/cv/' . $resume;
        $resumefiletype = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $resumename = basename($_FILES['resume']['name']);
        $resumefile = time().$resumename;

        if($resumefiletype != "pdf" ){
            echo "<script> alert('Check extension.')</script>";
        }else if($_FILES['resume']['size'] > 50000000){
            echo "<script> alert('image exceed the size.')</script>";
        }else{
            $resume_upload = 1;
        }
    }
    if($resume_upload == 1){
        $sql = "INSERT INTO applications (candidate_id, job_id, recruiter_id, job_title, firstname, lastname, cnic, email_address, contact_number, date_birth, city, candidate_education, candidate_skill, candidate_experience, resume, date)
                VALUES ('$candidate_id', '$job_id', '$recruiter_id', '$job_title', '$firstname', '$lastname', '$cnic', '$email_address', '$contact_number', '$date_birth', '$city', '$candidate_education', '$candidate_skill', '$candidate_experience', '$resumefile', '$date')";
        
        $count_sql = "SELECT COUNT(*) AS total FROM applications";
        $count_result = $conn->query($count_sql);
        $count_row = $count_result->fetch_assoc();
        $total_application_entries = $count_row['total'];
        if ($conn->query($sql) === TRUE) {
            
            $_SESSION['apply_success'] = true;
            header("Location: feedback.php?job_id=$job_id&recruiter_id=$recruiter_id&job_title=$job_title");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }    
    }
        $conn->close();
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
            <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
            <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            
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
                                <h2>Apply for Job</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
        
        <div class="form-container">
        <h2>Application Form</h2>
        <form action="apply_job.php?job_id=<?php echo $_GET['job_id']; ?>&recruiter_id=<?php echo $_GET['recruiter_id']; ?>&job_title=<?php echo $_GET['job_title'];?>" method="POST" enctype="multipart/form-data" >

        <div class="row mb-2">
            <div class="col-md-6">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" >
            </div>
            <div class="col-md-6">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" >
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email_address" name="email_address">
        </div>

        <div class="form-group">
            <label for="cnic">CNIC</label>
            <input type="number" class="form-control" id="cnic" name="cnic">
        </div>

        <div class="form-group">
            <label for="contactNumber">Phone No</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number">
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" id="date_birth" name="date_birth">
        </div>

        <div class="form-group">
            <label for="City">City</label>
            <input type="text" class="form-control" id="city" name="city">
        </div>

        <div class="form-group">
            <label for="candidate_education">Education</label>
            <select class="form-select mb-4" name="candidate_education" id="candidate_education" >
                <option selected disabled>Select Education</option>
                <option value="Intermediate">Intermediate</option>
                <option value="B.com">B.com</option>
                <option value="Bachelor\'s Degree(BS)">Bachelor\'s Degree(BS)</option>
                <option value="Associate Degree">Associate Degree</option>
                <option value="Doctorate">Doctorate</option>
            </select>
        </div>

        <div class="form-group">
            <label for="candidate_skill">Skills</label>
            <textarea type="text" class="form-control" rows="4" id="candidate_skill" name="candidate_skill"></textarea>
        </div>

        <div class="form-group">
            <label for="candidate_experience">Experience</label>
            <select class="form-select mb-4" name="candidate_experience" id="candidate_experience" >
                <option selected disabled>Select Experience</option>
                <option value="1 year">1 year</option>
                <option value="2 year">2 year</option>
                <option value="3 year">3 year</option>
                <option value="4 year">4 year</option>
                <option value="4+ year">4+ year</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label  class="form-label">Upload Resume</label><br>
            <input type="file" class="form-control" accept=".pdf" id="resume" name="resume" >
        </div>

        <button type="submit"  name='submit' class="btn head-btn2 mt-3">Submit</button>
    </form>
</div>
        </div>
        <!-- Job List Area End -->
    </main>

    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE876;</i>
                    </div>
                    <h4 class="modal-title">Awesome!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Your Job has been apply successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>


    <?php include "footer.php"; ?>
    
    <script>
        $(document).ready(function() {
    <?php if(isset($_SESSION['apply_success']) && $_SESSION['apply_success'] === true): ?>
        $('#myModal').modal('show'); // Show the success modal

        // Redirect after showing the modal
        setTimeout(function(){
            window.location.href = 'job_listing.php'; // Ensure the URL is correct
        }, 3000);

        <?php unset($_SESSION['apply_success']); // Clear session flag after the modal is shown ?>
    <?php endif; ?>
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