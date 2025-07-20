<?php
include 'connect.php';

$sql = "SELECT * FROM sanpham ORDER BY maSP ASC";
$result = $conn->query($sql);

$sanpham = [];
while ($row = $result->fetch_assoc()) {
    $sanpham[] = $row;
}

header('Content-Type: application/json');
echo json_encode($sanpham);
?>
