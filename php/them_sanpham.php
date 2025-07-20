<?php
    include 'connect.php';  
     
    $danhmucQuery = "SELECT ma_danhmuc, ten_danhmuc FROM danhmuc";
    $danhmucResults = $conn->query($danhmucQuery);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tensp = $_POST['tensanpham'];
        $gia = $_POST['gia'];
        $danhmuc = $_POST['danhMuc'];
        $mota = $_POST['MoTa'];
        $thanhphan = $_POST['ThanhPhan'];
        $congdung = $_POST['CongDung'];
        $huongdansudung = $_POST['HuongDanSuDung'];
        $soluong = $_POST['soLuong'];
        if (isset($_FILES['hinhanh']) && $_FILES['hinhanh']['error'] == 0) {
            $hinh = $_FILES['hinhanh'];

            $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
            if (!in_array($hinh['type'], $allowed_types)) {
                echo "Chỉ hỗ trợ hình ảnh định dạng JPG, PNG và GIF.";
            } else {
                $target_dir = "img/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}
$target_file = $target_dir . basename($hinh['name']);


                if (move_uploaded_file($hinh['tmp_name'], $target_file)) {
                    $hinhPath = $target_file; 

                    $sql = "INSERT INTO sanpham (tenSP, giaBan, ma_danhmuc, hinhAnh, MoTa, ThanhPhan, CongDung, HuongDanSuDung, soLuong) 
                            VALUES ('$tensp', '$gia', '$danhmuc', '$hinhPath', '$mota', '$thanhphan', '$congdung', '$huongdansudung', '$soluong')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Thêm sản phẩm thành công!";
                        header("Location: admin.php");
                        exit;
                    } else {
                        echo "Lỗi: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Lỗi khi tải lên tệp hình ảnh.";
                }
            }
        } else {
            echo "Vui lòng chọn hình ảnh để tải lên.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THÊM SẢN PHẨM</title>
    <link rel="stylesheet" type="text/css" href="../css/them_sp.css">
</head>
<body>
    <div class="form-container">
        <h2 class="form-title">Thêm Sản Phẩm Mới</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Tên Sản Phẩm:</label>
                <input type="text" id="tensanpham" name="tensanpham" required>
            </div>


            <div class="form-group">
                <label for="category">Danh Mục:</label>
                <select id="danhMuc" name="danhMuc" required>
                    <option value="">Chọn danh mục</option>
                    <?php
                    if ($danhmucResults->num_rows > 0) {
                        while($row = $danhmucResults->fetch_assoc()) {
                            echo "<option value='" . $row['ma_danhmuc'] . "'>" . $row['ten_danhmuc'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Không có danh mục nào</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="product_name">Giá Sản Phẩm:</label>
                <input type="text" id="gia" name="gia" required>
            </div>

            
            <div class="form-group">
                <label for="MoTa">Mô tả:</label>
                <textarea id="MoTa" name="MoTa" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="ThanhPhan">Thành phần:</label>
                <textarea id="ThanhPhan" name="ThanhPhan" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="CongDung">Thành phần:</label>
                <textarea id="CongDung" name="CongDung" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label for="HuongDanSuDung">Hướng dẫn sử dụng:</label>
                <textarea id="HuongDanSuDung" name="HuongDanSuDung" rows="4"></textarea>
            </div>
        
            <div class="form-group">
                <label for="soLuong">Số lượng:</label>
                <input type="number" id="soLuong" name="soLuong" min="1" value="1" required>
            </div>

            <div class="image-upload">
                <label for="product_images">Hình Ảnh Sản Phẩm:</label>
                <input type="file" id="hinhanh" name="hinhanh" accept="image/*" required>
            </div>

            <button type="submit" class="submit-btn">Thêm Sản Phẩm</button>
            <a href="admin.php" class="submit-btn" style="text-decoration: none;">Quay lại</a>

        </form>
    </div>  

    <script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const tenSPInput = document.getElementById('tensanpham');
        const giaInput = document.getElementById('gia');

        const tenSP = tenSPInput.value.trim();
        const gia = giaInput.value.trim();

        const nameRegex = /^[A-Za-zÀ-ỹ0-9\s-]+$/;

       // Kiểm tra tên sản phẩm
        if (!nameRegex.test(tenSP) || /^\d+$/.test(tenSP)) {
            alert("Tên sản phẩm không hợp lệ!");
            tenSPInput.value = "";
            tenSPInput.focus();
            e.preventDefault();
            return;
        }

        // Kiểm tra giá sản phẩm
        const giaSo = parseFloat(gia);
        if (isNaN(giaSo) || giaSo <= 0) {
            alert("Giá sản phẩm không hợp lệ!");
            giaInput.value = "";    // Xóa nội dung ô input
            giaInput.focus();       // Đặt lại focus vào ô
            e.preventDefault();
            return;
        }
    });
   </script>

</body>
</html>
