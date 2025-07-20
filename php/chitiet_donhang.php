<?php 
session_start();
include 'connect.php';


if (!isset($_GET['id'])) {
    echo "Thiếu ID đơn hàng.";
    exit;
}

$ma_don = $_GET['id'];

$sql = "SELECT 
    d.tenKH,
    d.ngayDat,
    s.tenSP,
    s.hinhAnh,
    c.soLuong,
    c.giaBan,
    (c.soLuong * c.giaBan) AS tongTien
FROM donhang d
JOIN donhang_chitiet c ON d.ma_donhang = c.ma_donhang
JOIN sanpham s ON c.maSP = s.maSP
WHERE d.ma_donhang = ?
ORDER BY d.ngayDat ASC;
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ma_don); // i vì ma_donhang là số nguyên
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $first_row = $result->fetch_assoc();
    $tenKH = $first_row['tenKH'];
    $result->data_seek(0); // Quay lại dòng đầu để dùng tiếp
} else {
    echo "Không tìm thấy đơn hàng.";
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/xem_donhang_admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeautyShop</title>

    <style>
        .carousel-item img {
        image-rendering: crisp-edges;
        filter: contrast(110%) brightness(105%);
        -webkit-optimize-contrast: 2;
    }

    </style>
</head>
<body>
    <div>

        <h2 class="xem-donhang">
            Đơn hàng của "<?php echo htmlspecialchars($tenKH); ?>"
        </h2>

    <form id="cart-form" method="POST">
        <table class="donhang-admin" id="cart-table">
            <tr>
    <th>Hình ảnh</th>
    <th>Tên sản phẩm</th>
    <th>Giá</th>
    <th>Số lượng</th>
    <th>Tổng tiền</th>
    <th>Ngày đặt</th>
  </tr>

<?php
$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[$row['ngayDat']][] = $row;
    }

    foreach ($orders as $ngayDat => $items):
        $rowspan = count($items);
        $tongGia = 0;
        foreach ($items as $item) {
            $tongGia += $item['giaBan'];
        }
        $tongGiaFormatted = number_format($tongGia, 0, ',', '.') . ' VNĐ';

        foreach ($items as $index => $row):
            $gia = number_format($row['giaBan'], 0, ',', '.') . ' VNĐ';
            $soluong = $row['soLuong'];
?>
<tr>
    <td><img src="<?php echo $row['hinhAnh']; ?>" alt="Ảnh" width="60"></td>
    <td><?php echo $row['tenSP']; ?></td>
    <td><?php echo $gia; ?></td>
    <td><?php echo $soluong; ?></td>

    <?php if ($index === 0): ?>
        <td rowspan="<?php echo $rowspan; ?>"><?php echo $tongGiaFormatted; ?></td>
        <td rowspan="<?php echo $rowspan; ?>"><?php echo $ngayDat; ?></td>
    <?php endif; ?>
</tr>
<?php endforeach; ?>

<!-- Dòng phân cách -->
<tr>
    <td colspan="6" style="border-top: 2px solid #d87093;"></td>
</tr>

<?php endforeach; ?>

<?php } else { ?>
<tr>
    <td colspan="6">Bạn chưa có đơn hàng nào.</td>
</tr>
<?php } ?>

    </table>
        <button class="btn-cart-admin" type="button" onclick="window.location.href='admin.php'">Quay lại</button>
    </form>

    </div>
</body>
</html>