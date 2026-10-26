<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST['firstName']);
$lastName  = htmlspecialchars($_POST['lastName']);
$email     = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone     = htmlspecialchars($_POST['phone']);
$message   = htmlspecialchars($_POST['message']);
$name      = $firstName . ' ' . $lastName;

$mail = new PHPMailer(true);
try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@luckycup.in';
        $mail->Password   = 'Lucky@cup2025';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('support@luckycup.in', 'Lucky Cup');
        $mail->addAddress('support@luckycup.in'); // GoDaddy inbox (Webmail)
        //$mail->addBCC('msraogandham@gmail.com');
        //$mail->addReplyTo($email, $name);
        
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail->addReplyTo($email, $name);
        }

    $mail->isHTML(true);
    $mail->Subject = "New Contact Form Submission";
    $mail->Body    = "
        <h3>New message from your website</h3>
        <p><strong>Name:</strong> $firstName $lastName</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Message:</strong><br>$message</p>
    ";

    $mail->send();
     header("Location: thankyou.html");
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
?>
