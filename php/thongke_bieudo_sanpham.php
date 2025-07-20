<?php
include 'connect.php';

$sql = "SELECT sp.tenSP, SUM(ct.soLuong) AS tong_luot_dat
        FROM donhang_chitiet ct
        JOIN sanpham sp ON ct.maSP = sp.maSP
        JOIN donhang d ON ct.ma_donhang = d.ma_donhang
        WHERE d.trangthai != 'Đã hủy'
        GROUP BY ct.maSP
        ORDER BY tong_luot_dat DESC
        LIMIT 10";

$result = $conn->query($sql);

$arr_tenSP = [];
$arr_luotDat = [];

while ($row = $result->fetch_assoc()) {
    $arr_tenSP[] = $row['tenSP'];
    $arr_luotDat[] = $row['tong_luot_dat'];
}

?>

<div style="width: 1100px; height: 600px; margin: auto;">
  <canvas id="topSanPhamChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const tenSP = <?php echo json_encode($arr_tenSP); ?>;
    const soLuotDat = <?php echo json_encode($arr_luotDat); ?>;

    const ctx = document.getElementById('topSanPhamChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: tenSP,
            datasets: [{
                label: 'Lượt đặt hàng',
                data: soLuotDat,
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                borderRadius: 8,
                barThickness: 55 // chỉnh chiều rộng cột
            }]
        },
        options: {
            
    //indexAxis: 'y', // biểu đồ ngang
    scales: {
        x: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Tên sản phẩm'
            }
        },
        y: {
            title: {
                display: true,
                text: 'Lượt đặt hàng'
            }
        }
    },
    plugins: {
        title: {
            display: true,
            text: 'Top 10 sản phẩm bán chạy',
            font: {
                size: 20,
                weight: 'bold'
            },
            padding: {
                top: 10,
                bottom: 30
            },
            color: '#333'
        },
        legend: { display: false }
    }
}

    });
</script>
