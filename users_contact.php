<?php
session_start();
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $contact_id = $_POST['contact_id'];

    // Correcting the SQL query to delete from the `contact_us` table
    $sql = "DELETE FROM contact_us WHERE contact_id = '$contact_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: users_contact.php"); // Redirect to the same page after deletion
        exit();
    } else {
        echo "Error: " . $conn->error; // Display an error message if the query fails
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
		<!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/price_rangs.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <style>
                .message-cell {
    max-width: 250px; /* Adjust the width according to your design */
    word-wrap: break-word; /* Break long words */
    white-space: pre-wrap; /* Preserve white spaces and wrap text */
    overflow-wrap: break-word; /* Break long words if necessary */
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
    width: 100px;
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
                                <h2>Users Contact</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
    <main class="ml-5 mr-5 mt-5 mb-5">
        
        <h2 class="mt-3 mb-3">Users Contact</h2>
        <hr>
        <table class="table">
  <thead>
    <tr>
    <th scope="col">Sr</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php

$sql = "SELECT * FROM contact_us";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result)>0) {
    while($row = mysqli_fetch_assoc($result)) {
        $sender_email = $row['sender_email'];
        $subject = $row['subject'];
        $contact_id = $row['contact_id'];
?>
    <tr>
      <th scope="row"><?php echo $contact_id; ?></th>
      <td><?php echo $row['user_name']; ?></td>
      <td><?php echo $sender_email; ?></td>
      <td><?php echo $subject; ?></td>
      <td class="message-cell"><?php echo $row['message']; ?></td>
      <td>
      
            <?php 
             if($_SESSION['user_type'] === 'Recruiter') { ?>
             <button style="border:none; background-color:#fff;" onclick="openModal('<?php echo $contact_id; ?>', '<?php echo $sender_email; ?>', '<?php echo $subject; ?>')">
    <div class="tooltip-container">
        <span class="tooltip-icon"><i class="fa-solid fa-reply fa-lg" style="color: #35D7FF;"></i></span>
        <div class="tooltip-text">
           Reply 
            <div class="tooltip-arrow"></div>
        </div>
    </div>
</button>


            <?php
            } else { ?>
            <form action="users_contact.php" method="POST" style="display:inline;">
            <input type="hidden" name="contact_id" value="<?php echo $row['contact_id']; ?>">
               <button type="submit" style="border:none; background:none;">
                
                <div class="tooltip-container">
                <span class="tooltip-icon"><i class="fa-solid fa-trash fa-lg" style="color:#FF0000; cursor: pointer;"></i></span>
                <div class="tooltip-text">
                    <!-- Replace the SVG with your text -->
                    Delete 
                <div class="tooltip-arrow"></div>
            </div>
            </button>
        </form>
            <?php
            } ?>
        
    </td>
    </tr>
<?php
    }
}

?>

  </tbody>
</table>

    </main>

<!-- Email Modal (single modal outside loop) -->
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
                <form action="users_contact.php" method="POST">
                    <input type="hidden" class="form-control" id="modal_contact_id" name="contact_id">
                    <div class="form-group">
                        <label for="modal_sender_email">To:</label>
                        <input type="email" class="form-control" id="modal_sender_email" name="sender_email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="modal_subject">Subject:</label>
                        <input type="text" class="form-control" id="modal_subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="modal_message">Message:</label>
                        <textarea class="form-control" id="modal_message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" name="send_email" class="btn btn-primary">Send Email</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php include "footer.php"; ?>
  <!-- JS here -->
  <script>
function openModal(contact_id, sender_email, subject) {
    // Set the modal fields dynamically
    document.getElementById('modal_contact_id').value = contact_id;
    document.getElementById('modal_sender_email').value = sender_email;
    document.getElementById('modal_subject').value = subject;

    // Show the modal
    $('#emailModal').modal('show');
}
</script>

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