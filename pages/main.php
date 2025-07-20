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
        echo '<a href="php/cart.php?maSP=' . $row['maSP'] . '" class="add-to-cart">Thêm giỏ hàng</a>';
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
