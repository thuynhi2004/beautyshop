<style>
/* Khung sản phẩm */
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  padding: 20px;
  padding-bottom: 100px;
  background-color: rgb(220, 193, 193);
  border-radius: 20px;
  box-shadow: 0 4px 12px rgba(45, 12, 12, 0.1);
}


.container2 {
  max-width: 1850px;
  margin: 0 auto;     /* canh giữa */
  padding: 20px;
}

.product-card:hover {
  border: 2px solid green; /* viền xanh lá */
  box-shadow: 0 8px 16px rgba(0, 128, 0, 0.3); /* đổ bóng xanh nhạt */
  transform: translateY(-6px); /* nổi nhẹ lên */
  transition: all 0.3s ease;  /* mượt mà */
}


/* Mỗi sản phẩm */
.product-card {
  width: 280px;
  background-color: #fff;
  border-radius: 10px;
  border: 1px solid #ccc;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 15px;
  text-align: center;
}

/* Ảnh sản phẩm */
.product-image {
  width: 100%;
  height: 200px;
  object-fit: contain;
  margin-bottom: 10px;
}

/* Tên sản phẩm */
.product-name {
  font-size: 18px;
  font-weight: bold;
  margin: 10px 0;
}

.product-name a {
  text-decoration: none;
  color: black;
}

.product-name a:hover {
  text-decoration: none;
  color: green;
}

/* Giá sản phẩm */
.product-price {
  color: red;
  font-weight: bold;
  margin-bottom: 10px;
}

/* Nút giỏ hàng */
.add-to-cart {
  display: inline-block;
  background-color: green;
  color: white;
  padding: 8px 12px;
  border-radius: 5px;
  text-decoration: none;
}

.add-to-cart:hover {
  background-color: darkgreen;
}

/* thêm giỏ hàng */
.button-group {
  display: flex;
  justify-content: center;
  gap: 10px; /* Khoảng cách giữa 2 nút */
  margin-top: 10px;
}

/* nút xem */
.view-button {
  background-color: #dc3545; /* đỏ */
}

.view-button:hover {
  background-color: darkred; /* đỏ đậm khi hover */
}

/* Đảm bảo pagination nằm ở hàng cuối */
.pagination-container {
  grid-column: 1 / -1; /* Chiếm toàn bộ hàng trong grid */
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

/* Giao diện nút phân trang */
.pagination {
  padding: 10px 20px;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

.pagination a,
.pagination span {
  margin: 0 6px;
  padding: 6px 12px;
  text-decoration: none;
  font-weight: bold;
  color: #1a0dab;
  border-radius: 4px;
}

.pagination a:hover {
  background-color: #ddd;
}

.pagination .current-page {
  color: black;
  border-bottom: 2px solid black;
}

/*form chọn size*/
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}

.modal.show {
  display: block;
  opacity: 1;
  pointer-events: auto;
}

.modal-content {
  background-color: #fff;
  margin: 10% auto;
  padding: 20px;
  border-radius: 10px;
  width: 500px;
  position: relative;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.close-button {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 24px;
  cursor: pointer;
}

.modal-body {
  display: flex;
  align-items: flex-start;
  gap: 20px;
}

.modal-image {
  width: 180px;
  height: auto;
  object-fit: cover;
  border-radius: 8px;
}

.modal-details {
  flex: 1;
  text-align: left;
}

#modalTitle {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}

#modalPrice {
  font-size: 16px;
  color: #555;
}

.size-options {
  display: flex;
  gap: 10px;
  margin: 10px 0;
}

.size-option {
  cursor: pointer;
}

.size-option input[type="radio"] {
  display: none;
}

.size-option span {
  display: inline-block;
  padding: 8px 14px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #f8f9fa;
  transition: 0.3s;
}

.size-option input[type="radio"]:checked + span {
  background-color: #6c757d; /* màu xám */
  color: white;
  border-color: #6c757d;
}

.modal1 {
  display: none; /* mở bằng JS */
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  margin-top: 50px;
  overflow: auto;

}

.modal-content1 {
  background-color: #fff;
  margin: 100px auto;
  padding: 30px;
  border-radius: 10px;
  width: 80%;
  max-width: 600px;
  position: relative;
}

.close-button {
  position: absolute;
  top: 15px;
  right: 20px;
  font-size: 28px;
  font-weight: bold;
  color: #333;
  cursor: pointer;
  z-index: 10000;
}

.size-table {
  width: 100%;
  border-collapse: collapse;
  text-align: center;
  margin-top: 20px;
}

.size-table th, .size-table td {
  border: 1px solid #ccc;
  padding: 10px;
}


.size-guide {
  background-color: #f1f1f1;   /* nền xám nhạt */
  padding: 10px 12px;
  border-radius: 6px;
  cursor: pointer;
  display: inline-block;
  transition: background-color 0.3s ease;
  margin-top: 10px;
}

.size-guide:hover {
  background-color: #e0e0e0;
}

.size-guide span {
  color: #333;
  font-weight: 500;
}

</style>


<!-- Hiển thị sản phẩm -->
<div class="product-grid">
<?php

// Hiển thị lỗi (dành cho phát triển)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL
include 'php/connect.php';

// Cấu hình phân trang
$limit = 24; // Số sản phẩm mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$start = ($page - 1) * $limit;

// Lấy tổng số sản phẩm
$total_result = $conn->query("SELECT COUNT(*) AS total FROM sanpham");
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $limit);

