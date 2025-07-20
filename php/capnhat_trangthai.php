<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ma_donhang = intval($_POST['ma_donhang']);
    $trangthai_moi = $_POST['trangthai'];

    // Lấy trạng thái hiện tại
    $result = $conn->query("SELECT trangthai FROM donhang WHERE ma_donhang = $ma_donhang");
    $row = $result->fetch_assoc();
    $trangthai_hientai = $row['trangthai'];

    // Nếu đã là Hoàn thành hoặc Đã huỷ thì không cập nhật nữa
    if ($trangthai_hientai === 'Hoàn thành' || $trangthai_hientai === 'Đã huỷ') {
        header("Location: admin.php?error=not-allowed");
        exit();
    }

    // Nếu đang là Đang giao thì cho phép cập nhật sang Hoàn thành hoặc Đã huỷ
    if ($trangthai_hientai === 'Đang giao' && 
       ($trangthai_moi === 'Hoàn thành' || $trangthai_moi === 'Đã huỷ')) {
        $stmt = $conn->prepare("UPDATE donhang SET trangthai = ? WHERE ma_donhang = ?");
        $stmt->bind_param("si", $trangthai_moi, $ma_donhang);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: admin.php");
    exit();
}

?>

<script>
function openUpdateModal(maDonHang, trangThaiHienTai) {
  const modal = document.getElementById("updateModal");
  modal.style.display = "block";
  document.getElementById("modal_ma_donhang").value = maDonHang;

  const select = document.getElementById("modal_trangthai");

  // Gán giá trị hiện tại để hiển thị đúng ô bên trên
  select.value = trangThaiHienTai;

  // Reset trạng thái option
  for (let option of select.options) {
    option.disabled = false;
    option.style.color = "black";
  }

  // Nếu trạng thái là "Hoàn thành"
  if (trangThaiHienTai === "Hoàn thành") {
    for (let option of select.options) {
      if (option.value !== "Hoàn thành") {
        option.disabled = true;
        option.style.color = "gray";
      }
    }
    return;
  }

  // Nếu trạng thái là "Đã huỷ"
  if (trangThaiHienTai === "Đã huỷ") {
    for (let option of select.options) {
      if (option.value !== "Đã huỷ") {
        option.disabled = true;
        option.style.color = "gray";
      }
    }
    return;
  }

  // Nếu đang là "Đang giao", cho phép chọn "Hoàn thành" hoặc "Đã huỷ", disable chính nó
  if (trangThaiHienTai === "Đang giao") {
    for (let option of select.options) {
      if (option.value === "Đang giao") {
        option.disabled = true;
        option.style.color = "gray";
      }
    }

    // Khi chọn trạng thái mới, khóa luôn các lựa chọn khác
    select.onchange = function () {
      for (let option of select.options) {
        if (option.value !== select.value) {
          option.disabled = true;
          option.style.color = "gray";
        }
      }
    };
  }
}
</script>

