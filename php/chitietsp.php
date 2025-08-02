<?php
session_start();
// Thông tin kết nối
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'webquanao';

 // Tạo kết nối
 $conn = new mysqli($server, $user, $pass, $database);
 
 // Thêm dòng này để set UTF-8
 mysqli_set_charset($conn, "utf8mb4");
 
 // Kiểm tra kết nối
 if ($conn->connect_error) {
     die("Kết nối thất bại: " . $conn->connect_error);
 }

    // Lấy ID sản phẩm từ URL
    if (isset($_GET['maSP'])) {
        $id = intval($_GET['maSP']); // Ép kiểu để tránh lỗi SQL Injection

        // Truy vấn lấy thông tin sản phẩm với điều kiện WHERE
        $sql = "SELECT * FROM sanpham WHERE maSP = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "Sản phẩm không tồn tại!";
            exit();
        }
    } else {
        echo "Không có sản phẩm nào được chọn!";
        exit();
    }
?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['tenSP']; ?></title>
    <link rel="stylesheet" href="../css/chitiet_sp.css">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

<style>

/* thanh navbar  */

.navbar-brand img {
  width: 100px;
}

.navbar {
  background-color: #f1f1f1; /* Màu nền của navbar */
  color: white;
}

.navbar-nav a {
  text-decoration: none; /* Bỏ gạch chân */
  color: black; /* Màu chữ */
}

.navbar-nav a:hover {
  color: #33cc99; /* Màu khi hover */
  text-decoration: none; /* Bỏ gạch chân khi hover */
}

 /* footer */
/*map*/
.contact-content-right {
  width: 100%; /* Đảm bảo phần chứa bản đồ không vượt quá khung */
  max-width: 400px; /* Giới hạn chiều rộng tối đa */
}

.map {
  width: 100%;
  height: 400px; /* Đảm bảo chiều cao cố định */
  overflow: hidden; /* Ngăn bản đồ tràn ra ngoài */
  border-radius: 10px; /* Bo góc nhẹ */
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
}

.map iframe {
  width: 100%;
  height: 100%;
  border: none;
  border-radius: 10px;
}
/*footer*/
.container {
  margin-bottom: 0; /* Loại bỏ khoảng cách dưới */
}

.product-image {
  position: relative;
  width: 500px;
}

.product-image img {
  width: 100%;
  display: block;
}

#zoom-lens {
  position: absolute;
  width: 200px;
  height: 200px;
  border: 2px solid red;
  border-radius: 50%;
  visibility: hidden;
  pointer-events: none;
  background-repeat: no-repeat;
  background-size: 800px 800px;
  z-index: 100;
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
</head>

<body>

<!-- header  -->
<div class="header-bar">
        <div class="container">
            <div class="header-content">
                <!-- Left: Location -->
                <div class="header-left">
                    <div class="location-info">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Địa chỉ: 162/1, Đường 3/2, Ninh Kiều, Cần Thơ</span>
                    </div>
                </div>

                <!-- Center: Auth Links -->
                <div class="header-center">
                    <div class="auth-links">
                        <?php
                        if (!isset($_SESSION['hoten'])) {
                            echo '<a href="dangki.php">Đăng ký</a> | <a href="dangnhap.php">Đăng nhập</a>';
                        } else {
                            echo '<span class="welcome-message">Xin Chào:  ' . htmlspecialchars($_SESSION['hoten']) . '</span>';
                            echo ' | <a href="dangxuat.php" class="logout-button">Đăng xuất</a>'; 
                            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                                echo ' | <a href="admin.php" class="logout-button"> Quản Trị</a>';
                            }
                        }
                    ?>
                    </div>
                </div>
            

                <!-- Right: Contact Info -->
                <div class="header-right">
                    <div class="contact-info">
                        <div class="contact-item">
                            <span>Hotline:</span>
                            <a href="tel:0879342732">0879 342 732</a>
                        </div>
                        <span class="divider">|</span>
                        <div class="contact-item">
                            <span>Email:</span>
                            <a href="mailto:hohuynh@gmail.com">webmipham@gmail.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


