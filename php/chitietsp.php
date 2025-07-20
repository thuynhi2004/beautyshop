<?php
 $servername = "localhost";
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL (thường để trống trên XAMPP)
$dbname = "thuongmaidientu"; // Tên cơ sở dữ liệu của bạn
 
 // Tạo kết nối
 $conn = new mysqli($servername, $username, $password, $dbname);
 
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
                        session_start();
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
          <a class="navbar-brand" href="index.php">
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
                <a class="nav-link active" aria-current="page" href="index.php"
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
        <strong>Công Dụng:</strong>
        <p class="product-description"><?php echo $row['congDung']; ?></p>
    </div>

    <div class="product-box">
        <strong>Hướng dẫn sử dụng:</strong>
        <p class="product-description"><?php echo $row['huongDanSuDung']; ?></p>
    </div>

    <div class="product-actions">
        <a href="cart.php?add=<?php echo $row['maSP']; ?>" class="add-to-cart-btn">Thêm vào giỏ hàng</a>
        <a href="index.php" class="back-btn"><strong>Quay lại trang chủ</strong></a>
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
        echo '<a href="cart.php?maSP=' . $related['maSP'] . '" class="add-to-cart">Thêm giỏ hàng</a>';
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

 <!-- Footer -->
 <footer class="text-bg-dark py-5">
      <div class="container">
        
        <div class="row">
          <div class="col-md-4">
            <div class="text-start mx-4 mb-2">
            <a class="navbar-brand" href="#">
                <img src="./img/logoshop.png" alt="Bootstrap" style="width: 150px; height: auto;" />
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
              <img src="../img/bocongthuong.png" alt="">
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
