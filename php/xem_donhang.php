<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['hoten'])) {
    echo "<script>
        alert('Vui lòng đăng nhập để xem đơn hàng của bạn!');
        window.location.href = 'dangnhap.php';
    </script>";
    exit;
}

$tenKH = $_SESSION['hoten']; // dùng đúng tên session đã lưu

$sql = "SELECT 
    d.tenKH,
    d.ngayDat,
    d.trangthai,
    s.tenSP,
    s.hinhAnh,
    c.soLuong,
    c.giaBan,
    (c.soLuong * c.giaBan) AS tongTien
FROM donhang d
JOIN donhang_chitiet c ON d.ma_donhang = c.ma_donhang
JOIN sanpham s ON c.maSP = s.maSP
WHERE d.tenKH = ?
ORDER BY d.ngayDat ASC";


$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tenKH);
$stmt->execute();
$result = $stmt->get_result();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" >
    <title> BeautyShop </title>
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/xem_donhang.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
 
<style>
    .carousel-item img {
        image-rendering: crisp-edges;
        filter: contrast(110%) brightness(105%);
        -webkit-optimize-contrast: 2;
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

</style>
</head>

<body class="cart-body">

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
          <a class="navbar-brand" href="">
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
                  <li><a href="index.php?temp=suaruamat" style="text-decoration: none;">🧴Sữa rửa mặt </a></li>
                  <li><a href="index.php?temp=kemchongnang" style="text-decoration: none;">🌞 Kem chống nắng </a></li>
                  <li><a href="index.php?temp=trangdiemmoi" style="text-decoration: none;">👄Trang điểm môi </a></li>
                  <li><a href="index.php?temp=taytrang" style="text-decoration: none;">🧽Tẩy trang </a></li>
                  <li><a href="index.php?temp=kemnen_phanphu" style="text-decoration: none;">🧏‍♀️Kem nền-Phấn phủ </a></li>
                  <li><a href="index.php?temp=main" style="text-decoration: none;">🛍️Tất cả </a></li>
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
    
      <h2 class="xem-donhang">
    Đơn hàng của "<?php echo htmlspecialchars($_SESSION['hoten']);?>"
</h2>


    <form id="cart-form" method="POST">
        <table id="cart-table">
            <tr>
    <th>Hình ảnh</th>
    <th>Tên sản phẩm</th>
    <th>Giá</th>
    <th>Số lượng</th>
    <th>Tổng tiền</th>
    <th>Ngày đặt</th>
    <th>Trạng thái</th>
  </tr>

<?php
$orders = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[$row['ngayDat']][] = $row;
    }

    foreach ($orders as $ngayDat => $items):
        $rowspan = count($items);
        $tongGia = 0;
        foreach ($items as $item) {
            $tongGia += $item['giaBan'];
        }
        $tongGiaFormatted = number_format($tongGia, 0, ',', '.') . ' VNĐ';

        foreach ($items as $index => $row):
            $gia = number_format($row['giaBan'], 0, ',', '.') . ' VNĐ';
            $soluong = $row['soLuong'];
?>
<tr>
    <td><img src="<?php echo $row['hinhAnh']; ?>" alt="Ảnh" width="60"></td>
    <td><?php echo $row['tenSP']; ?></td>
    <td style="color: #d87093;"><?php echo $gia; ?></td>
    <td><?php echo $soluong; ?></td>

    <?php if ($index === 0): ?>
        <td style="color: #d87093;" rowspan="<?php echo $rowspan; ?>"><?php echo $tongGiaFormatted; ?></td>
        <td rowspan="<?php echo $rowspan; ?>"><?php echo $ngayDat; ?></td>
        <td rowspan="<?php echo $rowspan; ?>"><?php echo $row['trangthai']; ?></td>
    <?php endif; ?>
</tr>
<?php endforeach; ?>

<!-- Dòng phân cách -->
<tr>
    <td colspan="7" style="border-top: 2px solid #d87093;"></td>
</tr>

<?php endforeach; ?>

<?php } else { ?>
<tr>
    <td colspan="7">Bạn chưa có đơn hàng nào.</td>
</tr>
<?php } ?>

    </table>

        <button class="btn-cart" type="button" onclick="window.location.href='../index.php'">Trang chủ</button>
        <button class="btn-cart" type="button" onclick="window.location.href='cart.php'">Giỏ hàng</button>
        
    </form>

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
              <img src="../img/bct.png" alt="" style="width: 150px;">
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
 src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.007!2d105.7817961!3d10.0302531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTDCsDE4JzEwLjkiTiAxMDXCsDQ2JzU0LjUiRQ!5e0!3m2!1svi!2s!4v1623456789!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy">            >
            </iframe>
     </div>
    </footer>
    <div class="container-fluid bg-black text-white text-center p-2">
      © Bản quyền thuộc về EGANY | Cung cấp bởi Haravan
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html> 