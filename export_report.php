<?php
    require "connection.php";
    if (!isset($_SESSION['name'])) {
        echo "<script>alert('Access Denied! Please login first.');</script>";
        exit;
    }elseif ($_SESSION['user_type'] != 'Admin') {
        echo "Access denied.";
        exit;
    }

    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
    
    // Initialize the table with headers
    $html = '<table border="1"> 
                <tr> 
                    <th>ID</th> 
                    <th>Name</th> 
                    <th>Email</th> 
                    <th>Phone</th> 
                    <th>Date of Birth</th> 
                    <th>City</th> 
                    <th>User Type</th> 
                </tr>';
    
    if ($result->num_rows > 0) {
        // Loop through each row in the result
        while($row = $result->fetch_assoc()) {
            // Only include users with 'Recruiter' or 'Candidate' user types
            if ($row['user_type'] === 'Recruiter' || $row['user_type'] === 'Candidate') {
                // Append each row to the $html string
                $html .= '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $row['birthdate'] . '</td>
                            <td>' . $row['city'] . '</td>
                            <td>' . $row['user_type'] . '</td>
                          </tr>';
            }
        }
    }
    
    // Close the table
    $html .= '</table>';
    
    // Set headers to force download as Excel file
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename=report.xls');
    
    // Output the content
    echo $html;
?>
