<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

function sendMail($to, $subject, $message, $cc = []) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp-relay.brevo.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '7d6391001@smtp-brevo.com';
        $mail->Password   = 'G2ZDJznHRIdYWcXx';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('hassan@ashlarglobal.com', 'E-Recruitment System');
        $mail->addReplyTo('hassan@ashlarglobal.com', 'E-Recruitment System');
        
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
?>
