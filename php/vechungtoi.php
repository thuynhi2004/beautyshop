<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về chúng tôi </title>
   
   
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
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
</style>

<body>
  
<!-- header  -->

<nav class="navbar navbar-expand-lg border-bottom sticky-top  ">
        <div class="container">
          <a class="navbar-brand" href="">
            <img src="../img/logo_thebadgold.png" alt="Bootstrap"  style="height: 60px;"/>
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
                  Danh Mục sản phẩm
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
               
                <a class="nav-link" aria-disabled="true" href="trang_lienhe.php">Liên Hệ </a>
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
                class="form-control me-0 search-input"
                name="keyword"
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
       
</header>
<div class="container">
       <header>
            <h2 style="margin-top: 20px; margin-bottom: 15px;">Shop mỹ phẩm BEAUTYSHOP  </h2>

        </header>
        <main class="text-justify">
  <section>
    <h4>1. Giới thiệu</h4>
    <p>
      Chào mừng bạn đến với <strong>The Bad Gold</strong> – thương hiệu thời trang dành cho giới trẻ năng động và cá tính! Chúng tôi tự hào mang đến những sản phẩm quần áo chất lượng cao, thiết kế độc đáo, giúp bạn thể hiện phong cách riêng và tự tin trong mọi khoảnh khắc.
    </p>
  </section>

  <section>
    <h4>2. Đặc điểm sản phẩm</h4>
    <p>
      Tại <strong>The Bad Gold</strong>, chúng tôi cung cấp đa dạng các dòng sản phẩm thời trang cho cả nam và nữ như: <strong>áo thun, áo sơ mi, áo khoác, quần jean, quần tây, quần short, chân váy, dép và phụ kiện đi kèm</strong>. Dưới đây là một số đặc điểm nổi bật:
    </p>
    <ul>
      <li>
  <strong>Áo:</strong> Các mẫu áo tại <strong>The Bad Gold</strong> được làm từ vải cotton cao cấp, co giãn 4 chiều, thấm hút mồ hôi tốt, giúp thoải mái trong mọi hoạt động. Thiết kế đa dạng với form oversize trẻ trung, unisex hiện đại và slim-fit ôm dáng. Phong cách thời trang được lấy cảm hứng từ streetwear, retro và Hàn Quốc. Sản phẩm có đủ 4 size phổ biến: <strong>S, M, L, XL</strong>, phù hợp nhiều dáng người, giúp bạn dễ dàng chọn lựa theo chiều cao và cân nặng.
</li>

<li>
  <strong>Quần:</strong> Bộ sưu tập quần của <strong>The Bad Gold</strong> bao gồm các dòng quần jean, jogger, cargo, short,... sử dụng chất liệu vải dày dặn, mềm mại, bền màu, co giãn nhẹ. Kiểu dáng được thiết kế theo form chuẩn, dễ phối với nhiều loại áo. Các chi tiết như đường chỉ, khuy quần, túi hộp đều được may chắc chắn, tinh tế. Quần có đủ các size <strong>S, M, L, XL</strong> cho nam và nữ, phù hợp với nhiều vóc dáng từ nhỏ gọn đến cao lớn.
</li>

    </ul>
  </section>

  <section>
    <h4>3. Cam kết chất lượng</h4>
    <p>
      <strong>The Bad Gold</strong> cam kết cung cấp sản phẩm chính hãng, chất liệu cao cấp, bền đẹp và an toàn cho người mặc. Mỗi sản phẩm đều trải qua quy trình kiểm tra chất lượng kỹ lưỡng trước khi đến tay khách hàng.
    </p>
  </section>

  <section>
    <h4>4. Dịch vụ khách hàng tận tâm</h4>
    <p>
      Đội ngũ tư vấn của chúng tôi luôn sẵn sàng hỗ trợ bạn trong việc lựa chọn size, kiểu dáng, phối đồ. Chúng tôi lắng nghe mọi phản hồi từ khách hàng để cải thiện dịch vụ và mang lại trải nghiệm mua sắm tốt nhất.
    </p>
  </section>

  <section>
    <h4>5. Chương trình khuyến mãi hấp dẫn</h4>
    <p>
      <strong>The Bad Gold</strong> thường xuyên tổ chức các chương trình giảm giá, ưu đãi theo mùa và combo sản phẩm. Đừng quên theo dõi website và fanpage của chúng tôi để không bỏ lỡ cơ hội săn deal chất lượng với giá tốt nhất!
    </p>
  </section>

  <section>
    <h4>6. Hỗ trợ khách hàng</h4>
    <p>Nếu bạn có bất kỳ câu hỏi hay cần tư vấn thêm, hãy liên hệ với chúng tôi qua:</p>
    <p><strong>Email:</strong> thebadgold@gmail.com</p>
    <p><strong>Hotline:</strong> 0907326239</p>
    <p><strong>Địa chỉ:</strong> 162/1, Đường 3/2, Ninh Kiều, Cần Thơ</p>
  </section>
</main>

</div>

<footer class="text-bg-dark py-5">
      <div class="container">
        
        <div class="row">
          <div class="col-md-4">
            <div class="text-start mx-4 mb-2">
            <a class="navbar-brand" href="../index.php">
                <img src="../img/logo_thebadgold.png" alt="Bootstrap" style="width: 150px; height: 80px;" />
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