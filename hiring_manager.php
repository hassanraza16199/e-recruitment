<?php
session_start();
include "connection.php";

if (!isset($_SESSION['name'])) {
    echo "<script>alert('Access Denied! Please login first.');</script>";
    exit;
}elseif ($_SESSION['user_type'] != 'Admin') {
    echo "Access denied.";
    exit;
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $avalibility = json_encode($_POST['avalibility']);
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Update existing record
        $sql = "UPDATE `hiring_managers` SET `name`='$name', `email`='$email', `designation`='$designation', `avalibility`='$avalibility' WHERE `id`=$id";
    } else {
        // Insert new record
        $sql = "INSERT INTO `hiring_managers`(`name`, `email`, `designation`, `avalibility`) VALUES ('$name','$email','$designation','$avalibility')";
    }

    if($conn->query($sql) === TRUE){
        header("Location: hiring_manager.php");
        exit;
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM hiring_managers WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: hiring_manager.php");
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
        <link rel="stylesheet" href="assets/css2/hiring.css">
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
.multi-select {
  display: flex;
  box-sizing: border-box;
  flex-direction: column;
  position: relative;
  width: 100%;
  user-select: none;
}
.multi-select .multi-select-header {
  border: 1px solid #dee2e6;
  padding: 7px 30px 7px 12px;
  overflow: hidden;
  gap: 7px;
  min-height: 45px;
}
.multi-select .multi-select-header::after {
  content: "";
  display: block;
  position: absolute;
  top: 50%;
  right: 15px;
  transform: translateY(-50%);
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23949ba3' viewBox='0 0 16 16'%3E%3Cpath d='M8 13.1l-8-8 2.1-2.2 5.9 5.9 5.9-5.9 2.1 2.2z'/%3E%3C/svg%3E");
  height: 12px;
  width: 12px;
}
.multi-select .multi-select-header.multi-select-header-active {
  border-color: #c1c9d0;
}
.multi-select .multi-select-header.multi-select-header-active::after {
  transform: translateY(-50%) rotate(180deg);
}
.multi-select .multi-select-header.multi-select-header-active + .multi-select-options {
  display: flex;
}
.multi-select .multi-select-header .multi-select-header-placeholder {
  color: #65727e;
}
.multi-select .multi-select-header .multi-select-header-option {
  display: inline-flex;
  align-items: center;
  background-color: #f3f4f7;
  font-size: 14px;
  padding: 3px 8px;
  border-radius: 5px;
}
.multi-select .multi-select-header .multi-select-header-max {
  font-size: 14px;
  color: #65727e;
}
.multi-select .multi-select-options {
  display: none;
  box-sizing: border-box;
  flex-flow: wrap;
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 999;
  margin-top: 5px;
  padding: 5px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  max-height: 200px;
  overflow-y: auto;
  overflow-x: hidden;
}
.multi-select .multi-select-options::-webkit-scrollbar {
  width: 5px;
}
.multi-select .multi-select-options::-webkit-scrollbar-track {
  background: #f0f1f3;
}
.multi-select .multi-select-options::-webkit-scrollbar-thumb {
  background: #cdcfd1;
}
.multi-select .multi-select-options::-webkit-scrollbar-thumb:hover {
  background: #b2b6b9;
}
.multi-select .multi-select-options .multi-select-option, .multi-select .multi-select-options .multi-select-all {
  padding: 4px 12px;
  height: 42px;
}
.multi-select .multi-select-options .multi-select-option .multi-select-option-radio, .multi-select .multi-select-options .multi-select-all .multi-select-option-radio {
  margin-right: 14px;
  height: 16px;
  width: 16px;
  border: 1px solid #ced4da;
  border-radius: 4px;
}
.multi-select .multi-select-options .multi-select-option .multi-select-option-text, .multi-select .multi-select-options .multi-select-all .multi-select-option-text {
  box-sizing: border-box;
  flex: 1;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  color: inherit;
  font-size: 16px;
  line-height: 20px;
}
.multi-select .multi-select-options .multi-select-option.multi-select-selected .multi-select-option-radio, .multi-select .multi-select-options .multi-select-all.multi-select-selected .multi-select-option-radio {
  border-color: #40c979;
  background-color: #40c979;
}
.multi-select .multi-select-options .multi-select-option.multi-select-selected .multi-select-option-radio::after, .multi-select .multi-select-options .multi-select-all.multi-select-selected .multi-select-option-radio::after {
  content: "";
  display: block;
  width: 3px;
  height: 7px;
  margin: 0.12em 0 0 0.27em;
  border: solid #fff;
  border-width: 0 0.15em 0.15em 0;
  transform: rotate(45deg);
}
.multi-select .multi-select-options .multi-select-option.multi-select-selected .multi-select-option-text, .multi-select .multi-select-options .multi-select-all.multi-select-selected .multi-select-option-text {
  color: #40c979;
}
.multi-select .multi-select-options .multi-select-option:hover, .multi-select .multi-select-options .multi-select-option:active, .multi-select .multi-select-options .multi-select-all:hover, .multi-select .multi-select-options .multi-select-all:active {
  background-color: #f3f4f7;
}
.multi-select .multi-select-options .multi-select-all {
  border-bottom: 1px solid #f1f3f5;
  border-radius: 0;
}
.multi-select .multi-select-options .multi-select-search {
  padding: 7px 10px;
  border: 1px solid #dee2e6;
  border-radius: 5px;
  margin: 10px 10px 5px 10px;
  width: 100%;
  outline: none;
  font-size: 16px;
}
.multi-select .multi-select-options .multi-select-search::placeholder {
  color: #b2b5b9;
}
.multi-select .multi-select-header, .multi-select .multi-select-option, .multi-select .multi-select-all {
  display: flex;
  flex-wrap: wrap;
  box-sizing: border-box;
  align-items: center;
  border-radius: 5px;
  cursor: pointer;
  display: flex;
  align-items: center;
  width: 100%;
  font-size: 16px;
  color: #212529;
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
                                    <h2>Hiring Manager</h2>
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
    <h2>Hiring Managers</h2>
    <span class="add-btn">
        <button class="btn head-btn1" data-toggle="modal" data-target="#add">Add Hiring Manager</button>
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
                                    $limit = 15;
                                    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($current_page - 1) * $limit;
                                    
                                    // Total managers count
                                    $total_managers_query = "SELECT COUNT(*) as total FROM hiring_managers";
                                    $total_managers_result = $conn->query($total_managers_query);
                                    $total_managers = $total_managers_result->fetch_assoc()['total'];
                                    
                                    // Total pages calculation
                                    $total_pages = ceil($total_managers / $limit);
                                    
                                    // Fetch hiring managers for the current page
                                    $sql = "SELECT * FROM hiring_managers LIMIT $limit OFFSET $offset";
                                    $result = $conn->query($sql);

                                    if (mysqli_num_rows($result)>0) {
                                        while($row = $result->fetch_assoc()){
                                        ?>
                        
                            
                                <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['designation']; ?></td>
                                    <td> 
                                        <?php 
                                            $availability = json_decode($row['avalibility'], true); 
                                            if (is_array($availability)) {
                                                echo implode(' | ', $availability);
                                            } else {
                                                echo $availability; // Display single selected availability option
                                            }
                                        ?>
                                    </td>


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
                                echo " No hiring Manager Found";
                            }
                        ?>
                        </tbody>
                        </table>
                </div>
            </div>
            
             <!-- Pagination Links -->
             <?php if ($total_managers > $limit): ?>
                <div class="pagination-area pb-115 text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="single-wrap d-flex justify-content-center">
                                    <nav>
                                        <ul class="pagination">
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

        <div id="add" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content" style='margin-top:120px;'>
            <div class="modal-header">
                <h5 class="modal-title">Hiring Manager</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="hiringmanagerForm" action="hiring_manager.php" method="POST">
                    <input type="hidden" name="id" id="hiringmanagerId"> <!-- Hidden input for ID (used for editing) -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation:</label>
                        <select class="form-select mb-4" name="designation" id="designation" required>
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
                        <select name="avalibility" id="avalibility" data-placeholder="Select avalibilty" multiple data-multi-select required>
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
        document.getElementById('hiringmanagerId').value = id; // Corrected to 'hiringmanagerId'
        document.getElementById('name').value = name;
        document.getElementById('email').value = email;
        document.getElementById('designation').value = designation;
        document.getElementById('avalibility').value = avalibility;

        // Update the modal title and button text
        document.querySelector('.modal-title').textContent = 'Edit Hiring Manager';
        document.getElementById('submitBtn').textContent = 'Update';

        // Show the modal
        $('#add').modal('show');
    };
});