<nav class="navbar navbar-expand-lg border-bottom sticky-top  ">
        <div class="container">
          <a class="navbar-brand" href="../index.php">
            <img class="logo" src="../img/logo.png" alt="Bootstrap"  />
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!--menu item-->
            <ul class="navbar-nav mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.php"
                  >Trang Chủ
                </a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle fw-bold"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Danh Mục Sản Phẩm
                </a>
                <ul class="dropdown-menu">               
                  <li><a href="../index.php?temp=suaruamat" style="text-decoration: none;">🧴Sữa rửa mặt </a></li>
                  <li><a href="../index.php?temp=kemchongnang" style="text-decoration: none;">🌞 Kem chống nắng </a></li>
                  <li><a href="../index.php?temp=trangdiemmoi" style="text-decoration: none;">👄Trang điểm môi </a></li>
                  <li><a href="../index.php?temp=taytrang" style="text-decoration: none;">🧽Tẩy trang </a></li>
                  <li><a href="../index.php?temp=kemnen_phanphu" style="text-decoration: none;">🧏‍♀️Kem nền-Phấn phủ </a></li>
                  <li><a href="../index.php?temp=main" style="text-decoration: none;">🛍️Tất cả </a></li>
                </ul>
              </li>
               <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="cart.php"
                  >Đặt Hàng 
                </a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Giới Thiệu
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="vechungtoi.php">Về chúng tôi </a></li>                   
                </ul>
              </li>
               
               <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="trang_lienhe.php"
                  >Liên Hệ 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="trang_danhgia.php"
                  >Đánh giá 
                </a>
              </li>
            </ul>
            

            <!--fromsearch -->

            <form class="d-flex mx-auto ms-5 search-bar" action="timkiemsp.php" method="GET" role="search">
              <input
                 name="keyword"
                class="form-control me-0 search-input"
                type="search"
                placeholder="Tìm kiếm..."
                aria-label="Search"
              />
              <button class="btn btn-success search-btn" type="submit">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="18px "
                  height="18px "
                  viewBox="0 0 512 512"
                >
                  <!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                  <path
                    fill="#ffffff"
                    d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                  />
                </svg>
              </button>
            </form>

            <!--gio hang dang nhap yeu thich -->
            
          </div>
        </div>
</nav>
   
  
<!-- Ảnh sản phẩm -->
<div class="product-detail-container">
  <div class="product-image">
  <img id="product-img" src="<?php echo $row['hinhAnh']; ?>" alt="<?php echo $row['tenSP']; ?>">
  <div id="zoom-lens"></div>
  </div>
</div>  

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const img = document.getElementById("product-img");
    const lens = document.getElementById("zoom-lens");
    const zoom = 3; // tăng zoom tỉ lệ lên

    lens.style.backgroundImage = `url('${img.src}')`;

    img.addEventListener("mousemove", function (e) {
      const rect = img.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      const lensX = x - lens.offsetWidth / 2;
      const lensY = y - lens.offsetHeight / 2;

      lens.style.left = `${lensX}px`;
      lens.style.top = `${lensY}px`;
      lens.style.visibility = "visible";

      lens.style.backgroundSize = `${img.width * zoom}px ${img.height * zoom}px`;
      lens.style.backgroundPosition = `-${x * zoom - lens.offsetWidth / 2}px -${y * zoom - lens.offsetHeight / 2}px`;
    });

    img.addEventListener("mouseleave", function () {
      lens.style.visibility = "hidden";
    });
  });
</script>


