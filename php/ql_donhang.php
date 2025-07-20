<?php
include 'connect.php';

$sql = "SELECT * FROM donhang ORDER BY ngayDat ASC";
$result = $conn->query($sql);

// Hàm hiển thị trạng thái với màu
function hienTrangThai($trangthai) {
    switch ($trangthai) {
        case 'Đang giao': return '<span style="color: orange;">Đang giao</span>';
        case 'Hoàn thành': return '<span style="color: green;">Hoàn thành</span>';
        case 'Đã hủy': return '<span style="color: red;">Đã hủy</span>';
        default: return '<span style="color: gray;">Không rõ</span>';
    }
}

while ($row = $result->fetch_assoc()):
?>
<tr>
    <td><?php echo $row['ma_donhang']; ?></td>
    <td><?php echo htmlspecialchars($row['tenKH']); ?></td>
    <td><?php echo htmlspecialchars($row['mailKH']); ?></td>
    <td><?php echo htmlspecialchars($row['sdt']); ?></td>
    <td><?php echo $row['ngayDat']; ?></td>
    <td><?php echo number_format($row['total'], 0, ',', '.') . 'VNĐ'; ?></td>
    <td><?php echo hienTrangThai($row['trangthai']); ?></td>
    <td>
      <!-- Button Xem -->
      <button class="btn btn-success"
        onclick="window.location.href='chitiet_donhang.php?id=<?php echo $row['ma_donhang']; ?>'">
        Xem
      </button>

      <!-- Button Cập nhật -->
      <button class="btn btn-danger"
        onclick="openModal('<?php echo $row['ma_donhang']; ?>', '<?php echo $row['trangthai']; ?>')">
      Cập nhật
      </button>
    </td>

</tr>
<?php endwhile; ?>

<!-- Modal cập nhật trạng thái -->
<div id="updateModal" class="modal" style="display:none; position: fixed; top: 0; left: 0; width:100%; height:100%; background-color: rgba(0,0,0,0.5);">
  <div class="modal-content" style="background: white; padding: 20px; margin: 100px auto; width: 300px; border-radius: 8px; position: relative;">
    <span class="close" style="position:absolute; top: 10px; right: 15px; cursor:pointer;">&times;</span>
    <h3>Cập nhật trạng thái</h3>
    <form method="POST" action="capnhat_trangthai.php">
        <input type="hidden" name="ma_donhang" id="modal_ma_donhang">
        <label for="trangthai">Trạng thái:</label>
        <select name="trangthai" id="modal_trangthai">
          <option value="Đang giao">Đang giao</option>
          <option value="Hoàn thành">Hoàn thành</option>
          <option value="Đã huỷ">Đã huỷ</option>
        </select>

        <br><br>
        <!-- Nút lưu -->
        <button class="btn-luu" type="submit" >Lưu</button>

    </form>
  </div>
</div>

<script>
  // Mở modal
  function openModal(ma_donhang, currentStatus) {
    document.getElementById('modal_ma_donhang').value = ma_donhang;
    document.getElementById('modal_trangthai').value = currentStatus;
    document.getElementById('updateModal').style.display = 'block';
  }

  // Đóng modal khi click nút X
  document.querySelector('.close').onclick = function() {
    document.getElementById('updateModal').style.display = 'none';
  }

  // Đóng modal khi click ra ngoài modal
  window.onclick = function(event) {
    if (event.target == document.getElementById('updateModal')) {
      document.getElementById('updateModal').style.display = 'none';
    }
  }
</script>

<style>
    /* Overlay */
.modal {
    display: none;
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 200px;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
}

/* Nội dung modal */
.modal-content {
    background: #fff;
    margin: 5% auto;
    padding: 40px 35px;
    border-radius: 15px;
    max-width: 500px;
    width: 90%;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    position: relative;
    animation: slideDown 0.4s ease;
    font-family: 'Segoe UI', sans-serif;
}

/* Hiệu ứng mở */
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-40px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Nút đóng (x) */
.modal-content .close {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 28px;
    color: #888;
    cursor: pointer;
    transition: color 0.3s;
}
.modal-content .close:hover {
    color: #000;
}

/* Tiêu đề */
.modal-content h3 {
    margin: 0 0 25px;
    font-size: 24px;
    color: #333;
    font-weight: bold;
    text-align: center;
}

h3:hover {
    color: #3498db;
}
/* Label + Select */
.modal-content label {
    font-size: 18px;
    display: block;
    margin-bottom: 10px;
    color: #444;
}

.modal-content select {
    width: 100%;
    padding: 12px 16px;
    font-size: 16px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background: #f9f9f9;
    transition: border-color 0.3s;
}
.modal-content select:focus {
    border-color: #4CAF50;
    outline: none;
}

.btn-luu {
  background-color: #f5f5f5; /* Màu nền ban đầu */
  color: black;
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 10px 20px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-luu:hover {
  background-color: #3498db; /* Màu hồng đậm */
  color: white;
}

select option:disabled {
  color: gray;
}

</style>