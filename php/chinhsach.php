<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Chính sách người sở hữu </title>
    <link rel="stylesheet" href="../css/index.css">
    <style>


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
  color: #007bff; /* Màu khi hover */
  text-decoration: none; /* Bỏ gạch chân khi hover */
}
/*thanh tìm kiếm*/
.search-bar {
  display: flex;
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
  border-radius: 999px; /* Bo tròn toàn khối */
  overflow: hidden;
  background-color: #fff;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  border: 1px solid #ccc;
}

.search-input {
  flex: 1;
  border: none;
  padding: 12px 20px;
  outline: none;
  font-size: 16px;
  font-style: italic;
  background-color: #fff;
}

.search-btn {
  width: 50px;
  background-color: #063e2e;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background-color 0.3s;
}

.search-btn:hover {
  background-color: #085f44;
}

.search-btn svg {
  width: 20px;
  height: 20px;
  color: white;
}


    
</style>

       
</head>

<body>

<!-- header  -->

<nav class="small navbar navbar-expand-lg border-bottom sticky-top  ">
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="../img/logo.png" alt="Bootstrap" style="width: 150px; height: 50px;" />
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
                <a class="nav-link active" aria-current="page" href="index.php"
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
                  Danh Mục sản phẩm
                </a>
                <ul class="dropdown-menu">
                
                  <li><a href="index.php?temp=suaruamat">🧴Sữa rửa mặt </a></li>
                  <li><a href="index.php?temp=kemchongnang">🌞 Kem chống nắng </a></li>
                  <li><a href="index.php?temp=trangdiemmoi">👄Trang điểm môi </a></li>
                </ul>
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
                  <li><a class="dropdown-item" href="chinhsachnguoisohuu.php">Chính sách  </a></li>
                  <!-- <li><a class="dropdown-item" href="lienhe.php">Hỗ trợ </a></li> -->
                </ul>
              </li>
              <li class="nav-item">
               
                <a class="nav-link" aria-disabled="true" href="lienhe.php">Liên Hệ </a>
              </li>
            </ul>

            <!--fromsearch -->

            <form class="d-flex mx-auto ms-5 search-bar" action="timkiemsp.php" method="GET" role="search">
              <input
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



