<?php
session_start();
include "connection.php";

if(isset($_POST['submit'])){
    if(isset($_GET['application_id'])){
        $application_id = $_GET['application_id'];
    }
    $status = $_POST['status'];
    $sql = "UPDATE applications SET status = '$status' WHERE application_id = '$application_id'";

    if($conn->query($sql) === True){
         // Prepare notification message
         $recruiter_id = $_SESSION['id'];
         $recruiter_name = $_SESSION['name'];
         $notification_title = "Status";
         $message = " Your job application against $job_title has been approved by the $recruiter_name.";
         
         // Insert notification data
         $notification_sql = "INSERT INTO notification (job_or_status_id, recruiter_id, candidate_id, notification_title, message, created_at) 
                              VALUES ('$application_id', '$recruiter_id', '$candidate_id', '$notification_title', '$message', '".date('Y-m-d h:i:s')."')";
         
         if ($conn->query($notification_sql) === TRUE) {
             header("location: application_status.php?application_id=$application_id");
             exit;
         } else {
             echo "Error: " . $notification_sql . "<br>" . $conn->error;
         }
        
    }
}
if (isset($_POST['schedule'])) {
    $application_id = $_POST['application_id'];
    $interview_date = $_POST['interview_date'];
    $meeting_link = $_POST['meeting_link'];
    
    // Split the selected value into interviewer_id and interview_time
    $interview_selection = explode('|', $_POST['interview_time']);
    $interviewer_id = $interview_selection[0];
    $interview_time = $interview_selection[1];

    $sql = "INSERT INTO interview_schedule (application_id, interview_time, interviewer_id, interview_date, meeting_link)
            VALUES ('$application_id', '$interview_time', '$interviewer_id', '$interview_date', '$meeting_link')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['interview_scheduled'] = true;
    $_SESSION['application_id'] = $application_id;
    $_SESSION['email_status'] = "success";
    $_SESSION['message'] = "Interview Scheduled Successfully!";
    header("Location: application_status.php?application_id=$application_id");
    exit;
}
 else {
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
        <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            .form-container {
                max-width: 800px;
                margin: 40px auto;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .main-div {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                margin: 0 auto;
                max-width: 1200px;
                padding: 20px;
            }

            .detail-div, .status-div {
                background: #f9f9f9;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 48%;
            }

            .detail-div h2, .status-div h2 {
                font-size: 24px;
                margin-bottom: 20px;
                color: #333;
            }

            .detail-div p, .status-div p {
                font-size: 16px;
                margin-bottom: 10px;
                color: #555;
            }

            .status-div form select {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                margin-bottom: 15px;
            }

            /* Modal Styling */
            .modal-content {
                background-color: #f9f9f9;
                border-radius: 10px;
                padding: 20px;
            }

            .modal-header {
                border-bottom: 1px solid #ddd;
                margin-bottom: 10px;
            }

            .modal-title {
                font-size: 20px;
                color: #333;
            }

            .modal-body {
                padding: 20px;
            }

            .modal-body .form-group label {
                color: #555;
                font-size: 14px;
                margin-bottom: 5px;
            }

            .email-btn{
                margin-left:150px;
            }
            /* Ensure the email modal is on top by giving it a higher z-index */
            #emailModal {
                    z-index: 1051; /* Default Bootstrap modals have a z-index of 1050 */
                }

                #scheduleModal {
                    z-index: 1050; /* This will appear below the email modal */
                }
            /* Responsive Styling */
            @media (max-width: 768px) {
                .main-div {
                    flex-direction: column;
                }

                .detail-div, .status-div {
                    width: 100%;
                }

                .status-div button {
                    width: 100%;
                }
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
        </style>

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
                                    <h2>Application Detail</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Area End -->

            <!-- Alert Area Start -->
            <?php if(isset($_SESSION['email_status'])) { ?>
                <div class="alert alert-<?php echo $_SESSION['status']; ?> alert-dismissible fade show mt-2" role="alert">
                    <?= $_SESSION['message'] ?>
                    <?= $_SESSION['error'] ?? '' ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php unset($_SESSION['email_status']); unset($_SESSION['status']); unset($_SESSION['message']); unset($_SESSION['error']); } ?>
            <!-- Alert Area End -->

            <!-- Job List Area Start -->
            <div class="job-listing-area pt-120 pb-120">
                <div class="main-div">
                    <div class="detail-div">
                        <h2>Application Detail</h2>
                    <?php
                    include "connection.php";
                    $application_id = $_GET['application_id'];
                    
                                
                    $sql = "SELECT * FROM applications WHERE application_id = '$application_id' ";
                    $result = mysqli_query($conn, $sql);

                    
                    if (mysqli_num_rows($result)>0) {
                        while($row = mysqli_fetch_assoc($result)){
                            $email_address = $row['email_address'];
                            $candidate_id = $row['candidate_id'];
                            $status = $row['status'];
                            $job_title = $row['job_title'];
                        ?>
                        <div class="row">
                            <div class="ml-3 mr-5">
                                <p><span style="font-weight:bold;">First Name </span>: <?php echo $row['firstname'];?></p>
                            </div>
                            <div class="ml-5">
                                <p><span style="font-weight:bold;">Last Name </span>: <?php echo $row['lastname'];?></p>
                            </div>
                        </div>
                        <div>
                            <p><span style="font-weight:bold;">Email Address </span>: <?php echo $row['email_address'];?></p>
                        </div>
                        <div >
                            <p><span style="font-weight:bold;">CNIC </span>: <?php echo $row['cnic'];?></p>
                        </div>
                        <div >
                            <p><span style="font-weight:bold;">Phone NO </span>: <?php echo $row['contact_number'];?></p>
                        </div>
                        <div >
                            <p><span style="font-weight:bold;">Date of Birth </span>: <?php echo $row['date_birth'];?></p>
                        </div>
                        <div >
                            <p><span style="font-weight:bold;">Education </span>: <?php echo $row['candidate_education'];?></p>
                        </div>
                        <div >
                            <p><span style="font-weight:bold;">Skill </span>: <?php echo $row['candidate_skill'];?></p>
                        </div>
                        <div >
                            <p><span style="font-weight:bold;">Experience </span>: <?php echo $row['candidate_experience'];?></p>
                        </div>
        
                        <?php 
                                }
                            }
                        ?>
                    </div>
                    <div class="status-div">
                        <div style="display:flex; margin-bottom:20px;">
                            <h2>Application Status</h2>
                            <?php if ($status === 'Hired') { ?>
                                <span class="email-btn">
                                    <button class="btn head-btn1" data-toggle="modal" data-target="#emailModal">Email</button>
                                </span>
                            <?php }elseif($status === 'Rejected'){ ?>
                                <span class="email-btn">
                                    <button class="btn head-btn1" data-toggle="modal" data-target="#emailModal">Rejected Email</button>
                                </span>
                            <?php }elseif($status === 'Technical Interviewing'){?>
                                <span class="email-btn">
                                    <button class="btn head-btn1" data-toggle="modal" data-target="#scheduleModal">Schedule Interview</button>
                                </span>
                            <?php } elseif($status === 'Final Interview'){?>
                                <span class="email-btn">
                                    <button class="btn head-btn1" data-toggle="modal" data-target="#scheduleModal">Schedule Final Interview</button>
                                </span>
                            <?php } ?>
                        </div>
                        
                        <form action="application_status.php?application_id=<?php echo $_GET['application_id']; ?>" method="POST" enctype="multipart/form-data" >
                            <div class="form-group mb-5">
                                <label  class="form-label">Status</label>
                                <select class="form-select mb-4" name="status" id="status" >
                                    <option selected disabled>Select Application Status</option>
                                    <option value="Pending" <?php if($status =='Pending') echo'selected'; ?>>Pending</option>
                                    <option value="Initial Screening" <?php if($status =='Initial Screening') echo'selected'; ?>>Initial Screening</option>
                                    <option value="Technical Interviewing" <?php if($status =='Technical Interviewing') echo'selected'; ?>>Technical Interviewing</option>
                                    <option value="Final Interview" <?php if($status =='Final Interview') echo'selected'; ?>>Final Interview</option>
                                    <option value="Shortlist" <?php if($status =='Shortlist') echo'selected'; ?>>Shortlist</option>
                                    <option value="Hired" <?php if($status =='Hired') echo'selected'; ?>>Hired </option>
                                    <option value="Rejected" <?php if($status =='Rejected') echo'selected'; ?>>Rejected </option>
                                </select>
                            </div>
                            <button style="display:flex;" type="submit"  name='submit' class="btn head-btn2 mt-5">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Job List Area End -->
        </main>

        <!-- Email Modal -->
        <div id="emailModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog " role="document">
                <div class="modal-content" style='margin-top:120px;'>
                    <div class="modal-header">
                        <h5 class="modal-title">Send Email</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="functions.php" method="POST">
                            <div id="validationAlert" class="alert alert-danger d-none">All fields are required!</div>
                            <input type="hidden" class="form-control" id="application_id" name="application_id" value="<?php echo $application_id; ?>" readonly>
                            <div class="form-group">
                                <label for="to_email">To:</label>
                                <input type="email" class="form-control" id="to_email" name="to_email" value="<?php echo $email_address; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject:</label>
                                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $status; ?>">
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="emailBody" name="message" rows="4"></textarea>
                            </div>
                            <button type="submit" name="send_email" id="send_email" class="btn btn-primary">Send Email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<!-- Schedule Interview Modal -->
<div id="scheduleModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content" style='margin-top:110px; margin-left:-50px; width:650px;'>
            <div class="modal-header">
                <h5 class="modal-title">Schedule Interview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="scheduleInterviewForm" action="application_status.php" method="POST">
                    <input type="hidden" class="form-control" id="application_id" name="application_id" value="<?php echo $application_id; ?>" readonly>

                    <div class="form-group mb-5">
                        <label for="interview_time">Interview Time:</label>
                        <select class="form-select" name="interview_time" id="interview_time">
                            <option value="" disabled selected>Select interview Schedule</option>
                        <?php
                            include "connection.php";

                            if($status =='Technical Interviewing'){ 
                                $sql = "SELECT * FROM interviewer";
                                $inter_name = "Interviewer Name";
                                $interviewer_id = $row['id'];

                            } elseif($status =='Final Interview'){ 
                                $sql = "SELECT * FROM hiring_managers";
                                $inter_name = "Manager Name";
                                $interviewer_id = $row['id'];
                            }

                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {?>
                            <option value="<?php echo $row['id'] . '|' . $row['avalibility']; ?>">
                                <?php echo $inter_name . ": " . $row['name'] . " | Category: " . $row['designation'] . " | Availability: " . $row['avalibility']; ?>
                            </option>
                            <?php 
                                }
                            }?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="interview_date">Interview Date:</label>
                        <input type="date" class="form-control" id="interview_date" name="interview_date" required>
                    </div>

                    <div class="form-group">
                        <label for="Meeting_link">Meetinglink:</label>
                        <input type="text" class="form-control" id="meeting_link" name="meeting_link" placeholder="Enter Interview Meeting Link" required>
                    </div>
                    <button type="submit" name="schedule" class="btn btn-primary">Schedule Interview</button>

                    <?php if(isset($_SESSION['interview_scheduled'])) { ?>
                        <!-- Show email button after interview is scheduled -->
                        <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#emailModal">Send Interview Details Email</button>
                    <?php } ?>
                </form> 
            </div>
        </div>
    </div>
</div>

        <?php include "footer.php"; ?>
        <script src="vendor/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#emailBody',
                license_key: 'gpl'
            });

            $(document).ready( function() {
                $("#send_email").on('click', function(e) {
                    const editor = tinymce.get('emailBody');
                    const content = editor.getContent({ format: 'text' }).trim();
                    if($("#subject").val() == '' || content === '') {
                        e.preventDefault();
                        $("#validationAlert").removeClass('d-none');
                    } else {
                        $("#validationAlert").addClass('d-none');
                    }
                });
            });
            <?php
if (isset($_SESSION['interview_scheduled'])) {
    echo "<script>console.log('Modal will open. Session is set.')</script>";
?>
    <script>
        $(document).ready(function () {
            console.log('Opening modal...');
            $('#scheduleModal').modal('show');
        });
    </script>
<?php
    unset($_SESSION['interview_scheduled']);
} ?>

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