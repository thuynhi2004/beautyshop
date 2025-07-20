<?php
session_start();
include 'connect.php';
require_once 'config.php';

// Dữ liệu trả về từ VNPAY
$vnp_ResponseCode = $_GET['vnp_ResponseCode'] ?? '';
$vnp_TxnRef = $_GET['vnp_TxnRef'] ?? '';
$vnp_Amount = $_GET['vnp_Amount'] ?? 0;

// Nếu thanh toán thành công
if ($vnp_ResponseCode === '00') {
    // Nếu bạn có cột 'trangThai' trong bảng donhang thì có thể cập nhật ở đây
    // Ví dụ:
    // $order_id = $_SESSION['order_id_vnpay'] ?? 0;
    // if ($order_id > 0) {
    //     $stmt = $conn->prepare("UPDATE donhang SET trangThai = 'Đã thanh toán' WHERE ma_donhang = ?");
    //     $stmt->bind_param("i", $order_id);
    //     $stmt->execute();
    //     $stmt->close();
    // }    

    // Xoá session tạm
    unset($_SESSION['order_id_vnpay']);

    echo "<script>alert('Thanh toán thành công qua VNPAY!'); window.location.href='index.php';</script>";
} else {
    echo "<script>alert('Thanh toán không thành công hoặc bị huỷ!'); window.location.href='cart.php';</script>";
}
?>
