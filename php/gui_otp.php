<?php
session_start();
include 'connect.php'; // nếu cần kiểm tra email trong CSDL

// Nhận email người dùng nhập
$email = $_POST['email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email không hợp lệ.");
}

// Tạo mã OTP ngẫu nhiên (6 chữ số)
$otp = rand(100000, 999999);

// Lưu vào SESSION để xác minh sau
$_SESSION['otp'] = $otp;
$_SESSION['email_reset'] = $email;
$_SESSION['otp_time'] = time(); // lưu thời gian tạo OTP

// Gửi email bằng PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';

try {
    // Cấu hình SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tnhi26781@gmail.com';          // ✅ Gmail của bạn
    $mail->Password = 'jvzw mqxa milg qapu';             // ✅ Mật khẩu ứng dụng Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Thông tin người gửi và người nhận
    $mail->setFrom('your_gmail@gmail.com', 'BeautyShop gửi bạn otp đặt lại mật khẩu!');
    $mail->addAddress($email);

    // Nội dung email
    $mail->isHTML(true);
    $mail->Subject = 'Mã OTP đặt lại mật khẩu';
    $mail->Body = "
        <h3>Mã OTP của bạn là:</h3>
        <div style='font-size:24px; font-weight:bold; color:#e91e63;'>$otp</div>
        <p>Mã có hiệu lực trong 5 phút. Vui lòng không chia sẻ mã này.</p>
    ";

    $mail->send();
    header("Location: nhap_otp.php");
    exit;

} catch (Exception $e) {
    echo "Không gửi được email. Lỗi: {$mail->ErrorInfo}";
}
?>
