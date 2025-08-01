<?php
include 'connect.php';

if (!isset($_GET['ngay'])) {
    echo "Thiếu ngày.";
    exit;
}

$ngay = $_GET['ngay'];

$sql = "SELECT 
            d.id AS ma_donhang,
            d.tenKH,
            d.ngayDat,
            ct.tenmon,
            ct.soluong,
            ct.gia,
            ct.thanhtien,
            m.hinhanh
        FROM donhang d
        JOIN chitiet_donhang ct ON d.id = ct.id_donhang
        LEFT JOIN menu m ON ct.tenmon = m.tenmon
        WHERE DATE(d.ngayDat) = DATE(?)
          AND d.trangthai != 'Đã huỷ'
        ORDER BY d.id, d.ngayDat ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ngay);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng ngày <?php echo htmlspecialchars($ngay); ?></title>
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/chitiet_thongke_admin.css">
    <style>
        tr.phancach td {
            border-top: 2px solid #d87093;
        }
        img.sp {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div>
        <h2 class="xem-donhang">Chi tiết các đơn hàng ngày "<?php echo htmlspecialchars($ngay); ?>"</h2>

        <table class="donhang-admin" id="cart-table">
            <tr>
                <th>Mã đơn</th>
                <th>Khách hàng</th>
                <th>Hình ảnh</th>
                <th>Tên món</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
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

        foreach ($order['items'] as $item) {
            echo "<tr>";

            if ($first) {
                echo "<td rowspan='$rowspan'>" . $ma_don . "</td>";
                echo "<td rowspan='$rowspan'>" . htmlspecialchars($order['info']['tenKH']) . "</td>";
            }

            // Hình ảnh
            $imgPath = (!empty($item['hinhanh'])) ? "../img/" . $item['hinhanh'] : "../img/default.png";
            echo "<td><img class='sp' src='$imgPath' alt='Ảnh món'></td>";

            echo "<td>" . htmlspecialchars($item['tenmon']) . "</td>";
            echo "<td>" . number_format($item['gia'], 0, ',', '.') . " đ</td>";
            echo "<td>" . $item['soluong'] . "</td>";
            echo "<td>" . number_format($item['thanhtien'], 0, ',', '.') . " đ</td>";

            if ($first) {
                echo "<td rowspan='$rowspan'>" . $order['info']['ngayDat'] . "</td>";
            }

            echo "</tr>";
            $first = false;
        }

        // Dòng phân cách
        echo "<tr class='phancach'><td colspan='8'></td></tr>";
    }
} else {
    echo "<tr><td colspan='8'>Không có đơn hàng nào trong ngày này.</td></tr>";
}
?>
        </table>

        <button class="btn-cart-admin" onclick="window.history.back()">Quay lại</button>
    </div>
</body>
</html>
