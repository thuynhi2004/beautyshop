<?php
session_start();
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<div class="forgot-password-container">
    <div class="forgot-password-box">
        <span class="close-btn" onclick="closeForgotForm()">✕</span>
        <h2><span class="lock-icon">🔐</span> Nhập mã OTP</h2>
        <p>Vui lòng kiểm tra email và nhập mã OTP để tiếp tục.</p>

        <?php if ($error): ?>
            <p style="color: red; font-size: 13px; margin-bottom: 10px;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="otp_reset.php" method="POST">
            <input type="text" name="otp_input" placeholder="Nhập mã OTP..." required>
            <button type="submit">Xác nhận</button>
        </form>
    </div>
</div>

<script>
    function closeForgotForm() {
        window.location.href = "dangnhap.php";
    }
</script>

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

.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 20px;
    cursor: pointer;
    color: #fff;
}

.forgot-password-box h2 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #ffd700;
}

.lock-icon {
    margin-right: 5px;
}

.forgot-password-box p {
    font-size: 14px;
    margin-bottom: 20px;
    color: #ccc;
}

.forgot-password-box input[type="text"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 14px;
}

.forgot-password-box button {
    width: 100px;
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
