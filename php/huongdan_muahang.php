
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
        text-align: justify; /* canh đều 2 bên */
        line-height: 1.6;
        margin-bottom: 15px;
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
  <a href="index.php">Trang chủ</a> / Hướng dẫn mua hàng
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
    <h2>Hướng dẫn mua hàng</h2>
    <p><strong>Beauty Shop</strong> là sàn thương mại điện tử chuyên cung cấp các sản phẩm mỹ phẩm chính hãng như sữa rửa mặt, kem chống nắng, son môi, tẩy trang, kem nền, phấn phủ... Chúng tôi cam kết thực hiện đúng quy định về quản lý, vận hành sàn TMĐT theo pháp luật hiện hành.</p>

<h4>1. Đăng ký, đăng nhập tài khoản tại Beauty Shop</h4>
<p>Để mua sắm và trải nghiệm các dịch vụ tại Beauty Shop, quý khách cần đăng ký tài khoản cá nhân. Việc tạo tài khoản giúp lưu trữ thông tin đơn hàng, theo dõi lịch sử mua hàng, nhận các chương trình khuyến mãi đặc biệt, cũng như đảm bảo quyền lợi bảo hành và đổi trả về sau.</p>
<p>Để đăng ký, quý khách truy cập vào biểu tượng tài khoản ở góc phải phía trên website, chọn mục "Đăng ký". Sau đó, điền đầy đủ thông tin như: họ tên, địa chỉ email, số điện thoại và mật khẩu. Quý khách nên sử dụng email và số điện thoại đang hoạt động để dễ dàng nhận thông báo và xác minh.</p>
<p>Nếu đã có tài khoản, quý khách chỉ cần chọn "Đăng nhập", nhập đúng thông tin tài khoản để tiếp tục sử dụng dịch vụ. Trong trường hợp quên mật khẩu, quý khách có thể chọn "Quên mật khẩu" để được hỗ trợ khôi phục qua email.</p>

<h4>2. Tìm kiếm sản phẩm</h4>
<p>Sau khi đăng nhập thành công, quý khách có thể dễ dàng tìm kiếm sản phẩm mình quan tâm bằng nhiều cách:</p>
<ul>
  <li><strong>Thanh tìm kiếm:</strong> Nhập tên sản phẩm như "sữa rửa mặt cho da dầu", "kem chống nắng SPF 50", "son môi lì lâu trôi",... hệ thống sẽ gợi ý các sản phẩm phù hợp.</li>
  <li><strong>Danh mục:</strong> Tại menu chính, quý khách có thể duyệt theo từng danh mục như: Sữa rửa mặt, Kem chống nắng, Son môi, Tẩy trang, Kem nền, Phấn phủ,...</li>
</ul>
<p>Mỗi sản phẩm trên website đều được trình bày chi tiết về thành phần, công dụng, cách dùng, dung tích, giá bán và đánh giá từ người dùng để quý khách yên tâm lựa chọn.</p>

<h4>3. Thêm sản phẩm vào giỏ hàng</h4>
<p>Sau khi tìm được sản phẩm ưng ý, quý khách bấm nút "Thêm vào giỏ hàng" để lưu sản phẩm lại trong giỏ. Quý khách có thể thêm nhiều sản phẩm khác nhau vào cùng một giỏ để đặt hàng một lần.</p>
<p>Trong trang chi tiết sản phẩm, quý khách có thể:</p>
<ul>
  <li>Kiểm tra thông tin sản phẩm: giá, màu, dung tích,...</li>
  <li>Chọn số lượng cần mua</li>
</ul>
<p>Ngoài ra, quý khách cũng có thể lưu sản phẩm yêu thích vào danh sách "Yêu thích" để tham khảo hoặc mua sau.</p>

<h4>4. Kiểm tra giỏ hàng và đặt hàng</h4>
<p>Để kiểm tra các sản phẩm đã chọn, quý khách nhấp vào biểu tượng "Giỏ hàng" nằm ở góc phải phía trên màn hình. Tại đây, hệ thống sẽ hiển thị tất cả sản phẩm đang có trong giỏ hàng với các thông tin như:</p>
<ul>
  <li>Thông tin cá nhân</li>
  <li>Tên sản phẩm, hình ảnh, dung tích/màu sắc</li>
  <li>Số lượng và giá tiền</li>
  <li>Tổng giá trị đơn hàng</li>
</ul>
<p>Quý khách có thể điều chỉnh số lượng hoặc xóa sản phẩm khỏi giỏ nếu không còn nhu cầu. Sau khi kiểm tra xong, bấm “Tiến hành đặt hàng” để sang bước nhập thông tin và chọn phương thức thanh toán.</p>

<h4>5. Điều chỉnh thông tin và địa chỉ giao hàng</h4>
<p>Ở bước tiếp theo, quý khách cần cung cấp hoặc xác nhận lại các thông tin giao hàng bao gồm:</p>
<ul>
  <li>Họ tên người nhận</li>
  <li>Số điện thoại liên hệ</li>
  <li>Địa chỉ nhận hàng chính xác (bao gồm số nhà, phường/xã, quận/huyện, tỉnh/thành)</li>
</ul>
<p>Thông tin này sẽ được dùng để đơn vị vận chuyển giao hàng đến đúng người và đúng địa điểm. Quý khách cũng có thể để lại ghi chú cho người giao hàng nếu cần (ví dụ: gọi trước khi đến, giao ngoài giờ hành chính,...).</p>
<p>Beauty Shop cam kết bảo mật tuyệt đối thông tin cá nhân và chỉ sử dụng cho mục đích xử lý đơn hàng.</p>

<h4>6. Kiểm tra và xác nhận đặt hàng</h4>
<p>Trước khi hoàn tất, quý khách kiểm tra lại toàn bộ thông tin gồm:</p>
<ul>
  <li>Sản phẩm đã chọn</li>
  <li>Số lượng, dung tích, màu sắc</li>
  <li>Phương thức thanh toán: COD (thanh toán khi nhận hàng), chuyển khoản ngân hàng, hoặc ví điện tử</li>
  <li>Thông tin nhận hàng và chi phí vận chuyển (nếu có)</li>
</ul>
<p>Sau khi chắc chắn, quý khách nhấn “Xác nhận đặt hàng”. Hệ thống sẽ gửi email xác nhận đơn hàng ngay lập tức đến địa chỉ email đã đăng ký. Đơn hàng sẽ được xử lý trong vòng 24 giờ và giao đến tay khách hàng trong thời gian cam kết (2–5 ngày tùy khu vực).</p>
<p>Beauty Shop luôn theo dõi tiến trình giao hàng và sẵn sàng hỗ trợ nếu có bất kỳ sự cố hay chậm trễ nào. Trong trường hợp cần đổi/trả hàng theo chính sách, quý khách có thể liên hệ trực tiếp hotline hoặc email hỗ trợ để được giải quyết nhanh chóng.</p>


<h4>7. Liên hệ</h4>
<p>
<strong>CỬA HÀNG MỸ PHẨM BEAUTY SHOP</strong><br>
Địa chỉ: 162/1, Đường 3/2, Ninh Kiều, Cần Thơ<br>
Hotline: 0879 342 732 – Email: webmipham@gmail.com<br>
Thời gian làm việc: 8:00 – 20:00 (Thứ 2 – Thứ 7)
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
