<?php
include 'connect.php';

$sql = "SELECT 
            DATE_FORMAT(ngayDat, '%Y-%m') AS thang,
            SUM(total) AS doanh_thu
        FROM donhang
        WHERE trangthai != 'Đã huỷ'
        GROUP BY thang
        ORDER BY thang ASC";

$result = $conn->query($sql);

$arr_thang = [];
$arr_doanhThu = [];

while ($row = $result->fetch_assoc()) {
    $arr_thang[] = $row['thang'];
    $arr_doanhThu[] = $row['doanh_thu'];
}
?>

<div style="width: 1100px; height: 600px; margin: auto;">
  <canvas id="doanhThuThangChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const thang = <?php echo json_encode($arr_thang); ?>;
    const doanhThu = <?php echo json_encode($arr_doanhThu); ?>;

    const ctxDoanhthu = document.getElementById('doanhThuThangChart').getContext('2d');
    new Chart(ctxDoanhthu, {
        type: 'bar',
        data: {
            labels: thang,
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: doanhThu,
                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                borderRadius: 6,
                barThickness: 50
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tháng'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Doanh thu (VNĐ)'
                    }
                }
            },
           plugins: {
            title: {
            display: true,
            text: 'Doanh thu theo từng tháng',
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