// Truy vấn sản phẩm cho trang hiện tại
$sql = "SELECT * FROM sanpham LIMIT $start, $limit";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<a href="php/chitietsp.php?maSP=' . $row['maSP'] . '">';
        echo '<img class="product-image" src="' . $row['hinhAnh'] . '" alt="' . $row['tenSP'] . '">';
        echo '</a>';
        echo '<h3 class="product-name"><a href="chitietsp.php?maSP=' . $row['maSP'] . '">' . $row['tenSP'] . '</a></h3>';
        echo '<p class="product-price">Giá: ' . number_format($row['giaBan'], 0, ',', '.') . ' VNĐ</p>';
        echo '<div class="button-group">';
        echo '<a href="#" 
        class="add-to-cart open-modal" 
        data-masp="' . $row['maSP'] . '" 
        data-ten="' . htmlspecialchars($row['tenSP']) . '" 
        data-hinh="' . $row['hinhAnh'] . '" 
        data-gia="' . $row['giaBan'] . '">Thêm giỏ hàng</a>';
        echo '<a href="php/chitietsp.php?maSP=' . $row['maSP'] . '" class="add-to-cart view-button">Xem</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "Không có sản phẩm nào.";
}
?>

<!-- Hiển thị phân trang -->
<div class="pagination-container">
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo '<span class="current-page">' . $i . '</span>';
            } else {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
        }
        if ($page < $total_pages) {
            echo '<a href="?page=' . ($page + 1) . '">Tiếp theo</a>';
        }
        ?>
    </div>
</div>

</div>


<!-- Modal Chọn Size -->
<div id="productModal" class="modal">
  <div class="modal-content">
    <span class="close-button" onclick="closeModal()">&times;</span>

    <div class="modal-body">
      <img id="modalImage" src="" alt="Sản phẩm" class="modal-image">
      <div class="modal-details">
        <h3 id="modalTitle"></h3>
        <p id="modalPrice"></p>

        <!-- Link hướng dẫn chọn kích cỡ -->
      <div class="size-guide" onclick="openSizeGuide()">
        <span style="margin-left: 5px;">Hướng dẫn chọn kích cỡ</span>
      </div>  
    </div>

  </div>

  
    <div class="size-options">
      <label class="size-option">
        <input type="radio" name="size" value="S">
        <span>S</span>
      </label>

      <label class="size-option">
        <input type="radio" name="size" value="M">
        <span>M</span>
      </label>

      <label class="size-option">
        <input type="radio" name="size" value="L">
        <span>L</span>
      </label>

      <label class="size-option">
        <input type="radio" name="size" value="XL">
        <span>XL</span>
      </label>

    </div>

    <button class="add-to-cart" id="confirmAddToCart">Thêm giỏ hàng</button>
  </div>
