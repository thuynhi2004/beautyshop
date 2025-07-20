<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BeautyShop</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/form_themmon.css">
    <link rel="stylesheet" href="../css/tongquan.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<style>

    .hidden {
  display: none !important;
}

    .search-box {
  display: flex;
  align-items: center;
  border: 2px solid #ccc;
  border-radius: 25px;
  overflow: hidden;
  width: 250px;
  background-color: white;
}

.search-box input[type="text"] {
  border: none;
  outline: none;
  padding: 10px 15px;
  flex: 1;
  font-size: 14px;
  border-radius: 25px 0 0 25px;
}

.search-box button {
  border: none;
  background-color: #28a745; /* màu nút */
  color: white;
  padding: 10px 15px;
  cursor: pointer;
  border-radius: 0 25px 25px 0;
  transition: background-color 0.3s ease;
}

.search-box button:hover {
  background-color:rgb(19, 111, 24);
}

.search-box i {
  font-size: 16px;
}

#searchTour::placeholder {
  font-style: italic;
}

.menu-item a,
.menu-item a:visited {
  color: white !important;
  text-decoration: none;
}

.menu-item {
  list-style: none;
}

.modal.show {
  display: flex; /* Khi có class show sẽ hiện */
}

.btn {
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
}
.btn-success {
    background-color: #28a745;
    color: white;
}
.btn-danger {
    background-color: #dc3545;
    color: white;
}


</style>
</head>

<body>
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>
            <img class="img-admin" src="../img/logo.png">
        </h2>

        <button class="menu-item" data-section="tongquan">
            <i class="fas fa-shopping-cart"></i>Tổng Quan
        </button>
        <button class="menu-item" data-section="orders">
            <i class="fas fa-shopping-cart"></i>Quản Lý Đơn Hàng
        </button>
        <button class="menu-item" data-section="customers">
            <i class="fas fa-users"></i>Quản Lý Khách Hàng
        </button>
        <button class="menu-item" data-section="menu">
            <i class="fas fa-utensils"></i>Quản Lý Sản Phẩm
        </button>
        <button class="menu-item" data-section="review">
            <i class="fas fa-user-tie"></i>Quản Lý Đánh Giá
        </button>
        <button class="menu-item" data-section="lienhe">
            <i class="fas fa-user-tie"></i>Quản Lý Liên Hệ
        </button>
        <button class="menu-item" data-section="thongke">
            <i class="fas fa-user-tie"></i>Thống Kê
        </button>
        <button class="menu-item" onclick="location.href='index.php'">
            <i class="fas fa-sign-out-alt"></i> Trang chủ
        </button>

    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1 id="page-title">Trang Quản Trị</h1>
            <a href="dangxuat.php" class="btn btn-danger" style="text-decoration: none;">Đăng Xuất</a>
        </div>

        <div class="content-area">
          <!-- Tổng quan Section -->
          <div id="tongquan-section" class="section hidden">
                <div style="display: flex; justify-content: center; align-items: center; gap: 20px; margin-bottom: 20px;">
    <?php
    include 'connect.php';

    // Đếm sản phẩm
    $sql = "SELECT COUNT(*) as tong FROM sanpham";
    $result = $conn->query($sql);
    $tongsanpham = ($result && $row = $result->fetch_assoc()) ? $row['tong'] : 0;

    // Đếm đơn hàng
    $sql = "SELECT COUNT(*) as tong FROM donhang";
    $result = $conn->query($sql);
    $tongdonhang = ($result && $row = $result->fetch_assoc()) ? $row['tong'] : 0;
    ?>

    <div class="overview-item">
        <h2><?php echo number_format($tongsanpham); ?></h2>
        <p>Sản phẩm</p>
    </div>

    <div class="overview-item">
        <h2><?php echo number_format($tongdonhang); ?></h2>
        <p>Đơn hàng</p>
    </div>
