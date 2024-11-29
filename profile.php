<?php
session_start();
include "connection.php";
if (!isset($_SESSION['name'])) {
    echo "<script>alert('Access Denied! Please login first.');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['rest'])) {
    $id = $_SESSION['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];

    $sql = "UPDATE user SET name='$name', email='$email', birthdate='$birthdate', city='$city', phone='$phone' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['city'] = $city;
        $_SESSION['phone'] = $phone;
        $_SESSION['birthdate'] = $birthdate;

        header("Location: profile.php?action=profile_updated");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

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
                header("Location: profile.php?action=password_changed");
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
            .modal-content {
            background-color: #fefefe;
            margin: 170px auto; /* Centers the modal with a top margin of 150px */
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            max-width: 600px; /* Ensures it doesn't get too wide on larger screens */
            }
            .content-container{
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            .pag-nav button {
            background-color:#fff;
            color:#fb246a;
            border:none;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            }

            .pag-nav button.active {
            border-bottom:4px solid #fb246a;
            border-top:none;
            color:#fb246a;
            }

            .content-section {
            margin-top: 20px;
            display: none;
            }

            .content-section.active {
            display: block;
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
    
    
        <section class="contact-section">
            <div class="container">
                <div class="ml-5 ">
                    <div class="pag-nav">
                        <button id="nav-profile" class="active">Profile</button>
                        <button id="nav-change-password">Change Password</button>
                    </div>
                    <div class="content-container pt-20 pb-20 pl-20 pr-20">
                        <div id="edit-profile" class="content-section">
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

                        <div id="change-password" class="content-section" style="display: none;">
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
                           
                </div>
            </div>
        </section>

<!-- Success Modal HTML -->
<div id="successModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <h4 class="modal-title" id="modalTitle">Success!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center pt-10 pb-10" id="modalMessage">Your profile has been updated successfully!</p>
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
document.addEventListener('DOMContentLoaded', () => {
  const navProfile = document.getElementById('nav-profile');
  const navChangePassword = document.getElementById('nav-change-password');
  const editProfileSection = document.getElementById('edit-profile');
  const changePasswordSection = document.getElementById('change-password');

  const toggleActiveSection = (activeNav, activeSection, inactiveSection) => {
    // Update active navigation
    document.querySelectorAll('.pag-nav button').forEach(button => button.classList.remove('active'));
    activeNav.classList.add('active');
    
    // Update content visibility
    activeSection.style.display = 'block';
    inactiveSection.style.display = 'none';
  };

  // Initial load
  toggleActiveSection(navProfile, editProfileSection, changePasswordSection);

  // Click event listeners
  navProfile.addEventListener('click', () => {
    toggleActiveSection(navProfile, editProfileSection, changePasswordSection);
  });

  navChangePassword.addEventListener('click', () => {
    toggleActiveSection(navChangePassword, changePasswordSection, editProfileSection);
  });
});

document.addEventListener('DOMContentLoaded', function() {

    // Form validation for Change Password
    document.getElementById('changePasswordForm').onsubmit = function() {
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        if (newPassword !== confirmPassword) {
            alert('New Password and Confirm Password do not match.');
            return false;
        }
    };
    
});

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');

    if (action) {
        let title = '';
        let message = '';

        if (action === 'profile_updated') {
            title = 'Profile Updated!';
            message = 'Your profile has been updated successfully!';
        } else if (action === 'password_changed') {
            title = 'Password Changed!';
            message = 'Your password has been updated successfully!';
        }

        // Update modal content
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalMessage').textContent = message;

        // Show the modal
        $('#successModal').modal('show');

        // Clean up URL by removing the query parameter
        window.history.replaceState({}, document.title, window.location.pathname);
    }
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