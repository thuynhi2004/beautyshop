<?php
include 'connect.php';

// Kiểm tra nếu có tham số ngày
if (!isset($_GET['ngay'])) {
    die("Thiếu ngày cần xuất dữ liệu.");
}

$ngay = $_GET['ngay'];

// Đặt tiêu đề để trình duyệt hiểu đây là file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=donhang_$ngay.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Câu truy vấn để lấy đơn hàng theo ngày
$sql = "SELECT 
            d.ma_donhang,
            d.tenKH,
            d.sdt,
            d.diachi,
            d.ngayDat,
            d.total,
            d.trangthai
        FROM donhang d
        WHERE DATE(d.ngayDat) = ? AND d.trangthai != 'Đã huỷ'
        ORDER BY d.ngayDat ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $ngay);
$stmt->execute();
$result = $stmt->get_result();

// In CSS để định dạng bảng Excel
echo "<style>
        table {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
      </style>";

// In tiêu đề bảng
echo "<table>";

echo "<tr>
        <th colspan='7' style='font-size:16pt; text-align:center; padding:10px'>
            Thống kê đơn hàng ngày $ngay
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

// In từng dòng dữ liệu
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
