<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

include 'connection.php';

function sendMail($to, $subject, $message, $cc = []) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '805d75001@smtp-brevo.com';
        $mail->Password   = 'UXhIC7DQcyb2zJ4q';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('hussnain.umer.vu@gmail.com', 'E-Recruitment System');
        $mail->addReplyTo('hussnain.umer.vu@gmail.com', 'E-Recruitment System');
        
        foreach ($to as $email) {
            $mail->addAddress($email);
        }

        foreach ($cc as $ccEmail) {
            $mail->addCC($ccEmail);
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = strip_tags($message);

        $mail->send();
        return ['status' => true, 'message' => 'Email Sent Successfully!'];
    } catch (Exception $e) {
        return ['status' => false, 'message' => 'Email could not be sent!', 'error' => $mail->ErrorInfo];
    }
}

// Handle the email send request
if (isset($_POST['send_email'])) {
    session_start();
    if (!empty($_POST['to_email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
        $send = sendMail($_POST['to_email'], $_POST['subject'], $_POST['message']);

        $_SESSION['email_status'] = $send['status'];
        $_SESSION['message'] = $send['message'];
        $_SESSION['status'] = $send['status'] ? 'success' : 'danger';
        $_SESSION['error'] = $send['status'] ? '' : $send['error'];

        $redirectUrl = isset($_POST['application_id']) && !empty($_POST['application_id']) 
                        ? "application_status.php?application_id={$_POST['application_id']}"
                        : "users_contact.php";
        header("Location: $redirectUrl");
        exit;
    } else {
        echo("All fields are required!");
    }
}

if (isset($_POST['schedule'])) {
    $application_id    = $_POST['application_id'];
    $email_address     = $_POST['email_address'];
    $interview_date    = $_POST['interview_date'];
    $interview_time    = $_POST['interview_time'];
    $meeting_link      = $_POST['meeting_link'];
    $candidate_name    = $_POST['candidate_name'];
    $job_title         = $_POST['job_title'];
    $interviewer_email = $_POST['interviewer_email'];
    $interview_type    = $_POST['interview_type'];
    $interviewer       = $_POST['interviewer'] ?? $_POST['manager'];
    
    if (isset($_POST['interview_time'])) {
        $sql = "INSERT INTO interview_schedule (application_id, interview_time, interviewer_id, interview_date, meeting_link, schedule_email)
                VALUES ('$application_id', '$interview_time', '$interviewer', '$interview_date', '$meeting_link', '$email_address')";

        if ($conn->query($sql) === TRUE) {
            $to = [$email_address, $interviewer_email];
            $subject = "$interview_type Interview Invitation";
            if($interview_type == 'Technical') {
                $message =
                    "Dear <b>$candidate_name</b>,
                    <br><br>
                    I am writing to invite you for an interview for the position of <b>$job_title</b>. We were impressed by your application and believe that you would be a great fit for our team.
                    The interview will be conducted online and will take approximately 30 to 60 Minutes on <b>$interview_date</b> at <b>$interview_time</b>. We will discuss your work experience, skills, and qualifications in-depth and provide you with more information about the position and our company.
                    <br><br>
                    Following is the Google Meet Link: 
                    <br><br>
                    $meeting_link 
                    <br><br>
                    We want to ensure that you have a comfortable experience during the interview, so if you need any accommodations or have any special requirements, please let us know and we will do our best to accommodate you.
                    <br><br>
                    Thank you for your interest in our company, and we look forward to hearing back from you soon.
                    <br><br>
                    Sincerely,
                    <br>
                    E-Recruitment"
                ;
            } else {
                $message =
                    "Dear <b>$candidate_name</b>,
                    <br><br>
                    I am writing to invite you for a final interview for the position of <b>$job_title</b>. We were impressed by your previous interview and believe that you would be a great fit for our team.
                    The interview will be conducted online and will take approximately 20 to 30 Minutes on <b>$interview_date</b> at <b>$interview_time</b>. We will discuss your work experience, skills, and qualifications in-depth and provide you with more information about the position and our company.
                    <br><br>
                    Following is the Google Meet Link: 
                    <br><br>
                    $meeting_link 
                    <br><br>
                    We want to ensure that you have a comfortable experience during the interview, so if you need any accommodations or have any special requirements, please let us know and we will do our best to accommodate you.
                    <br><br>
                    We look forward to hearing back from you soon.
                    <br><br>
                    Sincerely,
                    <br>
                    E-Recruitment"
                ;
            }
            
            $send = sendMail($to, $subject, $message);
            
            $_SESSION['email_status'] = $send['status'];
            $_SESSION['message'] = $send['message'];
            $_SESSION['status'] = $send['status'] ? 'success' : 'danger';
            $_SESSION['error'] = $send['status'] ? '' : $send['error'];

            header("location: application_status.php?application_id=$application_id");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Interview time is not set.";
    }
}

if (isset($_POST['submit_application_status'])) {
    session_start();

    if (isset($_POST['application_id'])) {
        $application_id = $_POST['application_id'];
    }
    $status = $_POST['status'];
    $sql = "UPDATE applications SET status = '$status' WHERE application_id = '$application_id'";

    if ($conn->query($sql) === TRUE) {
        // Prepare notification message
        $recruiter_id       = $_SESSION['id'];
        $recruiter_name     = $_SESSION['name'];
        $notification_title = $_POST['status'];
        $job_title          = $_POST['job_title'];
        $candidate_id       = $_POST['candidate_id'];
        $candidate_name     = $_POST['candidate_name'];
        $candidate_email    = $_POST['candidate_email'];
        $_SESSION['message'] = "Status Changed Successfully!";

        if($_POST['status'] == "Pending" || $_POST['status'] == "Initial Screening" || $_POST['status'] == "Shortlist") {
            $message = NULL;
        } else if($_POST['status'] == 'Technical Interviewing') {
            $message = "You have been invited for the Technical Interview. Please check your email.";
        } else if($_POST['status'] == 'Final Interview') {
            $message = "You have been invited for the Final Interview. Please check your email.";
        } else if($_POST['status'] == 'Hired') {
            $message = "Congratulations, You have been offered the position of $job_title. Please check your email for further details.";
            $_SESSION['message'] = "Status Changed and Offer Letter Email Sent Successfully!";

            $body =
                "Dear <b>$candidate_name</b>,
                <br><br>
                I hope you are doing great. Congratulations, We have decided to offer you the position of <b>$job_title</b>. We will provide you the further information very soon.
                <br><br>
                Sincerely,
                <br>
                E-Recruitment"
            ;

            sendMail([$candidate_email], "Offer Letter", $body);
        } else if($_POST['status'] == 'Rejected') {
            $_SESSION['message'] = "Status Changed and Rejection Email Sent Successfully!";

            $body =
                "Dear <b>$candidate_name</b>,
                <br><br>
                I hope you are doing great. Unfortunately, We have decided to not proceed with your application for the position of <b>$job_title</b>. You are welcome to further apply in the future.
                <br><br>
                Thank you for the application.
                <br><br>
                Sincerely,
                <br>
                E-Recruitment"
            ;

            sendMail([$candidate_email], "Application Rejected", $body);
            $message = "Your application for the role of $job_title have been rejected. Please check your email for further details.";
        }

        $_SESSION['email_status'] = true;
        $_SESSION['status'] = 'success';

        // Insert notification data
        if($message) {
            $notification_sql = "INSERT INTO notification (job_or_status_id, recruiter_id, candidate_id, notification_title, message, created_at) 
                              VALUES ('$application_id', '$recruiter_id', '$candidate_id', '$notification_title', '$message', '" . date('Y-m-d h:i:s') . "')";
            if ($conn->query($notification_sql) === TRUE) {
                header("location: application_status.php?application_id=$application_id");
            } else {
                echo "Error: " . $notification_sql . "<br>" . $conn->error;
            }
        } else {
            header("location: application_status.php?application_id=$application_id");
        }
    }
}
?>
