<?php
include 'connect.php';

// Kiểm tra nếu có tham số tháng (định dạng yyyy-mm)
if (!isset($_GET['thang'])) {
    die("Thiếu tháng cần xuất dữ liệu.");
}

$thang = $_GET['thang'];

// Đặt tiêu đề để trình duyệt hiểu đây là file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=donhang_thang_$thang.xls");
header("Pragma: no-cache");
header("Expires: 0");


$sql = "SELECT 
            d.ma_donhang,
            d.tenKH,
            d.sdt,
            d.diachi,
            d.ngayDat,
            d.total,
            d.trangthai
        FROM donhang d
        WHERE DATE_FORMAT(d.ngayDat, '%Y-%m') = ? AND d.trangthai != 'Đã huỷ'
        ORDER BY d.ngayDat ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $thang);
$stmt->execute();
$result = $stmt->get_result();

echo "<style>
    table {
        font-family: 'Times New Roman', Times, serif;
        font-size: 12pt;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        border: 1px solid black;
    }
</style>";

echo "<table border='1'>";

// Gộp cột tiêu đề
echo "<tr>
        <th colspan='7' style='font-size:16pt; text-align:center; padding:10px'>
            Thống kê đơn hàng tháng " . date("m/Y", strtotime($thang . "-01")) . "
        </th>
      </tr>";

echo "<tr>
        <th>Mã đơn hàng</th>
        <th>Tên khách hàng</th>
        <th>SĐT</th>
        <th>Địa chỉ</th>
        <th>Ngày đặt</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
      </tr>";

// In dữ liệu
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['ma_donhang']}</td>";
    echo "<td>{$row['tenKH']}</td>";
    echo "<td>{$row['sdt']}</td>";
    echo "<td>{$row['diachi']}</td>";
    echo "<td>{$row['ngayDat']}</td>";
    echo "<td>" . number_format($row['total'], 0, ',', '.') . " VNĐ</td>";
    echo "<td>{$row['trangthai']}</td>";
    echo "</tr>";
}

echo "</table>";
?>
