<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = htmlspecialchars($_POST['name']    ?? '');
    $email   = filter_var($_POST['email']   ?? '', FILTER_SANITIZE_EMAIL);
    $address = htmlspecialchars($_POST['address'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    // all fields must be non-empty
    if (!$name || !$email || !$address || !$message) {
        exit('<h2>All fields are required.</h2>');
    }
    // validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit('<h2>Invalid email address.</h2>');
    }

    $mail = new PHPMailer(true);
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'shashivarun009@gmail.com';
        $mail->Password   = 'kgycsygmlybzjnmz';  // no spaces
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // recipients & headers
        $mail->setFrom('shashivarun009@gmail.com', 'Contact Form');
        $mail->addAddress('harishreddy09@gmail.com');
        $mail->addReplyTo($email, $name);

        // message content
        $mail->isHTML(false);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Name: $name\nEmail: $email\nAddress: $address\n\nMessage:\n$message";

        $mail->send();
        echo '<h2>Thank you! Your message has been sent.</h2>';
    } catch (Exception $e) {
        echo "<h2>Mailer Error: {$mail->ErrorInfo}</h2>";
    }
} else {
    echo '<h2>Invalid request.</h2>';
}
