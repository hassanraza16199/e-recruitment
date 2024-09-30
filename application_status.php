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
                                <h2>Application Status</h2>
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
    <?php
    include "connection.php";
        $application_id = $_GET['application_id'];
        
                    
                    $sql = "SELECT * FROM applications WHERE application_id = '$application_id' ";
                    $result = mysqli_query($conn, $sql);

                    
                    if (mysqli_num_rows($result)>0) {
                        while($row = mysqli_fetch_assoc($result)){
                        ?>
    <form action="application_status.php?application_id=<?php echo $_GET['application_id']; ?>" method="POST" enctype="multipart/form-data" >

        <div class="row mb-2">
            <div class="col-md-6">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname'];?>" disabled>
            </div>
            <div class="col-md-6">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname'];?>" disabled>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email_address" name="email_address" value="<?php echo $row['email_address'];?>" disabled>
        </div>

        <div class="form-group">
            <label for="cnic">CNIC</label>
            <input type="number" class="form-control" id="cnic" name="cnic" value="<?php echo $row['cnic'];?>" disabled>
        </div>

        <div class="form-group">
            <label for="contactNumber">Contact Number</label>
            <input type="text" class="form-control" id="contact_number" name="contact_number"value="<?php echo $row['contact_number'];?>" disabled>
        </div>

        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" id="date_birth" name="date_birth" value="<?php echo $row['date_birth'];?>" disabled>
        </div>

        <div class="form-group">
            <label for="country">Country of Residence</label>
            <input type="text" class="form-control" id="country" name="country" value="<?php echo $row['country'];?>" disabled>
        </div>

        <div class="form-group">
            <label for="candidate_education">Education</label>
            <textarea type="text" class="form-control" rows="4" id="candidate_education" name="candidate_education" disabled><?php echo $row['candidate_education'];?></textarea>
        </div>

        <div class="form-group">
            <label for="candidate_skill">Skills</label>
            <textarea type="text" class="form-control" rows="4" id="candidate_skill" name="candidate_skill" disabled><?php echo $row['candidate_skill'];?></textarea>
        </div>

        <div class="form-group">
            <label for="candidate_experience">Experience</label>
            <textarea type="text" class="form-control" rows="1" id="candidate_experience" name="candidate_experience" disabled><?php echo $row['candidate_experience'];?></textarea>
        </div>

        <div class="form-group">
            <label  class="form-label">Status</label>
                    <select class="form-select mb-4" name="categories" id="categories" >
                        <option selected disabled>Select Application Status</option>
                        <option value="View">View</option>
                        <option value="Approve">Approve</option>
                        <option value="Pending">Pending</option>
                        <option value="Shortlist">Shortlist</option>
                        <option value="Cancel">Cancel</option>
                    </select>
        </div>

        <button type="submit"  name='submit' class="btn head-btn2 mt-3">Submit</button>
    </form>
    <?php 
                        }
                    }
                    ?>
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