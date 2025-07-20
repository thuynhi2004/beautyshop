<?php
include 'connect.php';

//hàm random màu
function randomColor() {
    $r = rand(100, 255);
    $g = rand(100, 255);
    $b = rand(100, 255);
    return "rgb($r, $g, $b)";
}


$sql = "SELECT * FROM danhgia WHERE thaotac = 'duyệt' ORDER BY ngaydanhgia ASC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
        $ten_viettat = strtoupper(substr($row['hoten'], 0, 1));
        $ngay = date("d/m/Y", strtotime($row['ngaydanhgia']));
        $sosao = (int)$row['sosao'];
?>
    <div style="display: flex; align-items: flex-start; margin-bottom: 20px;">
        <!-- Vòng tròn chữ cái -->
        <?php
            $bg_color = randomColor(); // gọi hàm mỗi khi hiển thị đánh giá
        ?>
        <div style="width: 40px; height: 40px; border-radius: 50%; background-color: <?= $bg_color ?>; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 18px; margin-right: 12px;">
            <?= $ten_viettat ?>
        </div>

        <!-- Thông tin đánh giá -->
        <div>
            <strong><?= htmlspecialchars($ten_viettat) ?>***</strong>
            <div style="color: #888; font-size: 13px; margin-bottom: 4px;"><?= $ngay ?></div>

            <!-- Hiển thị số sao -->
            <div style="color: gold; font-size: 16px; margin-bottom: 5px;">
                <?= str_repeat("★", $sosao) . str_repeat("☆", 5 - $sosao) ?>
            </div>

            <!-- Nội dung -->
            <p style="margin: 0;"><?= htmlspecialchars($row['noidung']) ?></p>
        </div>
    </div>
    <hr style="border: none; border-top: 1px solid #ccc; margin: 15px 0;">
<?php
    endwhile;
else:
    echo "<p>Chưa có đánh giá nào.</p>";
endif;
?>


