<?php
include "connection.php";

$candidate_id = $_SESSION['id'];
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 5;
$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;

// Fetch read notifications
$sql = "SELECT * FROM notification 
        WHERE created_at >= NOW() - INTERVAL 20 DAY 
        AND (notification_title = 'Job' OR (notification_title = 'Status' AND candidate_id = $candidate_id)) 
        AND read_as = 1 
        ORDER BY created_at DESC 
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

$notifications = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

// Return the notifications as JSON
echo json_encode($notifications);
?>
