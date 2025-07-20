    <?php
    include 'connect.php';

    $sql = "SELECT 
                DATE_FORMAT(ngayDat, '%Y-%m') AS thang,
                COUNT(*) AS so_don,
                SUM(total) AS tong_tien
            FROM donhang
            WHERE trangthai != 'Đã huỷ'
            GROUP BY DATE_FORMAT(ngayDat, '%Y-%m')
            ORDER BY thang ASC";

    $result = $conn->query($sql);
    $stt = 1;

    while ($row = $result->fetch_assoc()) {
        echo "<tr class='row-thongke'>";
        echo "<td>" . $stt++ . "</td>";

        // Hiển thị định dạng Tháng/Năm (vd: 07/2025)
        $thang_nam = date("m/Y", strtotime($row['thang'] . "-01"));
        echo "<td>" . $thang_nam . "</td>";

        echo "<td>" . $row['so_don'] . "</td>";
        echo "<td>" . number_format($row['tong_tien'], 0, ',', '.') . " VNĐ</td>";

        // Gửi dạng YYYY-MM sang chitiet_thongke.php
        echo "<td><a href='chitiet_thongke_thang.php?thang=" . $row['thang'] . "' class='btn btn-success' style='text-decoration: none;'>Xem</a>
        <a href='xuatexcel_thang.php?thang=" . $row['thang'] . "' class='btn btn-success' style='text-decoration: none;'>Xuất Excel</a>
        </td>";
        echo "</tr>";
    }
    ?>
