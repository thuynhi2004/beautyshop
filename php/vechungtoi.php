<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về chúng tôi </title>
   
   
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
  
<!-- header  -->

<nav class="small navbar navbar-expand-lg border-bottom sticky-top  ">
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <img src="../img/logo.png" alt="Bootstrap" />
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



<!-- biểu mẫu  -->
<header class="header">
        <li class="cart">
        <a href="cart.php"><img src="../img/cart-icon.png" alt="Cart Icon"></a>
        </li>
       
</header>
<div class="container">
       <header>
            <h2>Shop mĩ phẫm BEAUTYSHOP  </h2>

        </header>
        <main>
           <section>
            <h4>
                1.Giới thiệu 
            </h4>
            <p>
                Chào mừng bạn đến với<strong> BeautyShop</strong> - nơi mang đến cho bạn những sản phẩm làm đẹp chất lượng nhất! Chúng tôi tự hào là một trong những cửa hàng hàng đầu trong lĩnh vực mỹ phẩm, với sứ mệnh mang đến cho bạn những sản phẩm tốt nhất để tôn vinh vẻ đẹp tự nhiên của bạn.
           </section>


              <section>
                <h4>
                 2.Sản phẩm đa dạng 
                </h4>
                <p>
                 Tại<strong> BeautyShop</strong>, chúng tôi cung cấp một loạt các sản phẩm mỹ phẩm từ các thương hiệu nổi tiếng trong và ngoài nước, bao gồm:
                </p>
                <ul>
                    <li>Trang điểm: Son môi, phấn nền, phấn mắt, mascara và nhiều sản phẩm khác.</li>
                    <li>Chăm sóc da: Kem dưỡng ẩm, serum, mặt nạ và sản phẩm chăm sóc da khác.</li>
                    <li>Chăm sóc tóc: Dầu gội, dầu xả và các sản phẩm chăm sóc tóc chuyên biệt.</li>
                    <li>Và nhiều sản phẩm khác để bạn lựa chọn!</li>
                </ul>
               </section>


                <section>
               <h4>3.Cam Kết Chất Lượng</h4>
                <p>Chúng tôi cam kết mang đến cho khách hàng những sản phẩm chính hãng, an toàn và hiệu quả. Mỗi sản phẩm đều được lựa chọn kỹ lưỡng để đảm bảo đáp ứng nhu cầu và mong muốn của khách hàng.</p>

                </section>
                <section>
                <h4>
                    4.Dịch vụ khách hàng tận tâm
                </h4>       
                <p>
                Đội ngũ nhân viên của chúng tôi luôn sẵn sàng hỗ trợ và tư vấn để bạn có thể lựa chọn được sản phẩm phù hợp nhất. Chúng tôi luôn lắng nghe và tiếp thu ý kiến của khách hàng để cải thiện dịch vụ.                </p>
                </section>
                <section>
                <h4>
                    5.Chương Trình Khuyến Mãi Hấp Dẫn

                </h4>
                <p>
                Đừng bỏ lỡ các chương trình khuyến mãi và ưu đãi đặc biệt mà chúng tôi thường xuyên tổ chức! Theo dõi trang web và các kênh truyền thông xã hội của chúng tôi để cập nhật thông tin mới nhất.
                </p>

                
        </main>
</div>








<footer class="text-bg-dark py-5">
      <div class="container">
        
        <div class="row">
          <div class="col-md-4">
            <div class="text-start mx-4 mb-2">
            <a class="navbar-brand" href="index.php">
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