<!-- Thông tin sản phẩm -->
 <div class="product-info-wrapper">
  <div class="product-info">
    <div class="product-header">
        <h1 class="product-title"><?php echo $row['tenSP']; ?></h1>
        <p class="product-price"><?php echo number_format($row['giaBan'], 0, ',', '.'); ?> <span class="currency">VNĐ</span></p>
    </div>

    <div class="product-box">
        <strong>Mô tả:</strong>
        <p class="product-description"><?php echo $row['moTa']; ?></p>
    </div>

    <div class="product-box">
        <strong>Thành phần:</strong>
        <p class="product-description"><?php echo $row['thanhPhan']; ?></p>
    </div>

    <div class="product-box">
        <strong>Chất Liệu:</strong>
        <p class="product-description"><?php echo $row['congDung']; ?></p>
    </div>

    <div class="product-box">
        <strong>Xuất xứ:</strong>
        <p class="product-description"><?php echo $row['huongDanSuDung']; ?></p>
    </div>

    <div class="product-actions">
        <a href="cart.php?add=<?php echo $row['maSP']; ?>" class="add-to-cart-btn">Thêm vào giỏ hàng</a>
        <a href="../index.php" class="back-btn"><strong>Quay lại trang chủ</strong></a>
    </div>
</div>
</div>

<h2>CÁC SẢN PHẨM LIÊN QUAN</h2>
<div class="container3">
  <div class="product-grid">
<?php
$maSP = $_GET['maSP'];
$sql = "SELECT * FROM sanpham WHERE maSP = '$maSP'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Lấy mã danh mục của sản phẩm hiện tại
$ma_danhmuc = $row['ma_danhmuc'];

// Truy vấn các sản phẩm liên quan cùng danh mục (loại trừ chính nó)
$sql_related = "SELECT * FROM sanpham WHERE ma_danhmuc = '$ma_danhmuc' AND maSP != '$maSP' LIMIT 12";
$result_related = $conn->query($sql_related);

