<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Kukunin ang form data mula sa HTML form
    $Firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $Email = $_POST['email'];
    $Phonenum = $_POST['phonenum'];
    $Date = $_POST['date'];
    $Time = $_POST['time'];
    $Info = $_POST['info'];

    // Instansya ng PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings para sa Gmail SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jpablobscs@tfvc.edu.ph'; // Palitan ng iyong Gmail email address
        $mail->Password   = 'wwib eltw teep nahv';         // Palitan ng iyong Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom($Email, $Firstname . ' ' . $lastname); // Gagamitin ang email ng nagpadala
        $mail->addAddress('jpablobscs@tfvc.edu.ph', 'Your Name'); // Palitan ng iyong Gmail address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Tattoo Appointment Inquiry from Your Website';
        $mail->Body    = "
            <h2>New Contact Form Submission</h2>
            <p><b>Name:</b> " . htmlspecialchars($Firstname) . " " . htmlspecialchars($lastname) . "</p>
            <p><b>Email:</b> " . htmlspecialchars($Email) . "</p>
            <p><b>Phone Number:</b> " . htmlspecialchars($Phonenum) . "</p>
            <p><b>Preferred Date:</b> " . htmlspecialchars($Date) . "</p>
            <p><b>Preferred Time:</b> " . htmlspecialchars($Time) . "</p>
            <p><b>Tattoo Info:</b> " . htmlspecialchars($Info) . "</p>
        ";
        $mail->AltBody = "New contact form submission:\nName: $Firstname $lastname\nEmail: $Email\nPhone: $Phonenum\nDate: $Date\nTime: $Time\nInfo: $Info";

        $mail->send();
        echo 'Message has been sent successfully!';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    echo "Invalid request method.";
}

?>