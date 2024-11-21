<?php
session_start();
include "connection.php";
if (!isset($_SESSION['name'])) {
    echo "<script>alert('Access Denied! Please login first.');</script>";
    exit;
}

// Profile update handler
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['rest'])) {
    $id= $_SESSION['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];

    $sql = "UPDATE user SET name='$name', email='$email', birthdate='$birthdate', city='$city', phone='$phone' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        // Update session variables
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['city'] = $city;
        $_SESSION['phone'] = $phone;
        $_SESSION['birthdate'] = $birthdate;

        header("Location: profile.php?success=1");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Password reset handler
if (isset($_POST['rest'])) {
    $id = $_SESSION['id'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];

    $sql = "SELECT * FROM user WHERE id ='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($oldPassword == $row['password']) {
            $sql = "UPDATE user SET password='$newPassword' WHERE id='$id'";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['password_change_success'] = true;
                header("Location: profile.php?password_success=1");
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "<script>alert('Incorrect old password. Please try again.');</script>";
        }
    }
}
?>



<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
     <title>E-Recruitment system </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/fav.png">
   <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slicknav.css">
        <link rel="stylesheet" href="assets/css/price_rangs.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        

        <style>
.profile-info{
    margin-left:10%;
    margin-right:10%;
}
.bio-graph-info h1 {
    font-size: 22px;
    font-weight: 300;
    margin: 0 0 20px;
}

.bio-row {
    width: 50%;
    float: left;
    margin-bottom: 10px;
    padding:0 15px;
}

.bio-row p span {
    width: 100px;
    display: inline-block;
}

.bio-chart, .bio-desk {
    float: left;
}

.bio-chart {
    width: 40%;
}

.bio-desk {
    width: 60%;
}

.bio-desk h4 {
    font-size: 15px;
    font-weight:400;
}

.bio-desk h4.terques {
    color: #4CC5CD;
}

.bio-desk h4.red {
    color: #e26b7f;
}

.bio-desk h4.green {
    color: #97be4b;
}

.bio-desk h4.purple {
    color: #caa3da;
}

.file-pos {
    margin: 6px 0 10px 0;
}

.profile-activity h5 {
    font-weight: 300;
    margin-top: 0;
    color: #c3c3c3;
}

.summary-head {
    background: #ee7272;
    color: #fff;
    text-align: center;
    border-bottom: 1px solid #ee7272;
}

.summary-head h4 {
    font-weight: 300;
    text-transform: uppercase;
    margin-bottom: 5px;
}

.summary-head p {
    color: rgba(255,255,255,0.6);
}

ul.summary-list {
    display: inline-block;
    padding-left:0 ;
    width: 100%;
    margin-bottom: 0;
}

ul.summary-list > li {
    display: inline-block;
    width: 19.5%;
    text-align: center;
}

ul.summary-list > li > a > i {
    display:block;
    font-size: 18px;
    padding-bottom: 5px;
}

ul.summary-list > li > a {
    padding: 10px 0;
    display: inline-block;
    color: #818181;
}

ul.summary-list > li  {
    border-right: 1px solid #eaeaea;
}

ul.summary-list > li:last-child  {
    border-right: none;
}

.activity {
    width: 100%;
    float: left;
    margin-bottom: 10px;
}

.activity.alt {
    width: 100%;
    float: right;
    margin-bottom: 10px;
}

.activity span {
    float: left;
}

.activity.alt span {
    float: right;
}
.activity span, .activity.alt span {
    width: 45px;
    height: 45px;
    line-height: 45px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    background: #eee;
    text-align: center;
    color: #fff;
    font-size: 16px;
}

.activity.terques span {
    background: #8dd7d6;
}

.activity.terques h4 {
    color: #8dd7d6;
}
.activity.purple span {
    background: #b984dc;
}

.activity.purple h4 {
    color: #b984dc;
}
.activity.blue span {
    background: #90b4e6;
}

.activity.blue h4 {
    color: #90b4e6;
}
.activity.green span {
    background: #aec785;
}

.activity.green h4 {
    color: #aec785;
}

.activity h4 {
    margin-top:0 ;
    font-size: 16px;
}

.activity p {
    margin-bottom: 0;
    font-size: 13px;
}

.activity .activity-desk i, .activity.alt .activity-desk i {
    float: left;
    font-size: 18px;
    margin-right: 10px;
    color: #bebebe;
}

.activity .activity-desk {
    margin-left: 70px;
    position: relative;
}

.activity.alt .activity-desk {
    margin-right: 70px;
    position: relative;
}

.activity.alt .activity-desk .panel {
    float: right;
    position: relative;
}

.activity-desk .panel {
    background: #F4F4F4 ;
    display: inline-block;
}

.activity .activity-desk .arrow {
    border-right: 8px solid #F4F4F4 !important;
}
.activity .activity-desk .arrow {
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    display: block;
    height: 0;
    left: -7px;
    position: absolute;
    top: 13px;
    width: 0;
}

.activity-desk .arrow-alt {
    border-left: 8px solid #F4F4F4 !important;
}

.activity-desk .arrow-alt {
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    display: block;
    height: 0;
    right: -7px;
    position: absolute;
    top: 13px;
    width: 0;
}

.activity-desk .album {
    display: inline-block;
    margin-top: 10px;
}

.activity-desk .album a{
    margin-right: 10px;
    
}

.activity-desk .album a:last-child{
    margin-right: 0px;
}

