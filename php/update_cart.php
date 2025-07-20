<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['key']) && isset($_POST['quantity'])) {
    $key = intval($_POST['key']);
    $quantity = max(1, intval($_POST['quantity'])); // Không cho nhỏ hơn 1

    if (isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key]['quantity'] = $quantity;

        // Tính lại tổng
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['giaBan'] * $item['quantity'];
        }

        echo json_encode([
            'status' => 'success',
            'cart' => $_SESSION['cart'],
            'total' => $total
        ]);
        exit;
    }
}

echo json_encode(['status' => 'error']);
exit;
