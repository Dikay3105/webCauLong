<?php
// Kết nối server
require_once "../Model/database.php";
require_once "../Controllers/Badminton_Admin.php";
$ModelProduct = new ModelProduct();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $productID = $_POST['productID'];
    $name = $_POST['name'];
    $price = (int)str_replace(".", "", $_POST['price']);
    $fakePrice = (int)str_replace(".", "", $_POST['discount']);
    $status = $_POST['status'];

    $tmp = 0;
    if ($status == "Đang bán") {
        $tmp = 1;
    } else if ($status == "Ngưng bán") {
        $tmp = 0;
    } else if ($status == "Đã xóa") {
        $tmp = -1;
    }

    // Kiểm tra xem dữ liệu có hợp lệ không
    if ($productID && $name && $price && $fakePrice && $status) {
        // Cập nhật sản phẩm và xử lý kết quả
        $result = $ModelProduct->updateProduct($productID, $name, $price, $fakePrice, $tmp);
        if ($result) {
            echo "<script>alert('Sửa sản phẩm thành công!')</script><script>window.location.href='../Controllers/Badminton_Admin.php';</script>";
        } else {
            echo "<script>alert('Không thể cập nhật sản phẩm');</script>";
        }
    } else {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin!');</script>";
    }
}
?>
