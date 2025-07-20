<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['maSP']; 
    $tensp = $_POST['tenSP'];
    $gia = $_POST['giaBan'];
    $mota = $_POST['moTa'];
    $thanhphan = $_POST['thanhPhan'];
    $congdung = $_POST['congDung'];
    $huongdansudung = $_POST['huongDanSuDung'];
    $soLuong = $_POST['soLuong'];


    if ($_FILES['hinhAnh']['name']) {
        $hinhanh = $_FILES['hinhAnh'];
        if ($hinhanh['error'] == 0) {
            $image_url = "img/" . basename($hinhanh['name']);
            move_uploaded_file($hinhanh['tmp_name'], $image_url);
        } else {
            echo "Lỗi trong quá trình tải lên hình ảnh.";
            $image_url = $_POST['old_image']; 
        }
    } else {
        $image_url = $_POST['old_image'];
    }


    $sql = "UPDATE sanpham 
            SET tenSP='$tensp', giaBan='$gia', hinhAnh='$image_url', moTa='$mota', thanhPhan='$thanhphan', congDung= '$congdung', huongDanSuDung='$huongdansudung' ,soLuong='$soLuong'
            WHERE maSP='$id'";
    if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('Cập nhật sản phẩm thành công!');
        window.location.href = 'admin.php';
    </script>";
    exit();
    } else {
        echo "Lỗi cập nhật: " . $conn->error;
    }
    } else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM sanpham WHERE maSP='$id'";
        $result = $conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            echo "Không tìm thấy sản phẩm với mã: $id";
            exit(); // Dừng chương trình nếu không có sản phẩm
        }
    } else {
        echo "Không có mã sản phẩm được cung cấp.";
        exit(); // Dừng chương trình nếu không có tham số id
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sua_sp.css">
    <title>Chỉnh sửa sản phẩm</title>
</head>
<body>

<h2>Chỉnh sửa sản phẩm</h2>

<form method="post" enctype="multipart/form-data">
    <!-- Mã sản phẩm -->
    <label for="maSP">Mã Sản phẩm:</label>
    <input type="text" name="maSP" value="<?php echo $product['maSP']; ?>" readonly>
    <input type="hidden" name="old_image" value="<?php echo $product['hinhAnh']; ?>">

    <!-- Tên sản phẩm -->
    <label for="tenSP">Tên:</label>
    <input type="text" id="tenSP" name="tenSP" value="<?php echo $product['tenSP']; ?>"><br><br>

    <!-- Giá bán -->
    <label for="giaBan">Giá:</label>
    <input type="text" id="giaBan" name="giaBan" value="<?php echo $product['giaBan']; ?>"><br><br>

    <!-- Mô tả -->
    <label for="moTa">Mô tả:</label>
    <input type="text" id="moTa" name="moTa" value="<?php echo $product['moTa']; ?>"><br><br>

    <!-- Thành Phần -->
    <label for="thanhPhan">Thành Phần:</label>
    <input type="text" id="thanhPhan" name="thanhPhan" value="<?php echo $product['thanhPhan']; ?>"><br><br>

    <!-- Công Dụng -->
    <label for="thanhPhan">Công Dụng:</label>
    <input type="text" id="congDung" name="congDung" value="<?php echo $product['congDung']; ?>"><br><br>

    <!-- Hướng dẫn sử dụng -->
    <label for="huongDanSuDung">Hướng Dẫn Sử Dụng:</label>
    <input type="text" id="huongDanSuDung" name="huongDanSuDung" value="<?php echo $product['huongDanSuDung']; ?>"><br><br>

    <!-- Số lượng-->
    <label for="soLuong">Số lượng:</label>
    <input type="text" id="soLuong" name="soLuong" value="<?php echo $product['soLuong']; ?>"><br><br>

    <!-- Hình ảnh hiện tại -->
    <label for="hinhAnh">Hình ảnh hiện tại:</label><br>
    <img id="oldImage" height="100px" width="150px" src="<?php echo $product['hinhAnh']; ?>" alt="Hình sản phẩm"><br><br>

    <!-- Chọn hình ảnh mới -->
    <label for="hinhAnh">Chọn hình ảnh mới:</label>
    <input type="file" id="hinhAnh" name="hinhAnh" accept="image/*" onchange="previewImage(event)"><br><br>

    <!-- Xem trước hình ảnh mới -->
    <img id="preview" height="100px" width="150px" style="display:none;" alt="Xem trước hình ảnh mới"><br><br>

    <!-- Nút lưu thay đổi -->
    <button type="submit" class="submit-btn">Lưu thay đổi</button>
    <a href="admin.php" class="submit-btn" style="text-decoration: none;">Quay lại</a>


</form>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const oldImage = document.getElementById('oldImage');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.style.display = 'block';
    oldImage.style.display = 'none';
}
</script>

<script>
document.querySelector('form').addEventListener('submit', function (e) {
    const tenSPInput = document.getElementById('tenSP');
    const giaInput = document.getElementById('giaBan');

    const tenSP = tenSPInput.value.trim();
    const gia = giaInput.value.trim();

    // Điều kiện 1: chỉ chứa chữ, số, khoảng trắng, gạch ngang
    const nameRegex = /^[A-Za-zÀ-ỹ0-9\s\-]+$/;
    // Điều kiện 2: phải có ít nhất một chữ cái (chữ có dấu hoặc không)
    const letterRegex = /[A-Za-zÀ-ỹ]/;

    if (!nameRegex.test(tenSP) || !letterRegex.test(tenSP)) {
        alert("Tên sản phẩm không hợp lệ!");
        tenSPInput.value = "";
        tenSPInput.focus();
        e.preventDefault();
        return;

    }

    // Kiểm tra giá là số dương
    const giaSo = parseFloat(gia);
    if (isNaN(giaSo) || giaSo <= 0) {
        alert("Giá sản phẩm không hợp lệ!");
        giaInput.focus();
        e.preventDefault();
        return;
    }
});
</script>



</body>
</html>