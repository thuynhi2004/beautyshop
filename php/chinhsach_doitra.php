
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" >
    <title> The Bad Gold </title>
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
        text-align: justify; /* Đây là dòng quan trọng để canh đều 2 bên */
        line-height: 1.6;
        margin-bottom: 15px;
    }

 table {
      width: 100%;
      border-collapse: collapse;
      font-family: Arial, sans-serif;
    }

    th, td {
      border: 1px solid #888;
      padding: 10px;
      vertical-align: top;
      text-align: left;
    }

    thead tr {
      background-color: #f2f2f2;
    }

    th {
      font-weight: bold;
    }

    td[colspan="3"] {
      background-color: #fcfcfc;
      font-style: italic;
    }

    strong {
      font-weight: bold;
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
            <img class="logo" src="../img/logo_thebadgold.png" alt="Bootstrap"  style="height: 60px;"/>
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


    <div class="breadcrumb">
  <a href="../index.php">Trang chủ</a> / Chính sách đổi trả
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
                <a  href="thongtin_giaca.php"
                  >Thông tin về giá cả </a
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
    <h2>Chính sách đổi trả</h2>
    <h4>I. QUY ĐỊNH CHUNG</h4>
<table>
  <thead>
    <tr>
      <th>STT</th>
      <th>Hạng mục</th>
      <th>Nội dung</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td><strong>Đủ điều kiện đổi trả</strong></td>
      <td>
        Sản phẩm chưa qua sử dụng, còn nguyên tag mác, bao bì và không có dấu hiệu bị giặt, bẩn hoặc biến dạng:<br>
        - Tag và tem size còn nguyên vẹn<br>
        - Không bị bẩn, rách, co rút, bạc màu<br>
        - Đổi trả trong vòng 7 ngày kể từ ngày nhận hàng<br>
        - Có hóa đơn mua hàng gốc tại <strong>The Bad Gold</strong><br>
        - Áp dụng cho sản phẩm không thuộc chương trình khuyến mãi đặc biệt
      </td>
    </tr>
    <tr>
      <td>2</td>
      <td><strong>Đủ điều kiện bảo hành</strong></td>
      <td>
        Sản phẩm lỗi kỹ thuật (đường may, khóa kéo, nút...) do nhà sản xuất trong lần sử dụng đầu tiên:<br>
        - Có dấu hiệu lỗi như bung chỉ, lệch size, không đúng mô tả<br>
        - Tag mác còn nguyên, chưa giặt hoặc chưa mặc<br>
        - Có hóa đơn tại <strong>The Bad Gold</strong><br>
        - Được xác nhận lỗi bởi nhân viên CSKH hoặc nhà cung cấp
      </td>
    </tr>
    <tr>
      <td>3</td>
      <td><strong>Không đủ điều kiện bảo hành/đổi trả</strong></td>
      <td>
        - Sản phẩm đã giặt hoặc sử dụng<br>
        - Bảo quản sai cách gây phai màu, co rút, giãn<br>
        - Không mua tại <strong>The Bad Gold</strong><br>
        - Thiếu hóa đơn/xác minh đơn hàng<br>
        - Quá thời hạn đổi trả theo quy định
      </td>
    </tr>
    <tr>
      <td>4</td>
      <td><strong>Phí phát sinh trong quá trình đổi trả</strong></td>
      <td>
        - Phí kiểm tra nếu có nghi vấn sử dụng hoặc lỗi không rõ ràng<br>
        - Phí vận chuyển 2 chiều nếu đổi trả tận nơi<br>
        - Sản phẩm đi kèm quà tặng, nếu thiếu phải hoàn lại hoặc bù tương đương<br>
        - Đổi do nhu cầu cá nhân sẽ thông báo rõ phí cụ thể theo từng trường hợp
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <strong>Lưu ý:</strong><br>
        - Mỗi đơn hàng chỉ đổi trả 1 lần<br>
        - Sản phẩm thuộc “Flash Sale” hoặc chương trình đặc biệt không áp dụng đổi trả<br>
        - Vui lòng thử kỹ size và kiểm tra kỹ sản phẩm trước khi thanh toán<br>
        - Liên hệ CSKH của <strong>The Bad Gold</strong> để được tư vấn trước khi đổi/trả
      </td>
    </tr>
  </tbody>
</table>

<h4>II. CÁC CHÍNH SÁCH ĐỔI TRẢ</h4>
<h5>2.1. Chính sách đổi trả áp dụng cho sản phẩm: áo, quần, jacket, phụ kiện thời trang</h5>
<h5>2.1.1. Sản phẩm mới</h5>

<table>
  <thead>
    <tr>
      <th>Trường hợp</th>
      <th>Thời gian (tính từ ngày nhận hàng)</th>
      <th>Chính sách đổi trả</th>
      <th>Phí khấu hao khi trả hàng<br>(tính theo giá trị sản phẩm)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Lỗi từ nhà sản xuất</td>
      <td>0 – 7 ngày</td>
      <td>
        <span class="highlight">1 đổi 1 cùng loại</span> nếu sản phẩm còn tag, chưa mặc, phát hiện lỗi như đường may, lỗi in, sai size.<br>
        Sau khi kiểm tra, The Bad Gold hỗ trợ đổi mới hoặc hoàn tiền tương đương. Nếu hết hàng, có thể đổi mẫu tương đương hoặc cao hơn (bù chênh lệch).
      </td>
      <td>0% – miễn phí</td>
    </tr>
    <tr>
      <td>Khách muốn đổi vì không vừa hoặc không ưng</td>
      <td>0 – 7 ngày</td>
      <td>
        Chấp nhận đổi sang sản phẩm khác nếu còn nguyên tag, chưa mặc, chưa giặt.<br>
        Chỉ áp dụng 1 lần đổi và tùy mẫu có sẵn trong kho.
      </td>
      <td>10% – phí xử lý tồn kho</td>
    </tr>
    <tr>
      <td>Lỗi do người dùng</td>
      <td>0 – 30 ngày</td>
      <td>
        Không áp dụng đổi trả. Có thể hỗ trợ sửa chữa nếu sản phẩm cho phép và được hãng đồng ý.
      </td>
      <td>Không hỗ trợ</td>
    </tr>
    <tr>
      <td colspan="4"><strong>Phụ phí đổi trả khác nếu có (tính theo % giá trị sản phẩm):</strong>
        <ul>
          <li><strong>Bẩn nhẹ (có thể làm sạch):</strong> 5%</li>
          <li><strong>Rách nhẹ ở viền/quai áo:</strong> 10%</li>
          <li><strong>Mất tag, mác, tem size:</strong> <span class="highlight">Không đủ điều kiện đổi</span></li>
          <li><strong>Thiếu túi/vỏ hộp kèm theo:</strong> 5%</li>
        </ul>
      </td>
    </tr>
  </tbody>
</table>

<h5>2.1.2. Sản phẩm đã sử dụng</h5>

<table>
  <thead>
    <tr>
      <th>Trường hợp</th>
      <th>Thời gian<br>(tính từ ngày nhận hàng)</th>
      <th>Chính sách đổi trả</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Sản phẩm lỗi kỹ thuật (sau khi mặc 1 lần)</td>
      <td>0 – 7 ngày</td>
      <td>
        <strong>Đổi sản phẩm tương đương</strong><br>
        Nếu còn hàng cùng size và mẫu.<br>
        Nếu không có, hỗ trợ đổi mẫu tương đương hoặc hoàn tiền theo giá trị sản phẩm.
      </td>
    </tr>
    <tr>
      <td>Sản phẩm vẫn còn sử dụng được</td>
      <td>Dưới 30 ngày</td>
      <td>
        <em>The Bad Gold</em> hỗ trợ gửi sản phẩm về hãng/thợ sửa nếu có lỗi nhẹ (đứt chỉ, bung nút...). Phí sửa do khách hàng chi trả.
      </td>
    </tr>
    <tr>
      <td>Đổi trả theo nhu cầu cá nhân</td>
      <td><em>Không áp dụng</em></td>
      <td>
        Sản phẩm đã qua sử dụng không áp dụng đổi trả vì lý do không ưng ý sau khi mặc.
      </td>
    </tr>
    <tr>
      <td>Lỗi do người dùng</td>
      <td>Dưới 30 ngày</td>
      <td>
        <em>The Bad Gold</em> có thể hỗ trợ đánh giá lỗi và tư vấn xử lý hoặc giới thiệu nơi sửa phù hợp. Chi phí do khách hàng chi trả.
      </td>
    </tr>
  </tbody>
</table>


  </div>
</div>

    <footer class="text-bg-dark py-5">
      <div class="container">
        
        <div class="row">
          <div class="col-md-4">
            <div class="text-start mx-4 mb-2">
            <a class="navbar-brand" href="#">
                <img src="../img/logo_thebadgold.png" alt="Bootstrap" style="width: 150px; height: 80px;"/>
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
                <a class="text-decoration-none" href="thongtin_giaca.php"
                  >Thông tin về giá cả </a
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