</div>

          </div>

            <!-- Orders Section -->
            <div id="orders-section" class="section">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Danh Sách Đơn Hàng</h2>
    <div style="display: flex; gap: 10px; align-items: center;">
        <div class="search-box">
            
    <input type="text" id="orders-search-input" placeholder="Tìm kiếm" oninput="checkIfCleared()" />
    <button onclick="filterOrders()">
        <i class="fas fa-search"></i>
    </button>

            <button><i class="fas fa-search"></i></button>
        </div>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Mã Đơn</th>
        <th>Khách Hàng</th>  
        <th>Email</th>      
        <th>Số Điện Thoại</th>
        <th>Ngày Đặt</th>
        <th>Tổng Tiền</th>
        <th>Trạng Thái</th>
        <th>Thao Tác</th>
      </tr>
    </thead>
    <tbody id="orders-tbody">
        <?php include 'ql_donhang.php'; ?>
    </tbody>
  </table>
</div>


            <!-- Customers Section -->
            <div id="customers-section" class="section hidden">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2>Danh Sách Khách Hàng</h2>
                    <div style="display: flex; gap: 10px; align-items: center;">
        <div class="search-box">
            
    <input type="text" id="customer-search-input" placeholder="Tìm kiếm" oninput="checkIfCleared()" />
    <button onclick="filterCustomers()">
        <i class="fas fa-search"></i>
    </button>

            <button><i class="fas fa-search"></i></button>
        </div>
    </div>
                </div>

                <div id="customers-loading" class="loading hidden">
                    <i class="fas fa-spinner fa-spin"></i> Đang tải...
                </div>

                <div class="table-container">
                    <table id="customers-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ Tên</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Ngày Tạo</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody id="customers-tbody">
                            <!-- Data will be loaded here via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Menu Section -->
            <div id="menu-section" class="section hidden">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2>Danh Sách Sản Phẩm</h2>
                    <div style="display: flex; gap: 10px; align-items: center;">
                      
                      <div class="search-box">
            
                        <input type="text" id="product-search-input" placeholder="Tìm kiếm sản phẩm..." oninput="checkIfCleared()" />
                        <button onclick="filterProducts()">
                          <i class="fas fa-search"></i>
                        </button>


                        <button><i class="fas fa-search"></i></button>
                      </div>

                    <a href="them_sanpham.php" class="btn btn-primary" style="text-decoration: none;">                
                      <i class="fas fa-plus"></i> Thêm sản phẩm
                    </a>
                    </div>
                    
                </div>

                <div id="menu-loading" class="loading hidden">
                    <i class="fas fa-spinner fa-spin"></i> Đang tải...
                </div>

                <div class="table-container">
                    <table id="menu-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Mô tả</th>
                                <th>Số lượng</th>                
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-menu">
                            <!-- Dữ liệu nhân viên sẽ được tải qua JS -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Review Section -->
            <div id="review-section" class="section hidden">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2>Danh Sách Đánh Giá</h2>
                    <div class="search-box">
              <input
    type="text"
    id="review-search-input"
    placeholder="Tìm kiếm"
    oninput="checkIfReviewCleared()"
  />
  <button onclick="filterReviews()">
    <i class="fas fa-search"></i>
  </button>
            </div>
                </div>

                <div id="review-loading" class="loading hidden">
                    <i class="fas fa-spinner fa-spin"></i> Đang tải...
                </div>

                <div class="table-container">
                    <table id="review-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ Tên Khách Hàng</th>
                                <th>Nội Dung Đánh Giá</th>
                                <th>Số Sao Đánh Giá</th>
                                <th>Ngày Đánh Giá</th> <!-- Thêm cột Chức vụ -->
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody id="review-tbody">
                            <?php include 'load_danhgia.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- LienHe Section -->
            <div id="lienhe-section" class="section hidden">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2>Danh Sách Liên Hệ</h2>
                    <div class="search-box">
              <input
    type="text"
    id="lienhe-search-input"
    placeholder="Tìm kiếm"
    oninput="checkIfLienHeCleared()"
  />
  <button onclick="filterLienHe()">
    <i class="fas fa-search"></i>
  </button>
            </div>

                </div>

                <div id="lienhe-loading" class="loading hidden">
                    <i class="fas fa-spinner fa-spin"></i> Đang tải...
                </div>

                <div class="table-container">
                    <table id="lienhe-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ Tên Khách Hàng</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Nội Dung Liên Hệ</th>
                                <th>Ngày Liên Hệ</th> <!-- Thêm cột Chức vụ -->
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody id="lienhe-tbody">
  <?php include 'quanly_lienhe.php'; ?>
