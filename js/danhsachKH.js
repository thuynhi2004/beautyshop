// Gọi khi vào tab Khách Hàng
fetch("danhsachKH.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
  },
  body: "action=get_customers",
})
  .then((response) => {
    if (!response.ok) {
      throw new Error("HTTP error " + response.status);
    }
    return response.json();
  })
  .then((data) => {
    console.log("Dữ liệu khách hàng:", data); // ← Kiểm tra tại đây
    document.getElementById("customers-loading").classList.add("hidden");
    displayCustomers(data);
  })
  .catch((error) => {
    console.error("Lỗi khi fetch:", error);
    alert("Có lỗi khi tải danh sách khách hàng");
  });

function displayCustomers(customers) {
  const tbody = document.getElementById("customers-tbody");
  tbody.innerHTML = "";

  customers.forEach((customer) => {
    const row = `
            <tr>
                <td>${customer.id}</td>
                <td>${customer.hoten}</td>
                <td>${customer.email}</td>
                <td>${customer.sdt}</td>
                <td>${new Date(customer.created_at).toLocaleDateString(
                  "vi-VN"
                )}</td>
                <td>
                    <button class="btn btn-success" onclick="editCustomer(${
                      customer.id
                    }, '${customer.hoten}', '${customer.email}', '${
      customer.sdt
    }')">
                        <i class="fas fa-edit"></i> Sửa
                    </button>
                    <button class="btn btn-danger" onclick="deleteCustomer(${
                      customer.id
                    })">
                        <i class="fas fa-trash"></i> Xóa
                    </button>
                </td>
            </tr>
        `;
    tbody.innerHTML += row;
  });
}

function openAddCustomerModal() {
  document.getElementById("modal-title").textContent = "Thêm Khách Hàng Mới";
  document.getElementById("customerForm").reset();
  document.getElementById("customer-id").value = "";
  document.getElementById("password-group").style.display = "block";
  document.getElementById("customer-matkhau").required = true;
  document.getElementById("customerModal").style.display = "block";
}

function editCustomer(id, hoten, email, sdt) {
  document.getElementById("modal-title").textContent =
    "Sửa Thông Tin Khách Hàng";
  document.getElementById("customer-id").value = id;
  document.getElementById("customer-hoten").value = hoten;
  document.getElementById("customer-email").value = email;
  document.getElementById("customer-sdt").value = sdt;
  document.getElementById("password-group").style.display = "none";
  document.getElementById("customer-matkhau").required = false;
  document.getElementById("customerModal").style.display = "block";
}

function closeCustomerModal() {
  document.getElementById("customerModal").style.display = "none";
}

function deleteCustomer(id) {
  if (confirm("Bạn có chắc muốn xóa khách hàng này?")) {
    fetch("danhsachKH.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `action=delete_customer&id=${id}`,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Xóa khách hàng thành công!");
          loadCustomers();
        } else {
          alert("Xóa thất bại!");
        }
      })
      .catch((error) => {
        alert("Lỗi khi xóa khách hàng");
      });
  }
}

// Submit form
document
  .getElementById("customerForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const customerId = document.getElementById("customer-id").value;

    if (customerId) {
      formData.append("action", "update_customer");
      formData.append("id", customerId);
    } else {
      formData.append("action", "add_customer");
    }

    fetch("../php/danhsachKH.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert(customerId ? "Cập nhật thành công!" : "Thêm thành công!");
          closeCustomerModal();
          loadCustomers();
        } else {
          alert("Lỗi khi lưu thông tin khách hàng");
        }
      })
      .catch((error) => {
        alert("Lỗi khi gửi dữ liệu");
      });
  });

// Đóng modal nếu click ngoài
window.onclick = function (event) {
  const modal = document.getElementById("customerModal");
  if (event.target == modal) {
    closeCustomerModal();
  }
};
