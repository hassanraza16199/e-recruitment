<?php
session_start();
include "connection.php";

$candidate_id = $_SESSION['id'];
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5;
$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

$sql = "SELECT * FROM notification 
        WHERE created_at >= NOW() - INTERVAL 20 DAY 
        AND (notification_title = 'Job' OR (notification_title = 'Status' AND candidate_id = $candidate_id)) 
        AND read_as = 1 
        ORDER BY created_at DESC 
        LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="message unread_message">
                <i class="fa-solid fa-envelope mr-3 fa-xl"></i>
                <a>' . htmlspecialchars($row['message']) . '</a>';
        if ($row['notification_title'] === 'Job') {
            echo '<span class="action-icon ml-3">
                    <a href="job_details.php?job_id=' . $row['job_or_status_id'] . '&recruiter_id=' . $row['recruiter_id'] . '"> 
                        <i class="fa-solid fa-up-right-from-square fa-lg"></i>
                    </a>
                  </span>';
        }
        echo '</div>';
    }
} else {
    echo "<p>No more unread notifications.</p>";
}
?>
