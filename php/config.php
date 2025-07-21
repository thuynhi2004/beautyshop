<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  
// Load cấu hình VNPAY
$vnp_TmnCode = "L0T06460"; // Mã website VNPAY (cung cấp bởi VNPAY)
$vnp_HashSecret = "I5IETICLMNY1VSS2E1ZV3SAENLRV5CRX"; // Chuỗi bí mật (do VNPAY cấp)
$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // Đường dẫn cổng test
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
$vnp_Returnurl = "https://shopbeauty.lovestoblog.com/"; // URL sau khi thanh toán xong


//Config input format
//Expire
$startTime = date("YmdHis");
$expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));
