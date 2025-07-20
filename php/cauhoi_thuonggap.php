
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" >
    <title> BeautyShop </title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/chinhsach.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
 
<style>
    .carousel-item img {
        image-rendering: crisp-edges;
        filter: contrast(110%) brightness(105%);
        -webkit-optimize-contrast: 2;
    }

    .breadcrumb {
  margin-top: 20px;
  display: block;
  padding-left: 300px; 
}


.breadcrumb a {
  text-decoration: none;
  color: #007bff;
}

.breadcrumb a:hover {
  text-decoration: none;
  color:rgb(2, 72, 147);
}

.content p {
        text-align: justify; /* Đây là dòng quan trọng để canh đều 2 bên */
        line-height: 1.6;
        margin-bottom: 15px;
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
<body>

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
                <a class="nav-link active" aria-current="page" href="index.php"
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


    <div class="breadcrumb">
  <a href="index.php">Trang chủ</a> / Câu hỏi thường gặp
</div>

    <div class="container1">
  <div class="sidebar">
    <h3>Danh mục chính sách</h3>
    <ul>
        <li>
                <a  href="cauhoi_thuonggap.php"
                  >Câu hỏi thường gặp </a
                >
        </li>
        <li>
                <a  href="chinhsach_nguoisohuu.php"
                  >Chính sách người sở hữu </a
                >
        </li>
        <li>
                <a  href="chinhsach_baohanh.php"
                  >Chính sách bảo hành </a
                >
        </li>
        <li>
                <a  href="chinhsach_doitra.php"
                  >Chính sách đổi trả </a
                >
        </li>
        <li>
                <a  href="chinhsach_thanhtoan.php"
                  >Chính sách thanh toán </a
                >
        </li>
        <li>
                <a  href="chinhsach_vanchuyen.php"
                  >Chính sách vận chuyển-giao nhận </a
                >
        </li>
        <li>
                <a  href="chinhsach_baomat.php"
                  >Chính sách bảo mật </a
                >
        </li>
        <li>
                <a  href="huongdan_muahang.php"
                  >Hướng dẫn mua hàng online </a
                >
        </li>
        
    </ul>
  </div>

  <div class="content" >
    <h2>Câu hỏi thường gặp</h2>

<h5>1. Khi mua sản phẩm tại <strong>Beauty Shop</strong>, tôi có được bảo hành không?</h5>
<p>
Đối với các sản phẩm mỹ phẩm, Beauty Shop cam kết tất cả sản phẩm đều là hàng chính hãng. 
Do đặc thù sản phẩm tiêu dùng, chúng tôi không áp dụng chính sách bảo hành dài hạn mà chỉ hỗ trợ đổi trả trong vòng <strong>07 ngày</strong> nếu sản phẩm có lỗi do nhà sản xuất, còn nguyên tem niêm phong và chưa qua sử dụng.
</p>
<p>
Khách hàng có thể liên hệ <strong>hotline</strong> hoặc inbox fanpage để gửi phản hồi và được hỗ trợ nhanh chóng.
</p>

<h5>2. Tôi có được đổi trả nếu sản phẩm không phù hợp với da?</h5>
<p>
Rất tiếc, với các sản phẩm mỹ phẩm đã mở nắp hoặc sử dụng, <strong>Beauty Shop</strong> không thể hỗ trợ đổi trả nếu sản phẩm không phù hợp với da do tính chất cá nhân hóa. Để tránh rủi ro, Quý khách có thể tham khảo kỹ thông tin sản phẩm, bảng thành phần hoặc inbox fanpage để được tư vấn trước khi mua.
</p>

<h5>3. Nếu sản phẩm bị bể vỡ, rò rỉ khi nhận hàng thì xử lý như thế nào?</h5>
<p>
Trường hợp Quý khách nhận hàng online mà sản phẩm bị vỡ, chảy, móp méo hoặc sai mô tả, vui lòng <strong>chụp ảnh/video sản phẩm</strong> và liên hệ hotline hoặc fanpage trong vòng <strong>24h</strong> kể từ khi nhận hàng để được hỗ trợ đổi sản phẩm mới hoặc hoàn tiền miễn phí.
</p>

<h5>4. Làm thế nào để theo dõi đơn hàng và kiểm tra tiến độ giao hàng?</h5>
<p>
Quý khách có thể tra cứu tiến độ đơn hàng thông qua email xác nhận đơn hoặc liên hệ <strong>số hotline</strong> để được cập nhật thông tin vận chuyển.
</p>

<h5>5. Mua online nhưng không thích sản phẩm, tôi có thể trả lại không?</h5>
<p>
<strong>Beauty Shop</strong> chỉ hỗ trợ đổi/trả nếu sản phẩm bị lỗi, không đúng mô tả hoặc bị hư hỏng trong quá trình vận chuyển. Với lý do <strong>"không thích"</strong>, rất tiếc chúng tôi chưa hỗ trợ trả hàng để đảm bảo quyền lợi người mua tiếp theo.
</p>

<h5>6. Tôi cần được tư vấn sử dụng sản phẩm thì liên hệ ở đâu?</h5>
<p>
Quý khách có thể tham khảo hướng dẫn sử dụng in trên bao bì hoặc liên hệ trực tiếp qua fanpage, website hoặc gọi <strong>số hotline</strong> để được hỗ trợ nhanh chóng.
</p>

<h5>7. <strong>Beauty Shop</strong> có giao hàng tận nhà không?</h5>
<p>
Có. <strong>Beauty Shop</strong> hỗ trợ giao hàng tận nơi trên toàn quốc, bao gồm cả các khu vực nội thành, ngoại thành và vùng sâu vùng xa. Quý khách chỉ cần đặt hàng online qua website, fanpage hoặc hotline – đơn hàng sẽ được chuyển đến tận nhà nhanh chóng.

Với các khu vực nội thành, thời gian giao hàng thường từ <strong>1–2</strong> ngày làm việc. Khu vực tỉnh, huyện có thể mất từ <strong>2–7</strong> ngày làm việc tùy vị trí.

Ngoài ra, khách hàng sẽ được liên hệ trước khi giao, và có thể chọn hình thức thanh toán khi nhận hàng (COD) hoặc chuyển khoản trước.
</p>

<h5>8. Tôi muốn biết chi tiết thành phần sản phẩm?</h5>
<p>
Vui lòng xem chi tiết bảng thành phần (INCI) tại phần mô tả sản phẩm trên website hoặc inbox fanpage để được gửi thông tin cụ thể.
</p>

<h5>9.  Tôi có thể kiểm tra hàng trước khi thanh toán không?</h5>
<p>
Có. Hiện tại, các đơn hàng COD (thanh toán khi nhận hàng) sẽ được hỗ trợ kiểm tra bên ngoài (tem, hộp, mã vạch...) nhưng <strong>không mở seal</strong> nếu là mỹ phẩm còn nguyên niêm phong. Điều này để đảm bảo vệ sinh và chất lượng sản phẩm cho người dùng khác.
</p>

<h5>10. Mua son/kem nền/kem chống nắng sai màu, sai tông da thì có đổi được không?</h5>
<p>
Rất tiếc, các sản phẩm mỹ phẩm có màu sắc như son môi, kem nền, phấn phủ, kem chống nắng có màu <strong>không áp dụng đổi trả   </strong> nếu lý do là chọn sai màu hoặc cảm thấy không hợp với da sau khi sử dụng. Đây là chính sách chung nhằm đảm bảo an toàn vệ sinh và chất lượng sản phẩm cho khách hàng khác, bởi mỹ phẩm là mặt hàng nhạy cảm liên quan đến sức khỏe làn da. Quý khách vui lòng liên hệ trước qua fanpage hoặc hotline để được tư vấn.
</p>

<h5>11. Hóa đơn sai tên, địa chỉ thì có sửa đổi được không?</h5>
<p>
Có thể. Nếu sau khi nhận hóa đơn điện tử mà Quý khách phát hiện sai sót về tên người mua, địa chỉ. <strong>Beauty Shop</strong> hoàn toàn hỗ trợ điều chỉnh thông tin. Tuy nhiên, để đảm bảo đúng quy định của cơ quan thuế, Quý khách cần liên hệ với bộ phận chăm sóc khách hàng trong vòng 24 giờ kể từ khi xuất hóa đơn.
</p>

<h5>12. Nếu tôi không có nhà khi giao hàng thì sao?</h5>
<p>
Đơn vị vận chuyển sẽ gọi điện trước khi giao. Nếu không liên hệ được, họ sẽ giao lại tối đa 2 lần. Trong trường hợp không nhận hàng, đơn sẽ được hoàn về kho. Quý khách có thể liên hệ để đặt lại đơn mới.
</p>

  </div>
</div>


    <footer class="text-bg-dark py-5">
      <div class="container">
        
        <div class="row">
          <div class="col-md-4">
            <div class="text-start mx-4 mb-2">
            <a class="navbar-brand" href="#">
                <img src="../img/logoshop.png" alt="Bootstrap" style="width: 150px; height: auto;" />
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
                <a class="text-decoration-none" href="lienhe.php"
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
                  >Hướng dẫn mua hàng online </a
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
