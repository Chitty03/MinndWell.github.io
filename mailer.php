<?php

ini_set("SMTP", "aspmx.l.google.com");
ini_set("smtp_port", "25");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com"; // Corrected the typo here
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "sanjaychitty36@gmail.com";
$mail->Password = "mbmykjjkojyvrjjq";

$mail->isHtml(true);

return $mail;