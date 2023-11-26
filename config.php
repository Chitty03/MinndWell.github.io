<?php

$conn = mysqli_connect('localhost','root','','user_db');

if ($conn === false) {
    die("Error: Could not connect. " . mysqli_connect_error());
}

return $conn;
?>