<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

function sendMail($to, $subject, $message) {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '7d6391001@smtp-brevo.com';
        $mail->Password   = 'G2ZDJznHRIdYWcXx';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
    
        //Recipients
        $mail->setFrom('hassan@ashlarglobal.com', 'E-Recruitment System');
        $mail->addAddress($to);
        $mail->addReplyTo('hassan@ashlarglobal.com', 'E-Recruitment System');
    
        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = $message;
    
        $mail->send();

        return ['status' => true, 'message' => 'Email Sent Successfully!'];
    } catch (Exception $e) {
        return ['status' => false, 'message' => 'Email could not be sent!', 'error' => $mail->ErrorInfo];
    }
}

if(isset($_POST['send_email'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(($_POST['to_email'] && $_POST['subject'] && $_POST['message']) && ($_POST['to_email'] !== '' && $_POST['subject'] !== '' && $_POST['message'] !== '')) {
        $send = sendMail($_POST['to_email'], $_POST['subject'], $_POST['message']);
        
        $_SESSION['email_status'] = $send['status'];
        $_SESSION['message'] = $send['message'];

        if($send['status']) {
            $_SESSION['status'] = 'success';
            // Redirect based on where the email is being sent
        if(isset($_POST['application_id']) && !empty($_POST['application_id'])) {
            header("Location: application_status.php?application_id={$_POST['application_id']}");
        } else {
            header("Location: users_contact.php");
        }
        } else {
            $_SESSION['status'] = 'danger';
            $_SESSION['error'] = $send['error'];
            // Redirect based on where the email is being sent
        if(isset($_POST['application_id']) && !empty($_POST['application_id'])) {
            header("Location: application_status.php?application_id={$_POST['application_id']}");
        } else {
            header("Location: users_contact.php");
        }
        }

        exit; // Stop further execution
    } else {
        echo("All fields are required!");
    }
}
?>
