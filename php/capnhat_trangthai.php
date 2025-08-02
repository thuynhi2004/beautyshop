<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ma_donhang = intval($_POST['ma_donhang']);
    $trangthai_moi = $_POST['trangthai'];

    // Lấy trạng thái hiện tại
    $result = $conn->query("SELECT trangthai FROM donhang WHERE ma_donhang = $ma_donhang");
    $row = $result->fetch_assoc();
    $trangthai_hientai = $row['trangthai'];

    // Danh sách trạng thái hợp lệ tiếp theo (quy trình A ➜ B ➜ C ➜ D)
    $transitions = [
        'Đang xác nhận' => ['Đã xác nhận'],
        'Đã xác nhận'   => ['Đang giao'],
        'Đang giao'     => ['Hoàn thành', 'Đã huỷ'],
        'Hoàn thành'    => [], // Không cho phép đổi nữa
        'Đã huỷ'        => []  // Không cho phép đổi nữa
    ];

    // Kiểm tra nếu trạng thái mới hợp lệ với trạng thái hiện tại
    if (in_array($trangthai_moi, $transitions[$trangthai_hientai] ?? [])) {
        $stmt = $conn->prepare("UPDATE donhang SET trangthai = ? WHERE ma_donhang = ?");
        $stmt->bind_param("si", $trangthai_moi, $ma_donhang);
        $stmt->execute();
        $stmt->close();
    } else {
        // Không hợp lệ thì quay về và báo lỗi
        header("Location: admin.php?error=not-allowed");
        exit();
    }

    // Nếu ok thì quay lại trang admin
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

  select.value = trangThaiHienTai;

  // Reset: disable hết
  for (let option of select.options) {
    option.disabled = true;
    option.style.color = "gray";
  }

  // Quy định chuyển trạng thái (theo thứ tự hợp lệ)
  const transitions = {
    "Đang xác nhận": ["Đã xác nhận"],
    "Đã xác nhận": ["Đang giao"],
    "Đang giao": ["Hoàn thành", "Đã huỷ"],
    "Hoàn thành": [],
    "Đã huỷ": [],
  };

  // Lấy danh sách trạng thái có thể chọn tiếp theo
  const allowedNext = transitions[trangThaiHienTai] || [];

  // Cho phép chọn trạng thái hiện tại để hiển thị (nhưng disabled)
  const currentOption = select.querySelector(`option[value="${trangThaiHienTai}"]`);
  if (currentOption) {
    currentOption.disabled = false;
    currentOption.style.color = "black";
  }

  // Bật trạng thái kế tiếp (nếu có)
  allowedNext.forEach(status => {
    const opt = select.querySelector(`option[value="${status}"]`);
    if (opt) {
      opt.disabled = false;
      opt.style.color = "black";
    }
  });

  // Nếu là "Hoàn thành" hoặc "Đã huỷ", thì khóa toàn bộ
  if (trangThaiHienTai === "Hoàn thành" || trangThaiHienTai === "Đã huỷ") {
    select.disabled = true;
  } else {
    select.disabled = false;
  }
}

</script>