<!-- biểu mẫu  -->





    <!-- <div class="top-bar">
        <div class="container4"> -->
            <!-- <div class="box-left">
                <span>Địa chỉ: 25/10, Đồng Văn Cống, An Thới, Bình Thủy, Cần Thơ</span>
            </div> -->
            <!-- <div class="box-center"> -->
                    <?php
                        /*session_start();
                        if (!isset($_SESSION['TenDangNhap'])) {
                            echo '<a href="dangki.php">Đăng ký</a> | <a href="dangnhap.php">Đăng nhập</a>';
                        } else {
                            echo '<span class="welcome-message"> Chào:  ' . htmlspecialchars($_SESSION['TenDangNhap']) . '</span>';
                            echo ' | <a href="dangxuat.php" class="logout-button">Đăng xuất</a>'; 
                            if (isset($_SESSION['VaiTro']) && $_SESSION['VaiTro'] === 'admin') {
                                echo ' | <a href="home_ad.php"> Quản Trị</a>';
                            }
                        }*/
                    ?>
            <!-- </div> -->
            
            <!-- <div class="box-right">
                <span style="float: right;">Hotline: 0943 253 467 | Email: minthow123@gmail.com</span>
            </div> -->
        </div>
    <!-- </div> -->

    <header class="header">
        <li class="cart">
        <a href="cart.php"><img src="../img/cart-icon.png" alt="Cart Icon"></a>
        </li>
        <!-- <img src="img/hinh-anh.jpg" alt="Bộ Công Thương" style="max-width: 150px; margin-top: 10px;">
        </a> -->
    </header>

   <!-- biểu mẫu liên hệ  -->

    <div class="container">
        <header>
            <h2>Chính sách khách hàng sử dụng BEAUTYSHOP  </h2>
        </header>
        <main>
            <section>
                <h4 >1. Chính Sách Đổi Trả</h4>
                <ul>
                    <li>Thời gian đổi trả: Khách hàng có thể đổi hoặc trả hàng trong vòng 7-14 ngày kể từ ngày nhận hàng.</li>
                    <li>Điều kiện đổi trả: Sản phẩm phải còn nguyên tem, bao bì, chưa qua sử dụng và không bị hư hại.</li>
                    <li>Phí vận chuyển: Khách hàng chịu phí vận chuyển khi đổi trả sản phẩm.</li>
                </ul>
            </section>
            
            <section>
                <h4 >2.  Chính Sách Bảo Hành</h4>
                <ul>
                    <li>Thời gian bảo hành: Các sản phẩm có thể có thời gian bảo hành từ 6 tháng đến 1 năm tùy theo nhà sản xuất.</li>
                    <li>Điều kiện bảo hành: Sản phẩm bị lỗi do nhà sản xuất sẽ được bảo hành miễn phí.</li>
                </ul>
            </section>
            
            <section>
                <h4 >3.  Chính Sách Giao Hàng</h4>
                <ul>
                    <li>Thời gian giao hàng: Đơn hàng sẽ được xử lý và giao trong vòng 3-5 ngày làm việc.</li>
                    <li>Phí giao hàng: Miễn phí giao hàng cho đơn hàng trên một mức giá nhất định (ví dụ: 500.000 VNĐ).</li>
                </ul>
            </section>
            
            <section>
                <h4 >4. Chính Sách Thanh Toán</h4>
                <ul>
                    <li>Phương thức thanh toán: Hỗ trợ nhiều phương thức thanh toán như chuyển khoản ngân hàng, COD (giao hàng thu tiền), thanh toán qua thẻ tín dụng.</li>
                    <li>Hóa đơn: Khách hàng sẽ nhận được hóa đơn điện tử hoặc hóa đơn giấy kèm theo đơn hàng.</li>
                    
                </ul>
            </section>
            
            <section>
                <h4 >5. Chính Sách Bảo Mật Thông Tin</h4>
                <p>Bảo mật thông tin: Tất cả thông tin cá nhân của khách hàng sẽ được bảo mật và không chia sẻ cho bên thứ ba mà không có sự đồng ý của khách hàng.</p>
            </section>
            
            <section>
                <h4 >6.Hỗ Trợ Khách Hàng</h4>
                <p>Nếu bạn có bất kỳ câu hỏi nào về chính sách này, vui lòng liên hệ với chúng tôi qua:</p>
                <p><strong>Email:</strong>hohuynh@gmail.com</p>
                <p><strong>Hotline:</strong> 0879 342 732 </p>
                <p><strong>Địa chỉ:</strong> Đồng Văn Cống, An Thới, Bình Thủy, Cần Thơ</p>
            </section>
        </main>
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
                <i class="fa-solid fa-location-dot"></i> Địa chỉ: Đồng Văn Cống, An Thới, Bình Thủy, Cần Thơ.
              </div>
              <div class="small text-start">
                <i class="fa-solid fa-phone-volume"></i> Hotline: 09876340987634
              </div>
              <div class="small text-start">
                <i class="fa-solid fa-envelope"></i> Email: ho353huynh@gmail.com
              </div>
            </div>
          </div>
          <div class="small col-md-2">
            <h6>Hỗ trợ khách hàng</h6>
            <ul class="mb-2">
              <li>
                <a class="text-decoration-none text-light" href="lienhe.php"
                  >Liên hệ </a
                >
              </li>
              <li>
                <a class="text-decoration-none text-light" href=""
                  >Hệ thống cửa hàng</a
                >
              </li>
              <li>
                <a class="text-decoration-none text-light" href="">Tìm kiếm</a>
              </li>
              <li>
                <a class="text-decoration-none text-light" href=""
                  >Giới thiệu</a
                >
              </li>
              <li>
              <a class="text-decoration-none text-light" href="lienhe.php">Liên hệ</a>
              </li>
            </ul>
          </div>
          <div class="small col-md-3">
            <h6>Chính sách</h6>
            <ul>
              <li>
                <a class="text-decoration-none text-light" href="chinhsachnguoisohuu.php"
                  >Chính sách người sở hữu</a
                >
              </li>
              <li>
                <a class="text-decoration-none text-light" href="chinhsachdoitra.php"
                  >Chính sách đổi trả </a
                >
              </li>
              <li>
                <a class="text-decoration-none text-light" href="chinhsachthanhtoan.php"
                  >Chính sách thanh toán </a
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


