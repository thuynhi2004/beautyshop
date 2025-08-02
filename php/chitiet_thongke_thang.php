<?php
include 'connect.php';

if (!isset($_GET['thang'])) {
    echo "Thiếu tháng.";
    exit;
}

$thang = $_GET['thang']; // dạng: YYYY-MM

$sql = "SELECT 
            d.ma_donhang,
            d.tenKH,
            d.ngayDat,
            s.tenSP,
            s.hinhAnh,
            sz.ten_size AS size,
            c.soLuong,
            c.giaBan,
            (c.soLuong * c.giaBan) AS tongTienSP
        FROM donhang d
        JOIN donhang_chitiet c ON d.ma_donhang = c.ma_donhang
        JOIN sanpham s ON c.maSP = s.maSP
        LEFT JOIN size sz ON c.ma_size = sz.ma_size
        WHERE DATE_FORMAT(d.ngayDat, '%Y-%m') = ? 
          AND d.trangthai != 'Đã huỷ'
        ORDER BY d.ma_donhang, d.ngayDat ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $thang);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng tháng <?php echo htmlspecialchars($thang); ?></title>
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/chitiet_thongke_admin.css">
    <style>
        tr.separator-row td {
            border-top: 2px solid #d87093;
        }
    </style>
</head>
<body>
    <div>
        <h2 class="xem-donhang">Chi tiết các đơn hàng trong tháng "<?php echo htmlspecialchars($thang); ?>"</h2>

        <table class="donhang-admin" id="cart-table">
            <tr>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th>Ngày đặt</th>
            </tr>

<?php 
if ($result->num_rows > 0) {
    $orders = [];

    while ($row = $result->fetch_assoc()) {
        $orders[$row['ma_donhang']]['info'] = [
            'tenKH' => $row['tenKH'],
            'ngayDat' => $row['ngayDat']
        ];
        $orders[$row['ma_donhang']]['items'][] = $row;
    }

    foreach ($orders as $ma_don => $order) {
        $rowspan = count($order['items']);
        $first = true;

        // Tổng tiền đơn
        $tongTienDon = 0;
        foreach ($order['items'] as $item) {
            $tongTienDon += $item['giaBan'];
        }
        $tongTienFormatted = number_format($tongTienDon, 0, ',', '.') . " VNĐ";

        foreach ($order['items'] as $item) {
            echo "<tr>";

            if ($first) {
                echo "<td rowspan='$rowspan'>" . $ma_don . "</td>";
                echo "<td rowspan='$rowspan'>" . htmlspecialchars($order['info']['tenKH']) . "</td>";
            }

            echo "<td><img src='" . $item['hinhAnh'] . "' alt='Ảnh' width='60'></td>";
            echo "<td>" . $item['tenSP'] . "</td>";
            $donGia = $item['soLuong'] > 0 ? $item['giaBan'] / $item['soLuong'] : 0;
            echo "<td>" . number_format($donGia, 0, ',', '.') . " đ</td>";
            echo "<td>" . ($item['size'] ?? '-') . "</td>";
            echo "<td>" . $item['soLuong'] . "</td>";

            if ($first) {
                echo "<td rowspan='$rowspan'>" . $tongTienFormatted . "</td>";
                echo "<td rowspan='$rowspan'>" . $order['info']['ngayDat'] . "</td>";
            }

            echo "</tr>";
            $first = false;
        }

        echo "<tr class='phancach'><td colspan='9'></td></tr>";
    }
} else {
    echo "<tr><td colspan='9'>Không có đơn hàng nào trong tháng này.</td></tr>";
}
?>
        </table>

        <button class="btn-cart-admin" onclick="window.history.back()">Quay lại</button>
    </div>
</body>
</html>
