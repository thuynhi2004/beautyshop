<?php
session_start();

include 'connect.php';

// Debug kết nối
if (!$conn) {
    die("Lỗi kết nối cơ sở dữ liệu: " . mysqli_connect_error());
}

// Khởi tạo giỏ hàng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Hàm tính tổng tiền
function calculateTotal($cart) {
    $total = 0;
    foreach ($cart as $product) {
        $total += $product['giaBan'] * $product['quantity'];  
    }
    return $total;
}

// Thêm sản phẩm vào giỏ hàng
if (isset($_GET['maSP']) && is_numeric($_GET['maSP'])) {
    $maSP = $_GET['maSP'];
    $quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;

    $stmt = $conn->prepare("SELECT maSP, tenSP, giaBan, hinhAnh FROM sanpham WHERE maSP = ?");
    if (!$stmt) {
        die("Lỗi prepare statement: " . $conn->error);
    }
    $stmt->bind_param("i", $maSP);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $found = false;
        foreach ($_SESSION['cart'] as &$product) {
            if ($product['maSP'] == $maSP) {
                $product['quantity'] += $quantity;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = [
                'maSP' => $row['maSP'],
                'tenSP' => $row['tenSP'],
                'giaBan' => $row['giaBan'],
                'hinhAnh' => $row['hinhAnh'],
                'quantity' => $quantity
            ];
        }
    }

    $stmt->close();

    // Nếu gọi bằng AJAX, trả về JSON
    if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
        echo json_encode([
            'status' => 'success',
            'cart_count' => count($_SESSION['cart']),
            'total' => calculateTotal($_SESSION['cart'])
        ]);
        exit();
    }

    // Nếu gọi bình thường, chuyển về cart
    header("Location: cart.php");
    exit();
}

// Xoá sản phẩm khỏi giỏ
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    $maSPToRemove = $_GET['remove'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($product) use ($maSPToRemove) {
        return $product['maSP'] != $maSPToRemove;
    });
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    echo json_encode([
        'status' => 'success',
        'cart' => $_SESSION['cart'],
        'total' => calculateTotal($_SESSION['cart'])
    ]);
    exit();
}

// Cập nhật giỏ hàng
if (isset($_POST['update'])) {
    if (!empty($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $key => $quantity) {
            $_SESSION['cart'][$key]['quantity'] = max(1, intval($quantity));
        }
    }
    echo json_encode([
        'status' => 'success',
        'cart' => $_SESSION['cart'],
        'total' => calculateTotal($_SESSION['cart'])
    ]);
    exit();
}

