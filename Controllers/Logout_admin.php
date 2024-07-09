<?php
session_start();

if (isset($_SESSION['login'])) {
    unset($_SESSION['login']);
    unset($_SESSION['username']);
    unset($_SESSION['type']);
    $response = ['status' => 1]; // Đăng xuất thành công
} else {
    $response = ['status' => 0]; // Đăng xuất không thành công
}

// Trả về một phản hồi dưới dạng JSON
header('Content-Type: application/json');
echo json_encode($response);
exit; // Kết thúc xử lý PHP ở đây
?>
