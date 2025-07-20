<?php
session_start();
include 'connect.php';

// Nếu chưa gửi OTP thì quay về
if (!isset($_SESSION['otp'], $_SESSION['email_reset'], $_SESSION['otp_time'])) {
    header("Location: quen_mk.php");
    exit;
}

$email = $_SESSION['email_reset'];
$error = '';
$step = 'otp'; // Bước hiện tại: nhập OTP

// Xử lý nhập OTP
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['otp_input'])) {
    $otp_input = trim($_POST['otp_input']);
    $otp_session = $_SESSION['otp'];
    $otp_time = $_SESSION['otp_time'];

    // Hết hạn sau 5 phút
    if (time() - $otp_time > 300) {
        unset($_SESSION['otp']);
        $error = "⚠️ Mã OTP đã hết hạn. Vui lòng gửi lại.";
    } elseif ($otp_input != $otp_session) {
        $error = "Mã OTP không đúng.";
    } else {
        // Xác minh thành công
        $_SESSION['otp_verified'] = true;
        $step = 'reset'; // chuyển sang bước nhập mật khẩu
    }
}

// Xử lý cập nhật mật khẩu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_password'])) {
    if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
        $error = "⚠️ Bạn chưa xác minh OTP.";
        $step = 'otp';
    } else {
        $new = $_POST['new_password'];
        $confirm = $_POST['confirm_password'];

        if ($new !== $confirm) {
            $error = "Mật khẩu xác nhận không khớp.";
            $step = 'reset';
        } else {
            $hashed = password_hash($new, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE users SET matkhau = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashed, $email);
            if ($stmt->execute()) {
                // Xóa session và chuyển đến đăng nhập
                unset($_SESSION['otp'], $_SESSION['otp_time'], $_SESSION['otp_verified'], $_SESSION['email_reset']);

                echo "<script>alert('Mật khẩu đã được đặt lại. Vui lòng đăng nhập lại!'); 
                window.location.href = 'dangnhap.php';</script>";
                exit;
            } else {
                $error = "❌ Cập nhật mật khẩu thất bại.";
                $step = 'reset';
            }
        }
    }
}
?>

<!-- Giao diện HTML -->
<div class="forgot-password-container">
    <div class="forgot-password-box">
        <h2><?php echo $step === 'otp' ? "🔐 Nhập mã OTP" : "🔒 Đặt lại mật khẩu"; ?></h2>
        <p>
            <?php
            echo $step === 'otp'
                ? "Vui lòng kiểm tra email và nhập mã OTP."
                : "Nhập mật khẩu mới cho tài khoản của bạn.";
            ?>
        </p>

        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($step === 'otp'): ?>
            <form method="POST">
                <input type="text" name="otp_input" placeholder="Nhập mã OTP..." required>
                <button type="submit">Xác nhận</button>
            </form>
        <?php else: ?>
            <form method="POST">
                <input type="password" name="new_password" placeholder="Mật khẩu mới" required>
                <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
                <button type="submit">Đổi mật khẩu</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<style>

.forgot-password-container {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

.forgot-password-box {
    background: #1c1c1c;
    color: #fff;
    padding: 30px 25px;
    border-radius: 12px;
    width: 320px;
    position: relative;
    text-align: center;
    font-family: 'Arial', sans-serif;
    animation: fadeIn 0.3s ease-in-out;
}

.forgot-password-box input {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 14px;
}

.forgot-password-box button {
    width: 150px;
    padding: 10px;
    background: linear-gradient(to right, #ffcc00, #ff9900);
    border: none;
    border-radius: 8px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease;
}

.forgot-password-box button:hover {
    background: linear-gradient(to right, #ffc107, #ff5722);
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
</style>