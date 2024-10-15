<?php
session_start();
include "connection.php";

// Retrieve filter values from the URL
$candidate_education = isset($_GET['candidate_education']) ? mysqli_real_escape_string($conn, $_GET['candidate_education']) : '';
$candidate_skill = isset($_GET['candidate_skill']) ? mysqli_real_escape_string($conn, $_GET['candidate_skill']) : '';
$candidate_experience = isset($_GET['candidate_experience']) ? mysqli_real_escape_string($conn, $_GET['candidate_experience']) : '';

// Build your SQL query for exporting data
$sql = "SELECT * FROM applications WHERE 1=1"; // Base query

// Append filters if they are set
if (!empty($candidate_education)) {
    $sql .= " AND candidate_education LIKE '%$candidate_education%'";
}
if (!empty($candidate_skill)) {
    $sql .= " AND candidate_skill LIKE '%$candidate_skill%'";
}
if (!empty($candidate_experience)) {
    $sql .= " AND candidate_experience LIKE '%$candidate_experience%'";
}

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if results are found
if (mysqli_num_rows($result) > 0) {
    // Process and export the results as needed (CSV, Excel, etc.)
    // Example: generating CSV
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="applications.csv"');

    // Output column headers
    $header = ['Application ID', 'Name', 'Email', 'Education', 'Skill', 'Experience', 'Job Title', 'Status'];
    echo implode(',', $header) . "\n";

    // Output rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo implode(',', [$row['application_id'], $row['firstname'] . ' ' . $row['lastname'], $row['email_address'], $row['candidate_education'], $row['candidate_skill'], $row['candidate_experience'], $row['job_title'], $row['status']]) . "\n";
    }
} else {
    echo "No applications found";
}
?>