</tbody>
                    </table>
                </div>
            </div>

            <!--thống kê-->
            <div id="thongke-section" class="section hidden">
                  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                      <h2>Thống Kê</h2>
                      <div>
    <label for="thongke">Thống kê theo:</label>
    <select id="thongke" name="thongke" onchange="loadThongKe()">
    <option value="ngay">Ngày</option>
    <option value="thang">Tháng</option>
  </select>
  </div>
                      <div>
    <label for="bieudo">Biểu đồ:</label>
    <select id="bieudo" name="bieudo" onchange="loaiBieuDo()">
    <option value="sanpham">Sản phẩm</option>
    <option value="doanhthu">Doanh thu</option>
  </select>
  </div>

                      <div class="search-box">
                <input
      type="text"
      id="thongke-search-input"
      placeholder="Tìm kiếm"
      oninput="checkIfLienHeCleared()"
    />
    <button onclick="filterThongKe()">
      <i class="fas fa-search"></i>
    </button>
              </div>

                  </div>

                  <div id="thongke-loading" class="loading hidden">
                      <i class="fas fa-spinner fa-spin"></i> Đang tải...
                  </div>

                  <div class="bieudo-container">
  <div id="bieudo-sanpham" class="bieu-do">
    <?php include 'thongke_bieudo_sanpham.php'; ?>
  </div>

  <div id="bieudo-doanhthu" class="bieu-do" style="display: none;">
    <?php include 'thongke_bieudo_doanhthu.php'; ?>
  </div>
</div>

                  <div class="table-container">
                      <table id="thongke-table">
                          <thead>
                              <tr>
                                  <th>STT</th>
                                  <th>Ngày</th>
                                  <th>Số đơn hàng</th>
                                  <th>Tổng tiền</th>
                                  <th>Thao Tác</th>
                              </tr>
                          </thead>
                          <tbody id="thongke-ngay-tbody">
                            <?php include 'thongke.php'; ?>
                          </tbody>
                      </table>

                      <table id="thongke-thang-table">
                          <thead>
                              <tr>
                                  <th>STT</th>
                                  <th>Tháng</th>
                                  <th>Số đơn hàng</th>
                                  <th>Tổng tiền</th>
                                  <th>Thao Tác</th>
                              </tr>
                          </thead>
                          <tbody id="thongke-thang-tbody">
                            <?php include 'thongke_thang.php'; ?>
                          </tbody>
                      </table>
                  </div>
              </div>

        </div> <!-- End content-area -->
    </div> <!-- End main-content -->
</div> <!-- End container -->

<!-- Modals -->
<!-- Customer Modal -->
<div id="customerModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeCustomerModal()">&times;</span>
        <h3 id="modal-title">Thêm Khách Hàng Mới</h3>
        <form id="customerForm">
            <input type="hidden" id="customer-id">

            <div class="form-group">
                <label for="customer-hoten">Họ Tên:</label>
                <input type="text" id="customer-hoten" name="hoten" required>
            </div>

            <div class="form-group">
                <label for="customer-email">Email:</label>
                <input type="email" id="customer-email" name="email" required>
            </div>

            <div class="form-group">
                <label for="customer-sdt">Số Điện Thoại:</label>
                <input type="text" id="customer-sdt" name="sdt" required>
            </div>

            <div class="form-group" id="password-group">
                <label for="customer-matkhau">Mật Khẩu:</label>
                <input type="password" id="customer-matkhau" name="matkhau" required>
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn" onclick="closeCustomerModal()">Hủy</button>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
</div>

    <script>
        // Navigation handling
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all items
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                // Add active class to clicked item
                this.classList.add('active');
                
                // Hide all sections
                document.querySelectorAll('.section').forEach(section => section.classList.add('hidden'));
                
                // Show selected section
                const sectionName = this.getAttribute('data-section');
                const section = document.getElementById(sectionName + '-section');
                if (section) {
                    section.classList.remove('hidden');
                    
                    // Update page title
                    const titles = {
                        'tongquan': 'Beauty Shop',
                        'orders': 'Quản Lý Đơn Hàng',
                        'customers': 'Quản Lý Khách Hàng',
                        'menu': 'Quản Lý Sản Phẩm',
                        'review': 'Quản Lý Đánh Giá',
                        'lienhe': 'Quản Lý Liên Hệ',
                        'thongke': 'Thống Kê'
                    };
                    document.getElementById('page-title').textContent = titles[sectionName];
                    
                    // Load customers data when customers section is selected
                    if (sectionName === 'customers') {
                        loadCustomers();
                    }
                }
            });
        });
        //////////
        function openAddStaffModal() {
    document.getElementById('staffForm').reset();
    document.getElementById('staff-id').value = '';
    document.getElementById('staff-modal-title').innerText = 'Tạo tài khoản Nhân Viên';
    document.getElementById('staffModal').style.display = 'block';
       }