// For Add button click
document.querySelector('.add-btn button').onclick = function() {
    // Reset the form fields
    document.getElementById('hiringmanagerForm').reset();
    document.getElementById('hiringmanagerId').value = ''; // Clear hidden ID field

    // Update the modal title and button text
    document.querySelector('.modal-title').textContent = 'Add Hiring Manager';
    document.getElementById('submitBtn').textContent = 'Add';

    // Show the modal
    $('#add').modal('show');
};


            document.querySelectorAll('.fa-trash').forEach(function(deleteBtn) {
        deleteBtn.onclick = function(event) {
            var userId = event.target.id.split('-')[1];
            if (confirm("Are you sure you want to delete this user?")) {
                window.location.href = "hiring_manager.php?id=" + userId;
            }
        };
    });

class MultiSelect {

constructor(element, options = {}) {
    let defaults = {
        placeholder: 'Select item(s)',
        max: null,
        search: true,
        selectAll: true,
        listAll: true,
        closeListOnItemSelect: false,
        name: '',
        width: '',
        height: '',
        dropdownWidth: '',
        dropdownHeight: '',
        data: [],
        onChange: function() {},
        onSelect: function() {},
        onUnselect: function() {}
    };
    this.options = Object.assign(defaults, options);
    this.selectElement = typeof element === 'string' ? document.querySelector(element) : element;
    for(const prop in this.selectElement.dataset) {
        if (this.options[prop] !== undefined) {
            this.options[prop] = this.selectElement.dataset[prop];
        }
    }
    this.name = this.selectElement.getAttribute('name') ? this.selectElement.getAttribute('name') : 'multi-select-' + Math.floor(Math.random() * 1000000);
    if (!this.options.data.length) {
        let options = this.selectElement.querySelectorAll('option');
        for (let i = 0; i < options.length; i++) {
            this.options.data.push({
                value: options[i].value,
                text: options[i].innerHTML,
                selected: options[i].selected,
                html: options[i].getAttribute('data-html')
            });
        }
    }
    this.element = this._template();
    this.selectElement.replaceWith(this.element);
    this._updateSelected();
    this._eventHandlers();
}

_template() {
    let optionsHTML = '';
    for (let i = 0; i < this.data.length; i++) {
        optionsHTML += `
            <div class="multi-select-option${this.selectedValues.includes(this.data[i].value) ? ' multi-select-selected' : ''}" data-value="${this.data[i].value}">
                <span class="multi-select-option-radio"></span>
                <span class="multi-select-option-text">${this.data[i].html ? this.data[i].html : this.data[i].text}</span>
            </div>
        `;
    }
    let selectAllHTML = '';
    if (this.options.selectAll === true || this.options.selectAll === 'true') {
        selectAllHTML = `<div class="multi-select-all">
            <span class="multi-select-option-radio"></span>
            <span class="multi-select-option-text">Select all</span>
        </div>`;
    }
    let template = `
        <div class="multi-select ${this.name}"${this.selectElement.id ? ' id="' + this.selectElement.id + '"' : ''} style="${this.width ? 'width:' + this.width + ';' : ''}${this.height ? 'height:' + this.height + ';' : ''}">
            ${this.selectedValues.map(value => `<input type="hidden" name="${this.name}[]" value="${value}">`).join('')}
            <div class="multi-select-header" style="${this.width ? 'width:' + this.width + ';' : ''}${this.height ? 'height:' + this.height + ';' : ''}">
                <span class="multi-select-header-max">${this.options.max ? this.selectedValues.length + '/' + this.options.max : ''}</span>
                <span class="multi-select-header-placeholder">${this.placeholder}</span>
            </div>
            <div class="multi-select-options" style="${this.options.dropdownWidth ? 'width:' + this.options.dropdownWidth + ';' : ''}${this.options.dropdownHeight ? 'height:' + this.options.dropdownHeight + ';' : ''}">
                ${this.options.search === true || this.options.search === 'true' ? '<input type="text" class="multi-select-search" placeholder="Search...">' : ''}
                ${selectAllHTML}
                ${optionsHTML}
            </div>
        </div>
    `;
    let element = document.createElement('div');
    element.innerHTML = template;
    return element;
}

_eventHandlers() {
    let headerElement = this.element.querySelector('.multi-select-header');
    this.element.querySelectorAll('.multi-select-option').forEach(option => {
        option.onclick = () => {
            let selected = true;
            if (!option.classList.contains('multi-select-selected')) {
                if (this.options.max && this.selectedValues.length >= this.options.max) {
                    return;
                }
                option.classList.add('multi-select-selected');
                if (this.options.listAll === true || this.options.listAll === 'true') {
                    if (this.element.querySelector('.multi-select-header-option')) {
                        let opt = Array.from(this.element.querySelectorAll('.multi-select-header-option')).pop();
                        opt.insertAdjacentHTML('afterend', `<span class="multi-select-header-option" data-value="${option.dataset.value}">${option.querySelector('.multi-select-option-text').innerHTML}</span>`);
                    } else {
                        headerElement.insertAdjacentHTML('afterbegin', `<span class="multi-select-header-option" data-value="${option.dataset.value}">${option.querySelector('.multi-select-option-text').innerHTML}</span>`);
                    }
                }
                this.element.querySelector('.multi-select').insertAdjacentHTML('afterbegin', `<input type="hidden" name="${this.name}[]" value="${option.dataset.value}">`);
                this.data.filter(data => data.value == option.dataset.value)[0].selected = true;
            } else {
                option.classList.remove('multi-select-selected');
                this.element.querySelectorAll('.multi-select-header-option').forEach(headerOption => headerOption.dataset.value == option.dataset.value ? headerOption.remove() : '');
                this.element.querySelector(`input[value="${option.dataset.value}"]`).remove();
                this.data.filter(data => data.value == option.dataset.value)[0].selected = false;
                selected = false;
            }
            if (this.options.listAll === false || this.options.listAll === 'false') {
                if (this.element.querySelector('.multi-select-header-option')) {
                    this.element.querySelector('.multi-select-header-option').remove();
                }
                headerElement.insertAdjacentHTML('afterbegin', `<span class="multi-select-header-option">${this.selectedValues.length} selected</span>`);
            }
            if (!this.element.querySelector('.multi-select-header-option')) {
                headerElement.insertAdjacentHTML('afterbegin', `<span class="multi-select-header-placeholder">${this.placeholder}</span>`);
            } else if (this.element.querySelector('.multi-select-header-placeholder')) {
                this.element.querySelector('.multi-select-header-placeholder').remove();
            }
            if (this.options.max) {
                this.element.querySelector('.multi-select-header-max').innerHTML = this.selectedValues.length + '/' + this.options.max;
            }
            if (this.options.search === true || this.options.search === 'true') {
                this.element.querySelector('.multi-select-search').value = '';
            }
            this.element.querySelectorAll('.multi-select-option').forEach(option => option.style.display = 'flex');
            if (this.options.closeListOnItemSelect === true || this.options.closeListOnItemSelect === 'true') {
                headerElement.classList.remove('multi-select-header-active');
            }
            this.options.onChange(option.dataset.value, option.querySelector('.multi-select-option-text').innerHTML, option);
            if (selected) {
                this.options.onSelect(option.dataset.value, option.querySelector('.multi-select-option-text').innerHTML, option);
            } else {
                this.options.onUnselect(option.dataset.value, option.querySelector('.multi-select-option-text').innerHTML, option);
            }
        };
    });
    headerElement.onclick = () => headerElement.classList.toggle('multi-select-header-active');  
    if (this.options.search === true || this.options.search === 'true') {
        let search = this.element.querySelector('.multi-select-search');
        search.oninput = () => {
            this.element.querySelectorAll('.multi-select-option').forEach(option => {
                option.style.display = option.querySelector('.multi-select-option-text').innerHTML.toLowerCase().indexOf(search.value.toLowerCase()) > -1 ? 'flex' : 'none';
            });
        };
    }
    if (this.options.selectAll === true || this.options.selectAll === 'true') {
        let selectAllButton = this.element.querySelector('.multi-select-all');
        selectAllButton.onclick = () => {
            let allSelected = selectAllButton.classList.contains('multi-select-selected');
            this.element.querySelectorAll('.multi-select-option').forEach(option => {
                let dataItem = this.data.find(data => data.value == option.dataset.value);
                if (dataItem && ((allSelected && dataItem.selected) || (!allSelected && !dataItem.selected))) {
                    option.click();
                }
            });
            selectAllButton.classList.toggle('multi-select-selected');
        };
    }
    if (this.selectElement.id && document.querySelector('label[for="' + this.selectElement.id + '"]')) {
        document.querySelector('label[for="' + this.selectElement.id + '"]').onclick = () => {
            headerElement.classList.toggle('multi-select-header-active');
        };
    }
    document.addEventListener('click', event => {
        if (!event.target.closest('.' + this.name) && !event.target.closest('label[for="' + this.selectElement.id + '"]')) {
            headerElement.classList.remove('multi-select-header-active');
        }
    });
}

_updateSelected() {
    if (this.options.listAll === true || this.options.listAll === 'true') {
        this.element.querySelectorAll('.multi-select-option').forEach(option => {
            if (option.classList.contains('multi-select-selected')) {
                this.element.querySelector('.multi-select-header').insertAdjacentHTML('afterbegin', `<span class="multi-select-header-option" data-value="${option.dataset.value}">${option.querySelector('.multi-select-option-text').innerHTML}</span>`);
            }
        });
    } else {
        if (this.selectedValues.length > 0) {
            this.element.querySelector('.multi-select-header').insertAdjacentHTML('afterbegin', `<span class="multi-select-header-option">${this.selectedValues.length} selected</span>`);
        }
    }
    if (this.element.querySelector('.multi-select-header-option')) {
        this.element.querySelector('.multi-select-header-placeholder').remove();
    }
}

get selectedValues() {
    return this.data.filter(data => data.selected).map(data => data.value);
}

get selectedItems() {
    return this.data.filter(data => data.selected);
}

set data(value) {
    this.options.data = value;
}

get data() {
    return this.options.data;
}

set selectElement(value) {
    this.options.selectElement = value;
}

get selectElement() {
    return this.options.selectElement;
}

set element(value) {
    this.options.element = value;
}

get element() {
    return this.options.element;
}

set placeholder(value) {
    this.options.placeholder = value;
}

get placeholder() {
    return this.options.placeholder;
}

set name(value) {
    this.options.name = value;
}

get name() {
    return this.options.name;
}

set width(value) {
    this.options.width = value;
}

get width() {
    return this.options.width;
}

set height(value) {
    this.options.height = value;
}

get height() {
    return this.options.height;
}

}
document.querySelectorAll('[data-multi-select]').forEach(select => new MultiSelect(select));
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