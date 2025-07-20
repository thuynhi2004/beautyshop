<style>
/* Khung sản phẩm */
.product-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  gap: 20px;
  padding: 10px;
  padding-bottom: 100px;
  background-color: rgb(220, 193, 193);
  border-radius: 20px; /*  Bo góc khung */
  box-shadow: 0 4px 12px rgba(45, 12, 12, 0.1);

}

.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.container2 {
  max-width: 1900px;
  margin: 0 auto;     /* canh giữa */
  padding: 20px;
}

.product {
  width: 280px;
  background-color: #fff;
  border-radius: 10px;
  border: 1px solid #ccc;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 15px;
  text-align: center;
}

.products-wrapper {
  display: grid;
  grid-template-columns: repeat(6, 1fr); /* 6 sản phẩm 1 hàng */
  gap: 20px;
  padding: 10px;
}

.product img {
    width: 100%;
    height: auto;
    max-height: 180px;
    object-fit: contain;
}


.product:hover {
    border: 2px solid #28a745; /* màu xanh lá */
    box-shadow: 0 0 10px rgba(40, 167, 69, 0.3); /* thêm hiệu ứng ánh sáng nhẹ */
    transform: translateY(-6px); /* nổi nhẹ lên */
    transition: all 0.3s ease;  /* mượt mà */
    
}


/* Tên sản phẩm */
.product-name {
  font-size: 18px;
  font-weight: bold;
  margin: 10px 0;
  text-decoration: none;
  color: green;
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

</style>

<div class="product-grid">
    <div class="products-wrapper">
<?php
    include 'connect.php';
    $sql = "SELECT * FROM sanpham WHERE ma_danhmuc=4"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product">';
            echo '<a href="chitietsp.php?maSP=' . $row['maSP'] . '">';
            echo '<img src="' . $row['hinhAnh'] . '" alt="' . $row['tenSP'] . '">';
            echo '</a>';
            echo '<a href="chitietsp.php?maSP=' . $row['maSP'] . '" class="product-name">' . $row['tenSP'] . '</a>';
            echo '<p class="product-price">Giá: ' . number_format($row['giaBan'], 0, ',', '.') . ' VNĐ</p>';
            echo '<div class="button-group">';
            echo '<a href="../php/cart.php?maSP=' . $row['maSP'] . '" class="add-to-cart">Thêm giỏ hàng</a>';
            echo '<a href="../php/chitietsp.php?maSP=' . $row['maSP'] . '" class="add-to-cart view-button">Xem</a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Không có sản phẩm nào.";
    }
?>
</div>
</div>