.input-field {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(10%);
    cursor: pointer;
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
.close-model{
    position: absolute;
    top: 10px;
    right: 25px;
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
.close-model:hover,
.close-model:focus{
    color: black;
    text-decoration: none;
}
.modal-confirm {
color: #fb246a;
width: 325px;
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
.close-model{
    position: absolute;
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
#changePasswordBtn{
    margin-left:400px;
}
.modal-content {
    background-color: #fefefe;
    margin: 85px auto; /* Centers the modal with a top margin of 150px */
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    max-width: 600px; /* Ensures it doesn't get too wide on larger screens */
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
                                    <h2>Profile</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Area End -->
    
    <!-- ================ contact section start ================= -->
    <section class="contact-section">
            <div class="container">
                <div class="row ml-5">
                    <div class="col-12">
                        <h2 class="contact-title">Profile</h2>
                    </div>              
                    <div class="profile-info col-md-9">
                        
                        <div class="panel">
                            
                            <div class="panel-body bio-graph-info">
                                
                                <div class="row">
                                    <div class="bio-row">
                                        <p><span style="font-weight:bold;">Name </span>: <?php echo $_SESSION['name'];?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span style="font-weight:bold;">City </span>: <?php echo $_SESSION['city'];?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span style="font-weight:bold;">Date of Birth</span>: <?php echo $_SESSION['birthdate'];?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span style="font-weight:bold;">Email </span>: <?php echo $_SESSION['email'];?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span style="font-weight:bold;">Mobile </span>: <?php echo $_SESSION['phone'];?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span style="font-weight:bold;">Phone </span>: <?php echo $_SESSION['phone'];?></p>
                                    </div>
                                    <div class="bio-row">
                                        <p><span style="font-weight:bold;">Type </span>: <?php echo $_SESSION['user_type'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="mt-5">
                                <button class="btn head-btn1">Update</button>
                                <button class="btn head-btn2" id="changePasswordBtn">Change Password</button>
                            </div>
                            
                        </div>
                    </div>       
                </div>
            </div>
        </section>
    <!-- ================ contact section end ================= -->
<!-- Edit Profile Modal -->
<div id="editProfileModal" class="modal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; overflow:auto; background-color: rgba(0,0,0,0.4);">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Profile</h2>
        <form id="editProfileForm" method="post" action="profile.php">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $_SESSION['name']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo $_SESSION['email']; ?>">
            </div>
            <div class="form-group">
                <label for="birthdate">Date of Birth</label>
                <input type="date" name="birthdate" id="birthdate" class="form-control" value="<?php echo $_SESSION['birthdate']; ?>">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" id="city" class="form-control" value="<?php echo $_SESSION['city']; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $_SESSION['phone']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>


<!-- Success Modal HTML -->
<div id="myModal" class="modal fade" >
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE876;</i>
                    </div>
                    <h4 class="modal-title">Success!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Your profile has been updated successfully!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
<!-- Change Password Modal -->
<div id="changePasswordModal" class="modal" style="display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; overflow:auto; background-color: rgba(0,0,0,0.4);">
    <div class="modal-content">
        <span class="close-model">&times;</span>
        <h2>Change Password</h2>
        <form id="changePasswordForm" method="POST" action="profile.php">
        <input type="hidden" name="id" class="form-control" value="<?php echo $_SESSION['id']; ?>">
            <div class="form-group mt-3">
                <label for="oldPassword">Old Password:</label>
                <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
            </div>

            <div class="form-group">
                <label for="newPassword">New Password:</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
            </div>

            <button type="submit" name="rest" class="btn mt-3">Change Password</button>
        </form>
    </div>
</div>
<!-- Success Modal HTML for Password Change -->
<div id="passwordSuccessModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <h4 class="modal-title">Success!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Your password has been updated successfully!</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


    <?php include "footer.php"; ?>

<!-- JS here -->
<script>

document.addEventListener('DOMContentLoaded', function() {
     // Open Change Password Modal
     document.getElementById('changePasswordBtn').onclick = function() {
        document.getElementById('changePasswordModal').style.display = 'block';
    };

    // Close Change Password Modal
    document.querySelector('#changePasswordModal .close-model').onclick = function() {
        document.getElementById('changePasswordModal').style.display = 'none';
    };

    // Form validation for Change Password
    document.getElementById('changePasswordForm').onsubmit = function() {
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        if (newPassword !== confirmPassword) {
            alert('New Password and Confirm Password do not match.');
            return false;
        }
    };

    // Detect if the modal success message should show
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('password_success')) {
        $('#passwordSuccessModal').modal('show');
        setTimeout(function() {
            window.location.href = 'profile.php?success=1';
        }, 1500);
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == document.getElementById('changePasswordModal')) {
            document.getElementById('changePasswordModal').style.display = 'none';
        }
    };
    
    // Profile Edit Modal Setup
    var editProfileModal = document.getElementById("editProfileModal");
    var openEditProfileBtn = document.querySelector(".btn.head-btn1");
    var closeModalBtns = document.querySelectorAll(".close");

    // Open Edit Profile Modal
    openEditProfileBtn.onclick = function() {
        editProfileModal.style.display = "block";
    };

    // Close Edit Profile Modal
    closeModalBtns.forEach(btn => {
        btn.onclick = function() {
            editProfileModal.style.display = "none";
        };
    });

    // AJAX form submission for editing profile
    $('#editProfileForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: 'profile.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.includes('success')) {
                    $('#editProfileModal').hide(); // Hide modal on success
                    $('#myModal').modal('show');   // Show success modal

                    // Reload the page to display updated session values
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                } else {
                    alert("Failed to update profile: " + response);
                }
            },
            error: function(xhr, status, error) {
                alert("An error occurred: " + error);
            }
        });
    });

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target == editProfileModal) {
            editProfileModal.style.display = "none";
        }
    };
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
		
		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

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