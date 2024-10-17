<?php
session_start();
include "connection.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $avalibility = $_POST['avalibility'];
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Update existing record
        $sql = "UPDATE `interviewer` SET `name`='$name', `email`='$email', `designation`='$designation', `avalibility`='$avalibility' WHERE `id`=$id";
    } else {
        // Insert new record
        $sql = "INSERT INTO `interviewer`(`name`, `email`, `designation`, `avalibility`) VALUES ('$name','$email','$designation','$avalibility')";
    }

    if($conn->query($sql) === TRUE){
        header("Location: interviewer.php");
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM interviewer WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: interviewer.php");
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
        <link rel="stylesheet" href="assets/css2/hiring.css">
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

.main-div {
  display: flex;
  flex-direction: column;
  max-width: 1300px;
  padding: 20px;
  margin: 0 60px;
  box-sizing: border-box; /* Ensures padding is included in the element's total width/height */
}

.main-div-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  flex-wrap: wrap; /* Makes it responsive */
}

.add-btn {
  margin-left: auto; /* Aligns the button to the right */
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

/* Mobile and Tablet Responsive Adjustments */
@media (max-width: 992px) {
  .main-div {
      margin: 0 30px; /* Reduce side margins for smaller devices */
  }

  .table {
      width: 100%; /* Ensure table is responsive */
      display: block; /* Make table elements more stackable */
      overflow-x: auto; /* Allow horizontal scroll if needed */
  }
}

/* Responsive Styling */
@media (max-width: 768px) {
  /* Adjust the modal content padding for smaller screens */
  .modal-body {
      padding: 15px;
  }

  .submit {
      margin: 0 auto;
      display: block;
  }

  .main-div {
      margin: 0 15px; /* Further reduce side margins for smaller screens */
      padding: 15px;
  }

  .main-div-header {
      flex-direction: column; /* Stack header elements */
      align-items: flex-start;
  }

  .add-btn {
      margin-top: 10px;
      margin-left: 0;
      width: 100%; /* Full width button on mobile */
  }

  .add-btn button {
      width: 100%; /* Full width button on mobile */
  }
}

@media (max-width: 576px) {
  .main-div {
      margin: 0 10px;
      padding: 10px;
  }

  .table {
      font-size: 14px; /* Adjust table text size */
  }

  .modal-body {
      padding: 10px; /* Adjust padding for smaller modals */
  }

  .main-div-header h2 {
      font-size: 24px; /* Reduce header font size */
  }

  .add-btn button {
      padding: 10px 15px; /* Adjust button padding */
      font-size: 14px; /* Reduce button text size */
  }
}

@media (max-width: 480px) {

  .form-group {
      margin-bottom: 10px;
  }

  .modal-body {
      padding: 10px;
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
                                    <h2>Interviewer</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Area End -->

            <!-- Job List Area Start -->
            <div class="job-listing-area pt-120 pb-120">
                <div class="main-div">
                        <div class="main-div-header">
                            <h2>Interviewer</h2>
                            <span class="add-btn">
                                <button class="btn head-btn1" data-toggle="modal" data-target="#add">Add Interviewer</button>
                            </span>
                        </div>
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Avalibility</th>
                                    <th scope="col" colspan="2"> <center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include "connection.php";
                                
                                    $sql = "SELECT * FROM interviewer  ";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result)>0) {
                                        while($row = mysqli_fetch_assoc($result)){
                                        ?>
                        
                            
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['designation']; ?></td>
                                    <td><?php echo $row['avalibility']; ?></td>
                                    <td>
                                        <div class="tooltip-container ml-5">
                                            <span class="tooltip-icon"><i  style="color:blue" class="fa-regular fa-pen-to-square fa-sm" ></i></span>
                                            <div class="tooltip-text">
                                                <!-- Replace the SVG with your text -->
                                                Edit 
                                            <div class="tooltip-arrow"></div>
                                        </div>
                                    </td>
                                    <td>
                                    <div class="tooltip-container">
                                        <span class="tooltip-icon"><i id="delete-<?php echo $row['id']; ?>" class="fa-solid fa-trash fa-sm ml-3" style="color:#FF0000; cursor: pointer;"></i></span>
                                        <div class="tooltip-text">
                                            <!-- Replace the SVG with your text -->
                                            Delete 
                                        <div class="tooltip-arrow"></div>
                                    </div>
                                    </td>
                                </tr>
                            
        
                        <?php 
                                }
                            }else{
                                echo " No interviewer Found";
                            }
                        ?>
                        </tbody>
                        </table>
                </div>
            </div>
            <!-- Job List Area End -->
        </main>


<div id="add" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content" style='margin-top:120px;'>
            <div class="modal-header">
                <h5 class="modal-title">Interviewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="interviewerForm" action="interviewer.php" method="POST">
                    <input type="hidden" name="id" id="interviewerId"> <!-- Hidden input for ID (used for editing) -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation:</label>
                        <select class="form-select mb-4" name="designation" id="designation">
                            <option selected disabled>Select Job Category</option>
                            <option value="Design & Creative">Design & Creative</option>
                            <option value="Design & Development">Design & Development</option>
                            <option value="Sales & Marketing">Sales & Marketing</option>
                            <option value="Mobile Application">Mobile Application</option>
                            <option value="Construction">Construction</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Real Estate">Real Estate</option>
                            <option value="Content Writer">Content Writer</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="avalibility">Avalibility:</label>
                        <select class="form-select" name="avalibility" id="avalibility">
                            <option selected disabled>Select Avalibility</option>
                            <option value="10:00am To 11:00am">10:00am To 11:00am</option>
                            <option value="11:00am To 12:00pm">11:00am To 12:00pm</option>
                            <option value="12:00pm To 01:00pm">12:00pm To 01:00pm</option>
                            <option value="01:00pm To 02:00pm">01:00pm To 02:00pm</option>
                            <option value="02:00pm To 03:00pm">02:00pm To 03:00pm</option>
                            <option value="03:00am To 04:00pm">03:00am To 04:00pm</option>
                            <option value="04:00pm To 05:00pm">04:00pm To 05:00pm</option>
                            <option value="05:00pm To 06:00pm">05:00pm To 06:00pm</option>
                            <option value="06:00pm To 07:00pm">06:00pm To 07:00pm</option>
                            <option value="07:00pm To 08:00pm">07:00pm To 08:00pm</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" id="submitBtn" class="btn btn-primary mt-3">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>


        <?php include "footer.php"; ?>

        <script>
            document.querySelectorAll('.fa-pen-to-square').forEach(function(editBtn) {
    editBtn.onclick = function(event) {
        // Get the row data
        var row = event.target.closest('tr');
        var id = row.querySelector('th').textContent;
        var name = row.querySelector('td:nth-child(2)').textContent;
        var email = row.querySelector('td:nth-child(3)').textContent;
        var designation = row.querySelector('td:nth-child(4)').textContent;
        var avalibility = row.querySelector('td:nth-child(5)').textContent;

        // Populate the form fields
        document.getElementById('interviewerId').value = id;
        document.getElementById('name').value = name;
        document.getElementById('email').value = email;
        document.getElementById('designation').value = designation;
        document.getElementById('avalibility').value = avalibility;

        // Update the modal title and button text
        document.querySelector('.modal-title').textContent = 'Edit Interviewer';
        document.getElementById('submitBtn').textContent = 'Update';

        // Show the modal
        $('#add').modal('show');
    };
});

// For Add button click
document.querySelector('.add-btn button').onclick = function() {
    // Reset the form fields
    document.getElementById('interviewerForm').reset();
    document.getElementById('interviewerId').value = ''; // Clear hidden ID field

    // Update the modal title and button text
    document.querySelector('.modal-title').textContent = 'Add Interviewer';
    document.getElementById('submitBtn').textContent = 'Add';

    // Show the modal
    $('#add').modal('show');
};


            document.querySelectorAll('.fa-trash').forEach(function(deleteBtn) {
        deleteBtn.onclick = function(event) {
            var userId = event.target.id.split('-')[1];
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "interviewer.php?id=" + userId;
            }
        };
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