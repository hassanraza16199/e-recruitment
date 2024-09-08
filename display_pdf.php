<?php
include "connection.php";

if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $file_path = '/e-recruitment/cv/' . $file;

    // Check if the file exists
    if (file_exists($file_path)) {
        // Set headers to display the PDF inline and prevent download
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        
        // Output the file
        readfile($file_path);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>
