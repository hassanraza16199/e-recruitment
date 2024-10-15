document.querySelectorAll('.fa-trash').forEach(function(deleteBtn) {
    deleteBtn.onclick = function(event) {
        var userApplicationId = event.target.id.split('-')[1];
        if (confirm("Are you sure you want to delete this user?")) {
            window.location.href = "applications.php?application_id=" + userApplicationId;
        }
    };
});

// Toggle filter dropdown on button click
document.getElementById('filter-button').addEventListener('click', function() {
var filterDropdown = document.getElementById('filter-dropdown');
if (filterDropdown.style.display === 'none' || filterDropdown.style.display === '') {
    filterDropdown.style.display = 'block';
} else {
    filterDropdown.style.display = 'none';
}
});



// Get the modal element and close button
var modal = document.getElementById("pdfModal");
var closeModal = document.getElementById("closeModal");
var pdfViewer = document.getElementById("pdfViewer");

// Add click event listener to all elements with the 'open-pdf' class (both img and icon)
document.querySelectorAll('.open-pdf').forEach(function (element) {
    element.addEventListener('click', function () {
        // Get the PDF file path from the data-pdf attribute
        var pdfPath = this.getAttribute('data-pdf');
        // Set the src of the embed element to display the PDF
        pdfViewer.setAttribute('src', pdfPath);
        // Show the modal
        modal.style.display = 'block';
    });
});

// Close the modal when the 'close' button is clicked
closeModal.onclick = function () {
    modal.style.display = 'none';
};

// Close the modal when clicking outside the modal content
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};

