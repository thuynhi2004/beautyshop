<?php
// Kết nối CSDL
include("connect.php");

// Kiểm tra xem có dữ liệu POST gửi lên không
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Câu lệnh xoá sản phẩm
    $sql = "DELETE FROM sanpham WHERE maSP = ?";

    // Chuẩn bị truy vấn an toàn
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Xoá sản phẩm thành công!";
        } else {
            echo "Lỗi khi xoá sản phẩm: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Lỗi truy vấn: " . $conn->error;
    }
} else {
    echo "Dữ liệu không hợp lệ.";
}

$conn->close();
?>