</div>

<!-- Modal hướng dẫn chọn kích cỡ -->
<div id="sizeGuideModal" class="modal1">
  <div class="modal-content1">
    <span class="close-button" onclick="closeSizeGuide()">&times;</span>
    <h3>Hướng dẫn chọn kích cỡ</h3>

    <!-- Bảng size Áo -->
    <h4>Bảng size Áo</h4>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center; margin-bottom: 20px;">
      <thead>
        <tr>
          <th>Kích cỡ</th>
          <th>Dài (cm)</th>
          <th>Rộng</th>
          <th>Chiều cao (cm)</th>
          <th>Cân nặng (kg)</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>S</td><td>65</td><td>52</td><td>140-155</td><td>40-50</td></tr>
        <tr><td>M</td><td>68</td><td>55</td><td>150-165</td><td>50-60</td></tr>
        <tr><td>L</td><td>71</td><td>58</td><td>160-175</td><td>60-75</td></tr>
        <tr><td>XL</td><td>74</td><td>61</td><td>170-185</td><td>75-90</td></tr>
      </tbody>
    </table>

    <!-- Bảng size Quần -->
    <h4>Bảng size Quần</h4>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center; margin-bottom: 20px;">
      <thead>
        <tr>
          <th>Kích cỡ</th>
          <th>Lưng (cm)</th>
          <th>Dài (cm)</th>
          <th>Mông (cm)</th>
          <th>Chiều cao (cm)</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>S</td><td>60-65</td><td>90</td><td>75-80</td><td>145-155</td></tr>
        <tr><td>M</td><td>66-72</td><td>94</td><td>81-85</td><td>155-165</td></tr>
        <tr><td>L</td><td>73-79</td><td>98</td><td>86-90</td><td>165-175</td></tr>
        <tr><td>XL</td><td>80-86</td><td>102</td><td>91-100</td><td>175-185</td></tr>
      </tbody>
    </table>

  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('productModal');
    const closeBtn = document.querySelector('.close-button');
    const modalImage = document.getElementById('modalImage');
    const modalTitle = document.getElementById('modalTitle');
    const modalPrice = document.getElementById('modalPrice');
    const confirmBtn = document.getElementById('confirmAddToCart');
    let currentProduct = {};

    document.querySelectorAll('.open-modal').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            // Lấy dữ liệu sản phẩm
            const maSP = this.dataset.masp;
            const tenSP = this.dataset.ten;
            const hinhAnh = this.dataset.hinh;
            const giaBan = parseInt(this.dataset.gia).toLocaleString('vi-VN') + ' VNĐ';

            // Lưu tạm
            currentProduct = { maSP: maSP };

            // Hiển thị vào modal
            modalImage.src = hinhAnh;
            modalTitle.textContent = tenSP;
            modalPrice.textContent = 'Giá: ' + giaBan;

            modal.style.display = 'block';
        });
    });

    // Đóng modal
    closeBtn.onclick = () => modal.style.display = 'none';
    window.onclick = (e) => { if (e.target == modal) modal.style.display = 'none'; }

    // Xác nhận thêm vào giỏ hàng
    confirmBtn.onclick = () => {
        const size = document.querySelector('input[name="size"]:checked');
        if (!size) {
            alert('Vui lòng chọn size!');
            return;
        }

        // Gửi tới PHP (có thể dùng AJAX, hoặc chuyển trang)
        const url = `php/cart.php?maSP=${currentProduct.maSP}&size=${size.value}`;
        window.location.href = url;
    };
});
</script>


<script>
  function openSizeGuide() {
  document.getElementById("sizeGuideModal").style.display = "block";
}
</script>

<script>
  function closeSizeGuide() {
  document.getElementById("sizeGuideModal").style.display = "none";
}
</script>


