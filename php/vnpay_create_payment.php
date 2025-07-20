<?php
session_start();
require 'config.php';
require 'connect.php';

// ✅ Kiểm tra mã đơn hàng đã tạo trước đó
if (!isset($_SESSION['order_id_vnpay'])) {
    die("Không tìm thấy đơn hàng cần thanh toán.");
}

$order_id = $_SESSION['order_id_vnpay'];

// ✅ Lấy thông tin đơn hàng từ DB
$stmt = $conn->prepare("SELECT total FROM donhang WHERE ma_donhang = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Đơn hàng không tồn tại trong hệ thống.");
}

$row = $result->fetch_assoc();
$total = intval(round($row['total'])) * 100; // Nhân 100 vì VNPAY cần đơn vị là x100
$client_ip = $_SERVER['REMOTE_ADDR'];

// ✅ Tạo dữ liệu thanh toán
$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $total,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $client_ip,
    "vnp_Locale" => "vn",
    "vnp_OrderInfo" => "Thanh toán đơn hàng #" . $order_id,
    "vnp_OrderType" => "other",
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $order_id
);

// ✅ Ký dữ liệu
ksort($inputData);
$hashdata = "";
$query = "";
$i = 0;
foreach ($inputData as $key => $value) {
    if ($i == 1) $hashdata .= '&';
    $hashdata .= urlencode($key) . "=" . urlencode($value);
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
    $i = 1;
}

$vnp_Url = $vnp_Url . "?" . $query;
$vnp_SecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
$vnp_Url .= 'vnp_SecureHash=' . $vnp_SecureHash;

// ✅ Điều hướng sang cổng VNPAY
header("Location: " . $vnp_Url);
exit();
?>