function closeStaffModal() {
    document.getElementById('staffModal').style.display = 'none';
}

window.addEventListener('click', function(event) {
    const modal = document.getElementById('staffModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});
////
function openEmployeesModal() {
  console.log("Đã gọi openEmployeesModal");
  const modal = document.getElementById('employeesModal');
  modal.classList.remove('hidden');}

/////////
      
    </script>
       <script src="../js/taikhoannv.js"></script>
       <script src="../js/danhsachKH.js"></script>
       <script src="../js/danhsachnv.js"></script>
  <script>
 
</script>
<!-- Mở modal thêm khách hàng-->
 
<script>
  function openAddCustomerModal() {
    document.getElementById("customers").style.display = "block";
  }
</script>

<!-- Đóng modal thêm khách hàng-->
<script>
  function openAddCustomerModal() {
    const modal = document.getElementById("customers");
    if (modal) {
      modal.style.display = "block";
    }
  }
</script>

<!-- Mở modal thêm món-->
<script>
  function openMenuModal() {
    document.getElementById("menu").style.display = "block";
  }
</script>

<!-- Đóng modal thêm món-->
<script>
  function openMenuModal() {
    const modal = document.getElementById("menu");
    if (modal) {
      modal.style.display = "block";
    }
  }
</script>

<script>
  function closeMenuModal() {
    const modal = document.getElementById("menu");
    if (modal) {
      modal.style.display = "none";
    }
  }
</script>

<!--load liên hệ-->
<script>
  document.getElementById("menu-lienhe").addEventListener("click", function () {
  document.getElementById("lienhe-section").classList.remove("hidden");
  loadLienHe();
});

</script> 

<!--load đánh giá-->
<script>
  document.getElementById("menu-review").addEventListener("click", function () {
  document.getElementById("review-section").classList.remove("hidden");
  loadLienHe();
});
</script>

<!--tìm kiếm khách hàng-->
<script>
function filterCustomers() {
    const input = document.getElementById("customer-search-input");
    const filter = input.value.toLowerCase().trim();
    const rows = document.querySelectorAll("#customers-tbody tr");

    rows.forEach(row => {
        const rowText = row.innerText.toLowerCase();
        row.style.display = rowText.includes(filter) ? "" : "none";
    });
}

function checkIfCleared() {
    const input = document.getElementById("customer-search-input");
    const filter = input.value.toLowerCase().trim();

    if (filter === "") {
        // Nếu ô tìm kiếm bị xóa sạch → hiển thị lại toàn bộ danh sách
        const rows = document.querySelectorAll("#customers-tbody tr");
        rows.forEach(row => {
            row.style.display = "";
        });
    }
}
</script>

<!--tìm kiếm đánh giá-->
<script>
function filterReviews() {
  const input = document.getElementById("review-search-input");
  const filter = input.value.toLowerCase().trim();
  const rows = document.querySelectorAll("#review-tbody tr");

  rows.forEach(row => {
    const rowText = row.innerText.toLowerCase();
    row.style.display = rowText.includes(filter) ? "" : "none";
  });
}

function checkIfReviewCleared() {
  const input = document.getElementById("review-search-input");
  const filter = input.value.toLowerCase().trim();

  // Nếu người dùng xóa hết nội dung tìm kiếm → hiện lại toàn bộ
  if (filter === "") {
    const rows = document.querySelectorAll("#review-tbody tr");
    rows.forEach(row => {
      row.style.display = "";
    });
  }
}
</script>

<!--tìm kiếm liên hệ-->
<script>
function filterLienHe() {
  const input = document.getElementById("lienhe-search-input");
  const filter = input.value.toLowerCase().trim();
  const rows = document.querySelectorAll("#lienhe-tbody tr");

  rows.forEach(row => {
    const rowText = row.innerText.toLowerCase();
    row.style.display = rowText.includes(filter) ? "" : "none";
  });
}

function checkIfLienHeCleared() {
  const input = document.getElementById("lienhe-search-input");
  const filter = input.value.toLowerCase().trim();

  if (filter === "") {
    const rows = document.querySelectorAll("#lienhe-tbody tr");
    rows.forEach(row => {
      row.style.display = "";
    });
  }
}
</script>

<!--tìm kiếm sản phẩm-->
<script>
function filterProducts() {
  const input = document.getElementById("product-search-input");
  const filter = input.value.toLowerCase().trim();
  const rows = document.querySelectorAll("#table-body-menu tr");

  rows.forEach(row => {
    const rowText = row.innerText.toLowerCase();
    row.style.display = rowText.includes(filter) ? "" : "none";
  });
}

function checkIfCleared() {
  const input = document.getElementById("product-search-input");
  const filter = input.value.toLowerCase().trim();

  if (filter === "") {
    const rows = document.querySelectorAll("#table-body-menu tr");
    rows.forEach(row => {
      row.style.display = "";
    });
  }
}
</script>

<!--tìm kiếm đơn hàng-->
<script>
function filterOrders() {
  const input = document.getElementById("orders-search-input");
  const filter = input.value.toLowerCase().trim();
  const rows = document.querySelectorAll("#orders-tbody tr");

  rows.forEach(row => {
    const rowText = row.innerText.toLowerCase();
    row.style.display = rowText.includes(filter) ? "" : "none";
  });
}

function checkIfCleared() {
  const input = document.getElementById("orders-search-input");
  const filter = input.value.toLowerCase().trim();

  if (filter === "") {
    const rows = document.querySelectorAll("#orders-tbody tr");
    rows.forEach(row => {
      row.style.display = "";
    });
  }
}
</script>

<!--load sản phẩm lên trang admin-->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById("table-body-menu");
    const loading = document.getElementById("menu-loading");

    function loadProducts() {
        loading.classList.remove("hidden");

        fetch("lay_sanpham.php")
            .then(res => res.json())
            .then(data => {
                tableBody.innerHTML = "";

                if (!Array.isArray(data) || data.length === 0) {
                    tableBody.innerHTML = "<tr><td colspan='7'>Không có sản phẩm nào.</td></tr>";
                    return;
                }

                data.forEach(sp => {
                    const moTaRutGon = sp.moTa.length > 50 ? sp.moTa.substring(0, 50) + "..." : sp.moTa;

                    tableBody.innerHTML += `
                        <tr>
                            <td>${sp.maSP}</td>
                            <td>${sp.tenSP}</td>
                            <td>${sp.giaBan}</td>
                            <td>${moTaRutGon}</td>
                            <td>${sp.soLuong}</td>
                            <td>
                                <a href="sua_sp.php?id=${sp.maSP}" class="btn btn-success btn-sm" style="text-decoration: none;">Sửa</a>
                                <button class="btn btn-danger btn-sm" onclick="xoaSanPham(${sp.maSP})">Xóa</button>
                            </td>
                        </tr>`;
                });
            })
            .catch(error => {
                console.error("Lỗi khi tải sản phẩm:", error);
                tableBody.innerHTML = "<tr><td colspan='7'>Lỗi tải dữ liệu.</td></tr>";
            })
            .finally(() => loading.classList.add("hidden"));
    }

    loadProducts();
});
</script>

<!--xóa sản phẩm-->
<script>
function xoaSanPham(id) {
    if (!confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) return;

    fetch("xoa_sanpham.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id=${id}`
    })
    .then(res => res.text())
    .then(data => {
        alert(data.trim());
        // Sau khi xóa, reload lại danh sách
        document.dispatchEvent(new Event("DOMContentLoaded"));
    })
    .catch(error => {
        console.error("Lỗi khi xóa sản phẩm:", error);
        alert("Xóa thất bại.");
    });
}
</script>