if ($result_related->num_rows > 0) {
    while ($related = $result_related->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<a href="chitietsp.php?maSP=' . $related['maSP'] . '">';
        echo '<img src="' . $related['hinhAnh'] . '" alt="' . $related['tenSP'] . '" class="product-anh">';
        echo '</a>';
        echo '<h3 class="product-name">' . $related['tenSP'] . '</h3>';
        echo '<p class="product-gia">Giá: ' . number_format($related['giaBan'], 0, ',', '.') . ' VNĐ</p>';
        echo '<div class="button-group">';
        echo '<a href="#" 
        class="add-to-cart open-modal" 
        data-masp="' . $related['maSP'] . '" 
        data-ten="' . htmlspecialchars($related['tenSP']) . '" 
        data-hinh="' . $related['hinhAnh'] . '" 
        data-gia="' . $related['giaBan'] . '">Thêm giỏ hàng</a>';
        echo '<a href="chitietsp.php?maSP=' . $related['maSP'] . '" class="add-to-cart view-button">Xem</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>Không có sản phẩm nào cùng danh mục.</p>';
}
?>
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
        const url = `cart.php?maSP=${currentProduct.maSP}&size=${size.value}`;
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

 <!-- Footer -->
 <footer class="text-bg-dark py-5">
      <div class="container">
        
        <div class="row">
          <div class="col-md-4">
            <div class="text-start mx-4 mb-2">
            <a class="navbar-brand" href="#">
                <img src="img/logo_thebadgold.png" alt="Bootstrap" style="width: 150px; height: 80px;"/>
            </a>
              <p class="small text-start">
                Thương hiệu siêu thị uy tín và chất lượng, cam kết mang đến
                những trải nghiệm mua sắm tiện lợi, hiện đại và phong phú.
              </p>
              <div class="small text-start">
                <i class="fa-solid fa-location-dot"></i> Địa chỉ: 162/1, Đường 3/2, Ninh Kiều, Cần Thơ.
              </div>
              <div class="small text-start">
                <i class="fa-solid fa-phone-volume"></i> Hotline: 0879 342 732
              </div>
              <div class="small text-start">
                <i class="fa-solid fa-envelope"></i> Email: webmipham@gmail.com
              </div>
            </div>
          </div>
          <div class="small col-md-2">
            <h6>Hỗ trợ khách hàng</h6>
            <ul class="mb-2">
              <li>
                <a class="text-decoration-none" href="trang_lienhe.php"
                  >Liên hệ </a
                >
              </li>
              <li>
                <a class="text-decoration-none" href=""
                  >Hệ thống cửa hàng</a
                >
              </li>
              <li>
                <a class="text-decoration-none" href="">Tìm kiếm</a>
              </li>
              <li>
                <a class="text-decoration-none" href="vechungtoi.php"
                  >Giới thiệu</a
                >
              </li>
            </ul>
          </div>
          <div class="small col-md-3">
            <h6>Chính sách</h6>
            <ul>
              <li>
                <a class="text-decoration-none" href="chinhsach_nguoisohuu.php"
                  >Chính sách người sở hữu</a
                >
              </li>
              <li>
                <a class="text-decoration-none" href="chinhsach_baohanh.php"
                  >Chính sách bảo hành </a
                >
              </li>
              <li>
                <a class="text-decoration-none" href="chinhsach_doitra.php"
                  >Chính sách đổi trả </a
                >
              </li>
              <li>
                <a class="text-decoration-none" href="chinhsach_thanhtoan.php"
                  >Chính sách thanh toán </a
                >
              </li>
              <li>
                <a class="text-decoration-none" href="chinhsach_vanchuyen.php"
                  >Chính sách vận chuyển-giao nhận </a
                >
              </li>
              <li>
                <a class="text-decoration-none" href="chinhsach_baomat.php"
                  >Chính sách bảo mật </a
                >
              </li>
              <li>
                <a class="text-decoration-none" href="php/thongtin_giaca.php"
                  >Thông tin về giá cả </a
                >
              </li>
              <li>
                <a class="text-decoration-none" href="huongdan_muahang.php"
                  >Hướng dẫn mua hàng và thanh toán online </a
                >
              </li>
            </ul>
            
            <h6>Tổng đài hỗ trợ</h6>
            <ul>
              <li>
                <a class="text-decoration-none text-light" href=""
                  >Gọi mua hàng: 19006750 (8h-20h)</a
                >
              </li>
              <li>
                <a class="text-decoration-none text-light" href=""
                  >Gọi bảo hành: 19006750 (8h-20h)</a
                >
              </li>
            </ul>
          </div>
          <div class="col-md-3 footer">
          
            <h6>MẠNG XÃ HỘI</h6>
            <div class="d-flex flex-column gap-2">
              <a
                href="#!"
                class="btn btn-primary mb-2 px-2 py-1 rounded-pill d-inline-flex align-items-center justify-content-center"
                style="width: 160px; font-size: 0.85rem"
              >
                <i class="fa-brands fa-facebook me-1"></i>
                <span>Facebook</span>
              </a>
            </div>

            <div>
              <a
                href="#!"
                class="btn btn-danger px-2 py-1 rounded-pill d-inline-flex align-items-center justify-content-center"
                style="width: 160px; font-size: 0.85rem"
              >
                <i class="fa-brands fa-youtube me-1"></i>
                <span>Youtube</span>
              </a>
            </div>

            <div style="margin-top: 10px;">
              <a href="http://online.gov.vn/">
                <img src="../img/bct.png" alt="" style="width: 150px;">
              </a>
            </div>
            
          </div>
        </div>
       </div>
      <div class="map">
            <iframe
              width="100%"
              height="100%"
              style="border: 0"
              loading="lazy"
              allowfullscreen
              referrerpolicy="no-referrer-when-downgrade"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.901259159674!2d105.7546174!3d10.0545924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a088754269a041%3A0x831ba81bc1736db4!2zMjM1Lzc4LzI1IMSQ4buTbmcgVsSDbiBD4buTbmc!5e0!3m2!1svi!2s!4v1711496789012"
            >
            </iframe>
     </div>
    </footer>
    <div class="container-fluid bg-black text-white text-center p-2">
      © Bản quyền thuộc về EGANY | Cung cấp bởi Haravan
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    
</body>
</html>

<?php
    $conn->close();
?>
