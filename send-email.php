<?php

@include 'config.php';

$name = $_POST["Name"];
$email = $_POST["email"];
$subject = $_POST["Subject"];
$message = $_POST["message"];

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "sanjaychitty36@gmail.com";
$mail->Password = "mbmykjjkojyvrjjq";

$mail->setFrom($email, $name);
$mail->addAddress("sanjaychitty36@gmail.com", "Mindwell");

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

header("Location: sent.php");