// Xử lý đặt hàng
if (isset($_POST['checkout'])) {  
    $tenkh = htmlspecialchars(trim($_POST['tenKH']));
    $mailkh = htmlspecialchars(trim($_POST['mailKH']));
    $sdt = htmlspecialchars(trim($_POST['sdt']));
    $diachi = htmlspecialchars(trim($_POST['diachi']));
    // Lấy phương thức thanh toán: 'cod' hoặc 'vnpay'
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : 'cod';


    if (empty($_SESSION['cart'])) {
        echo "<script>alert('Giỏ hàng trống. Không thể thanh toán.'); window.location.href = 'cart.php';</script>";
        exit();
    }

    if (empty($tenkh) || empty($mailkh) || empty($sdt) || empty($diachi)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin trước khi thanh toán.');</script>";
        exit();
    }

    if (!filter_var($mailkh, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Email không hợp lệ. Vui lòng nhập lại.');</script>";
        exit();
    }

    if (!preg_match('/^[0-9]{10,11}$/', $sdt)) {
        echo "<script>alert('Số điện thoại không hợp lệ. Vui lòng nhập lại.');</script>";
        exit();
    }

    // ✅ Kiểm tra tồn kho trước khi đặt hàng
    foreach ($_SESSION['cart'] as $item) {
        $maSP = $item['maSP'];
        $soLuong = $item['quantity'];

        $checkQty = $conn->query("SELECT soLuong, tenSP FROM sanpham WHERE maSP = $maSP");
        if ($checkQty && $rowQty = $checkQty->fetch_assoc()) {
            if ($rowQty['soLuong'] < $soLuong) {
                echo "<script>alert('Sản phẩm \"{$rowQty['tenSP']}\" không đủ số lượng trong kho.'); window.location.href = 'cart.php';</script>";
                exit();
            }
        }
    }

    // Nếu kiểm tra xong ổn, mới bắt đầu thêm đơn hàng
    $total = calculateTotal($_SESSION['cart']);

// Nếu chọn thanh toán qua VNPAY thì chuyển hướng sang trang thanh toán
if ($payment_method === 'vnpay') {
    $pay_method = 'vnpay';
    $stmt = $conn->prepare("INSERT INTO donhang (tenKH, mailKH, sdt, diachi, total, ngayDat, pay_method) VALUES (?, ?, ?, ?, ?, NOW(), ?)");
    $stmt->bind_param("ssssds", $tenkh, $mailkh, $sdt, $diachi, $total, $pay_method);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;

        // Lưu chi tiết đơn hàng NGAY TẠI ĐÂY
        $stmt_detail = $conn->prepare("INSERT INTO donhang_chitiet (ma_donhang, maSP, soLuong, giaBan, ngayDat) VALUES (?, ?, ?, ?, NOW())");

        foreach ($_SESSION['cart'] as $item) {
            $maSP = $item['maSP'];
            $soLuong = $item['quantity'];
            $giaBan = $item['giaBan'] * $soLuong;

            $stmt_detail->bind_param("iiid", $order_id, $maSP, $soLuong, $giaBan);
            $stmt_detail->execute();

            // Trừ tồn kho
            $stmt_updateQty = $conn->prepare("UPDATE sanpham SET soLuong = soLuong - ? WHERE maSP = ?");
            $stmt_updateQty->bind_param("ii", $soLuong, $maSP);
            $stmt_updateQty->execute();
            $stmt_updateQty->close();
        }
        $stmt_detail->close();

        // ✅ Sau khi lưu thành công, chỉ cần lưu order_id để xác nhận sau
        $_SESSION['order_id_vnpay'] = $order_id;
        unset($_SESSION['cart']);

        header("Location: vnpay_create_payment.php");
        exit();
    } else {
        echo "<script>alert('Lỗi khi tạo đơn hàng VNPAY: " . $stmt->error . "');</script>";
    }
}


      $stmt = $conn->prepare("INSERT INTO donhang (tenKH, mailKH, sdt, diachi, total, ngayDat) VALUES (?, ?, ?, ?, ?, NOW())");
      if (!$stmt) {
          die("Lỗi prepare statement: " . $conn->error);
      }
      $stmt->bind_param("ssssd", $tenkh, $mailkh, $sdt, $diachi, $total);

      if ($stmt->execute()) {
          $orderID = $stmt->insert_id;

          $stmt_detail = $conn->prepare("INSERT INTO donhang_chitiet (ma_donhang, maSP, soLuong, giaBan, ngayDat) VALUES (?, ?, ?, ?, NOW())");

          foreach ($_SESSION['cart'] as $item) {
              $maSP = $item['maSP'];
              $soLuong = $item['quantity'];
              $giaBan = $item['giaBan'] * $item['quantity'];

              $stmt_detail->bind_param("iiid", $orderID, $maSP, $soLuong, $giaBan);
              $stmt_detail->execute();

              $stmt_updateQty = $conn->prepare("UPDATE sanpham SET soLuong = soLuong - ? WHERE maSP = ?");
              $stmt_updateQty->bind_param("ii", $soLuong, $maSP);
              $stmt_updateQty->execute();
              $stmt_updateQty->close();
          }

          $stmt_detail->close();
          unset($_SESSION['cart']);
          echo "<script>alert('Đặt hàng thành công!'); window.location.href = '../index.php';</script>";
      } else {
          echo "<script>alert('Có lỗi xảy ra khi thanh toán: " . $stmt->error . "');</script>";
      }

    $stmt->close();
    exit();
}

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

.payment-option {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
}

.payment-label {
  background: none !important;
  color: #333 !important;
  padding: 0;
  margin-left: 8px;
  font-size: 14px;
  display: inline-block;
  white-space: nowrap;
}

