<?php
include 'connection.php';
session_start();

$candidate_id = $_SESSION['id'];

// Update all unread notifications as read for the current candidate
$sql = "UPDATE notification 
        SET read_as = 1 
        WHERE created_at >= NOW() - INTERVAL 20 DAY 
        AND (notification_title = 'Job' OR (notification_title = 'Status' AND candidate_id = $candidate_id)) 
        AND read_as = 0";

if ($conn->query($sql) === TRUE) {
    echo "Success";
} else {
    echo "Error: " . $conn->error;
}
?>
