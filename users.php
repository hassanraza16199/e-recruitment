<?php
session_start();
include "connection.php";

if (isset($_POST['submit'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birthdate = $_POST['birthdate'];
    $city = $_POST['city'];
    $password = $_POST['password'];
    // Add other fields as necessary

    $sql = "UPDATE user SET name = '$name', email = '$email', password = '$password', phone = '$phone', birthdate = '$birthdate', city = '$city' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
        header("location: users.php");
    } else {
        echo "Error updating user: " . $conn->error;
    }
}
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM user WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: users.php");
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

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Default width for larger screens */
    max-width: 600px; /* Maximum width */
    margin: auto; /* Center horizontally */
    box-sizing: border-box;
    border-radius: 8px;
    
}

/* Responsive adjustments */
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
#report-btn {
    margin-left: auto;
    display: block;
}

/* For larger screens */
@media (min-width: 768px) {
    #report-btn {
        width: 200px; /* Optional: adjust width for large screens */
    }
}

/* For tablets */
@media (max-width: 768px) {
    #report-btn {
        margin-left: 0;
        width: 100%; /* Makes the button full width */
        text-align: center;
    }
}

/* For mobile devices */
@media (max-width: 480px) {
    #report-btn {
        margin-left: 0;
        width: 100%; /* Full width for mobile */
        font-size: 14px; /* Adjust font size if needed */
        padding: 10px;
    }
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
                                <h2>User Information</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
    
    <main class="ml-5 mr-5 mt-5 mb-5">
        <div class="row">
            <h2 class="mt-3 mb-3">Users Information</h2>
            <a href="export_report.php" id="report-btn">
                <button class="btn head-btn1"  type="submit" name="export">Report Export</button>
            </a>
            
        </div>
        
        <hr>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">Sr</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Date of Birth</th>
      <th scope="col">City</th>
      <th scope="col">Role</th>
      <th scope="col" colspan="2"><span class="ml-5">Action</span></th>
    </tr>
  </thead>
  <tbody>
  <?php
$limit = 15;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

// Count total number of users
$total_users_query = "SELECT COUNT(*) as total FROM user WHERE user_type = 'Recruiter' OR user_type = 'Candidate'";
$total_users_result = $conn->query($total_users_query);
$total_users = $total_users_result->fetch_assoc()['total'];

// Calculate total pages
$total_pages = ceil($total_users / $limit);

// Fetch users for the current page
$sql = "SELECT * FROM user WHERE user_type = 'Recruiter' OR user_type = 'Candidate' LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
            $id = $row['id'];
?>
    <tr>
      <th scope="row"><?php echo $id; ?></th>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td><?php echo $row['birthdate']; ?></td>
      <td><?php echo $row['city']; ?></td>
      <td><?php echo $row['user_type']; ?></td>
      
      <td>
        
        <div class="tooltip-container">
                <span class="tooltip-icon"><i  style="color:blue" class="fa-regular fa-pen-to-square fa-sm" ></i></span>
                <div class="tooltip-text">
                    <!-- Replace the SVG with your text -->
                    Edit 
                <div class="tooltip-arrow"></div>
            </div> 
        </td>
            <td>
            <div class="tooltip-container">
                <span class="tooltip-icon"><i id="delete-<?php echo $id; ?>" class="fa-solid fa-trash fa-sm ml-3" style="color:#FF0000; cursor: pointer;"></i></span>
                <div class="tooltip-text">
                    <!-- Replace the SVG with your text -->
                    Delete 
                <div class="tooltip-arrow"></div>
            </div>
    </td>
    </tr>
<?php
            
        
    }
} else {
    echo "No user found.";
}
?>

  </tbody>
</table>

<!-- Pagination Links -->
<?php if ($total_users > 15): ?>
            <div class="pagination-area pb-115 text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="single-wrap d-flex justify-content-center">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-start">
                                        <?php if ($current_page > 1): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?php echo $i == $current_page ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <?php if ($current_page < $total_pages): ?>
                                            <li class="page-item">
                                                <a class="page-link" href="?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>
    
<!-- Edit Form Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit User Information</h2>
        <form id="editForm" method="POST" action="users.php">
            <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="phone">Password:</label>
                <input type="text" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>
            <div class="form-group">
                <label for="birthdate">Date of Birth:</label>
                <input type="text" name="birthdate" id="birthdate" class="form-control">
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" name="city" id="city" class="form-control">
            </div>

            <!-- Add more fields as necessary -->
            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>


<?php include "footer.php"; ?>
  <!-- JS here -->

  <script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("editModal");
    var span = document.getElementsByClassName("close")[0];

    // Edit button functionality
    document.querySelectorAll('.fa-pen-to-square').forEach(function(editBtn) {
        editBtn.addEventListener('click', function(event) {
            // Find the closest table row and extract data
            var tr = event.target.closest('tr');
            var userId = tr.querySelector('th').innerText;
            var userName = tr.querySelector('td:nth-child(2)').innerText;
            var userEmail = tr.querySelector('td:nth-child(3)').innerText;
            var userPhone = tr.querySelector('td:nth-child(4)').innerText;
            var userBirthdate = tr.querySelector('td:nth-child(5)').innerText;
            var userCity = tr.querySelector('td:nth-child(6)').innerText;

            // Populate the modal form fields
            document.getElementById('id').value = userId;
            document.getElementById('name').value = userName;
            document.getElementById('email').value = userEmail;
            document.getElementById('phone').value = userPhone;
            document.getElementById('birthdate').value = userBirthdate;
            document.getElementById('city').value = userCity;

            // Display the modal
            modal.style.display = "flex";
        });
    });

    // Delete button functionality
    document.querySelectorAll('.fa-trash').forEach(function(deleteBtn) {
        deleteBtn.addEventListener('click', function(event) {
            var userId = event.target.id.split('-')[1];
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "users.php?id=" + userId;
            }
        });
    });

    // Close the modal when the close button is clicked
    span.onclick = function() {
        modal.style.display = "none";
    };

    // Close the modal if the user clicks outside the modal content
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});
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