<script>
  function loaiBieuDo() {
    var loai = document.getElementById("bieudo").value;

    // Ẩn cả hai
    document.getElementById("bieudo-sanpham").style.display = "none";
    document.getElementById("bieudo-doanhthu").style.display = "none";

    // Hiện đúng loại được chọn
    if (loai === "sanpham") {
      document.getElementById("bieudo-sanpham").style.display = "block";
    } else if (loai === "doanhthu") {
      document.getElementById("bieudo-doanhthu").style.display = "block";
    }
  }

// Gọi khi trang vừa load để hiển thị đúng mặc định
  window.onload = function () {
    loaiBieuDo();
  };
</script>


<script>
  window.onload = function () {
    loadThongKe(); // gọi mặc định khi trang vừa load
  };

  function loadThongKe() {
  const loai = document.getElementById("thongke").value;

  // Hiện loading
  document.getElementById("thongke-loading").classList.remove("hidden");

  // Ẩn cả hai bảng
  document.getElementById("thongke-table").classList.add("hidden");
  document.getElementById("thongke-thang-table").classList.add("hidden");

  // Gửi AJAX
  const xhr = new XMLHttpRequest();
  let file = "";
  let tbodyId = "";

  if (loai === "ngay") {
    file = "thongke.php";
    tbodyId = "thongke-ngay-tbody";
  } else if (loai === "thang") {
    file = "thongke_thang.php";
    tbodyId = "thongke-thang-tbody";
  }

  xhr.open("GET", file, true);
  xhr.onload = function () {
    document.getElementById("thongke-loading").classList.add("hidden");

    if (xhr.status === 200) {
      document.getElementById(tbodyId).innerHTML = xhr.responseText;

      if (loai === "ngay") {
        document.getElementById("thongke-table").classList.remove("hidden");
      } else if (loai === "thang") {
        document.getElementById("thongke-thang-table").classList.remove("hidden");
      }
    } else {
      document.getElementById(tbodyId).innerHTML = "<tr><td colspan='5'>Không thể tải dữ liệu.</td></tr>";
    }
  };
  xhr.send();
}
</script>