.payment-label-cod {
  background: none !important;
  color: #333 !important;
  padding: 0;
  font-size: 14px;
  margin-left: 20px;
  display: inline-block;
  white-space: nowrap;
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
   
    <h2 class="h2-cart">Giỏ hàng của bạn</h2>
    <?php if (!empty($_SESSION['cart'])): ?>
    <form id="cart-form" method="POST">
        <table id="cart-table">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <body>
    <?php $total = 0; foreach ($_SESSION['cart'] as $key => $product): ?>
    <tr>
        <td><img src="<?php echo $product['hinhAnh']; ?>" alt="Ảnh" width="60"></td>
        <td><?php echo $product['tenSP']; ?></td>
        <td class="price" data-price="<?php echo $product['giaBan']; ?>">
            <?php echo number_format($product['giaBan'], 0, ',', '.'); ?> VNĐ
        </td>
        <td>
            <input type="number" class="quantity" name="quantity[<?php echo $key; ?>]" 
                   value="<?php echo $product['quantity']; ?>" min="1"
                   data-key="<?php echo $key; ?>" onchange="updateCart(this)">
        </td>
        <td class="subtotal">
            <?php echo number_format($product['giaBan'] * $product['quantity'], 0, ',', '.'); ?> VNĐ
        </td>
        <td>
        <button class="btn-cart" type="button" onclick="removeFromCart(<?php echo $product['maSP']; ?>)">Xóa</button>
        </td>
    </tr>
    <?php $total += $product['giaBan'] * $product['quantity']; endforeach; ?>
</body>
</table>
<h3>Tổng tiền: <span id="total-price"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</span></h3>
<div style="display: flex; gap: 10px; margin-top: 20px;">
    <button class="btn-cart" type="button" onclick="window.location.href='../index.php'">Tiếp tục mua hàng</button>
    <button id="btn-dat-hang" class="btn-cart" type="button" onclick="document.getElementById('checkout-form').style.display='block'">Đặt hàng</button>
</div>

<div class="footer-content">
              
                  
            </div>

            <!-- <tbody>
                <?php $total = 0; foreach ($_SESSION['cart'] as $key => $product): ?>
                <tr>
                    <td><img src="<?php echo $product['hinhAnh']; ?>" alt="Product Image" width="50"></td>
                    <td><?php echo $product['tenSP']; ?></td>
                    <td><?php echo number_format($product['giaBan'], 0, ',', '.'); ?> VNĐ</td>
                    <td><input type="number" name="quantity[<?php echo $key; ?>]" value="<?php echo $product['quantity']; ?>" min="1"></td>
                    <td><?php echo number_format($product['giaBan'] * $product['quantity'], 0, ',', '.'); ?> VNĐ</td>
                    <td><button type="button" onclick="removeFromCart(<?php echo $product['maSP']; ?>)">Xóa</button></td>
                </tr>
                <?php $total += $product['giaBan'] * $product['quantity']; endforeach; ?>
            </tbody>
        </table>
        <h3>Tổng tiền: <span id="total-price"><?php echo number_format($total, 0, ',', '.'); ?> 
-->
    </form>

    <div id="checkout-form" style="display: none;">
    <h3>Thông tin khách hàng</h3>
    <form method="POST">
        <label for="tenKH">Họ và tên:</label>
        <input type="text" id="tenKH" name="tenKH" required>

        <label for="mailKH">Email:</label>
        <input type="email" id="mailKH" name="mailKH" required>

        <label for="sdt">Số điện thoại:</label>
        <input type="text" id="sdt" name="sdt" required>

        <label for="diachi">Địa chỉ:</label>
        <input type="text" id="diachi" name="diachi" required>

        <!-- Div riêng chứa lựa chọn phương thức thanh toán -->
        <div class="payment-container">
    <h4>Chọn phương thức thanh toán</h4>

    <div class="payment-option">
  <input type="radio" id="cod" name="payment_method" value="cod" checked>
  <label class="payment-label-cod" for="cod">Thanh toán C.O.D</label>
</div>

<div class="payment-option">
  <input type="radio" id="atm" name="payment_method" value="vnpay">
  <label class="payment-label" for="atm">Thanh toán online</label>
</div>

</div>

        <button type="submit" name="checkout">Đặt hàng</button>
    </form>
</div>

    
    <?php else: ?>
        <p>Giỏ hàng của bạn đang trống!!!</p>
    <?php endif; ?>
    
    <p>
    Xem lại đơn hàng của bạn <a href="xem_donhang.php" style="text-decoration: none;">tại đây</a>.
    </p>

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

    <script>
    function removeFromCart(maSP) {
        if (confirm("Bạn có muốn xóa sản phẩm này khỏi giỏ hàng không?")) {
            fetch("cart.php?remove=" + maSP)
                .then(response => response.json())
                .then(data => {
                    location.reload();
                });
        } else {

            //alert("Đã hủy xóa sản phẩm.");
        }
    }
    </script>

    <script>
    function updateCart(element) {
        let key = element.getAttribute('data-key');
        let newQuantity = parseInt(element.value);

        // Ràng buộc: không cho nhập số nhỏ hơn 1
        if (isNaN(newQuantity) || newQuantity < 1) {
            newQuantity = 1;
            element.value = 1; // Reset input về 1
        }

        let price = parseInt(element.closest('tr').querySelector('.price').getAttribute('data-price'));
        let subtotalElement = element.closest('tr').querySelector('.subtotal');

        // Tính và hiển thị lại thành tiền
        let newSubtotal = newQuantity * price;
        subtotalElement.textContent = newSubtotal.toLocaleString('vi-VN') + " VNĐ";

        // Cập nhật tổng tiền
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(sub => {
            total += parseInt(sub.textContent.replace(/\D/g, ''));
        });
        document.getElementById('total-price').textContent = total.toLocaleString('vi-VN') + " VNĐ";

        // Gửi yêu cầu cập nhật session qua AJAX
        fetch('update_cart.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `key=${key}&quantity=${newQuantity}`
  })
  .then(res => res.json())
  .then(data => {
      console.log("Cập nhật thành công:", data);
  });

    }

    // Ngăn người dùng nhập ký tự không hợp lệ (như e, +, -)
    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('keydown', function(e) {
            if (['e', 'E', '+', '-'].includes(e.key)) {
                e.preventDefault();
            }
        });
    });
    </script>

<script>
    document.getElementById('btn-dat-hang').addEventListener('click', function () {
        <?php if (!isset($_SESSION['hoten'])): ?>
            alert("Vui lòng đăng nhập để đặt hàng.");
            window.location.href = 'dangnhap.php';
        <?php else: ?>
            document.getElementById('checkout-form').style.display = 'block';
            // Cuộn xuống form cho tiện
            document.getElementById('checkout-form').scrollIntoView({ behavior: 'smooth' });
        <?php endif; ?>
    });
</script>

</html> 
