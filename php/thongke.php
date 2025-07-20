<?php
include 'connect.php';

$sql = "SELECT 
            DATE(ngayDat) AS ngay, 
            COUNT(*) AS so_don, 
            SUM(total) AS tong_tien
        FROM donhang
        WHERE trangthai != 'Đã huỷ'
        GROUP BY DATE(ngayDat)
        ORDER BY ngay ASC";

$result = $conn->query($sql);
$stt = 1;

while ($row = $result->fetch_assoc()) {
    echo "<tr class='ngay-thongke'>"; // thêm class để JS lọc
    echo "<td>" . $stt++ . "</td>";
    echo "<td>" . $row['ngay'] . "</td>"; // YYYY-MM-DD
    echo "<td>" . $row['so_don'] . "</td>";
    echo "<td>" . number_format($row['tong_tien'], 0, ',', '.') . " VNĐ</td>";
    echo "<td><a href='chitiet_thongke.php?ngay=" . $row['ngay'] . "' class='btn btn-success' style='text-decoration: none;'>Xem</a>
    <a href='xuatexcel_ngay.php?ngay=" . $row['ngay'] . "' class='btn btn-success' style='text-decoration: none;'>Xuất Excel</a>
    </td>";
    
    echo "</tr>";
}
?>
