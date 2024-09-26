<?php
session_start();
include "connection.php";

if (isset($_GET['job_id'])) {
    $job_id = intval($_GET['job_id']);
    // Toggle job status
    $sql = "UPDATE job_post SET status = CASE WHEN status = 'active' THEN 'inactive' ELSE 'active' END WHERE job_id = $job_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: posted_jobs.php");
        exit();
    } else {
        echo "Error updating job status: " . $conn->error;
    }
} else {
    header("Location: posted_jobs.php");
    exit();
}
?>
