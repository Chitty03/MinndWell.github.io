<?php
require __DIR__ . "/config.php";

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$sql = "UPDATE user_form
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = mysqli_prepare($conn, $sql); // Use mysqli_prepare with the $conn object

mysqli_stmt_bind_param($stmt, "sss", $token_hash, $expiry, $email);

mysqli_stmt_execute($stmt);

if ($conn->affected_rows){

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom('noreply@gmail.com', 'Siu');
    $mail->addAddress('sanjaychitty36@gmail.com', 'Sanjay');
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://localhost/reset_password.php?token=$token">here</a> 
    to reset your password.
    END;

    try {

        $mail->send();

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }

}

echo "Message sent, please check your inbox.";