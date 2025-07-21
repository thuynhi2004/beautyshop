<?php
// Thông tin kết nối
$server = 'sql210.infinityfree.com';
$user = 'if0_39510426';
$pass = 'KQVOq66pT8';
$database = 'if0_39510426_thuongmaidientu';

// Tạo kết nối
$conn = new mysqli($server, $user, $pass, $database);
$conn->set_charset("utf8"); // đảm bảo hiển thị tiếng Việt

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    // Thiết lập mã hóa tiếng Việt
    $conn->set_charset("utf8");
   
}
?>