<script>
function filterThongKe() {
  const loai = document.getElementById("thongke").value;
  const keyword = document.getElementById("thongke-search-input").value.trim();

  if (loai === "ngay") {
    filterTheoNgay(keyword);
  } else if (loai === "thang") {
    filterTheoThang(keyword);
  }
}

function filterTheoNgay(keyword) {
  const regex = /^\d{2}\/\d{2}\/\d{4}$/;
  if (!regex.test(keyword)) {
    alert("Nhập đúng định dạng ngày! Ví dụ: 30/06/2025.");
    return;
  }

  const keywordSQL = keyword.split("/").reverse().join("-"); // DD/MM/YYYY → YYYY-MM-DD
  const rows = document.querySelectorAll(".ngay-thongke");

  rows.forEach(row => {
    const ngayText = row.children[1]?.textContent.trim(); // Cột ngày
    row.style.display = (ngayText === keywordSQL) ? "" : "none";
  });
}

function filterTheoThang(keyword) {
  const regex = /^\d{2}\/\d{4}$/;
  if (!regex.test(keyword)) {
    alert("Nhập đúng định dạng tháng! Ví dụ: 06/2025.");
    return;
  }

  const rows = document.querySelectorAll(".row-thongke");

  rows.forEach(row => {
    const thangText = row.children[1]?.textContent.trim(); // Cột tháng
    row.style.display = (thangText === keyword) ? "" : "none";
  });
}

function checkIfLienHeCleared() {
  const keyword = document.getElementById("thongke-search-input").value.trim();

  if (keyword === "") {
    document.querySelectorAll(".ngay-thongke, .row-thongke").forEach(row => {
      row.style.display = "";
    });
  }
}
</script>


</body>
</html>