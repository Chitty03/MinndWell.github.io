<?php
include 'conn.php';
$data = array();
$sql = "SELECT *  FROM `discussion` ORDER BY id desc";
$result = $conn->query($sql);
while($row = $result->fetch()){
    $data[] = $row; // Append the row to the data array directly
}

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode($data);
$conn = null;
exit();
?>