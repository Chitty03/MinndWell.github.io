<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/config.php";

$sql = "SELECT * FROM user_form
        WHERE reset_token_hash = ?";

$conn = $mysqli->prepare($sql);

$conn->bind_param("s", $token_hash);

$conn->execute();

$result = $conn->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Style.css">
    
</head>
<body>
<div class="form-container">

    <form method="post" action="process_reset_password.php">

    <h1>Reset Password</h1>

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <input type="password" id="password" name="password" required placeholder="New Password">

        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Repeat Password">

        <input type="submit" name="submit" value="Send" class="form-btn">
    </form>
</div>
</body>
</html>