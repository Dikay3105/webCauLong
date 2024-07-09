<?php
//  kết nối server
require_once  "../Model/database.php";
require_once "./Badminton_Admin.php";

$ModelProduct = new ModelProduct();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // Kiểm tra và lấy dữ liệu từ form
   $name = isset($_POST['name']) ? $_POST['name'] : null;
   $price = isset($_POST['price']) ? $_POST['price'] : null;
   $discount = isset($_POST['discount']) ? $_POST['discount'] : null;
   $description = isset($_POST['description']) ? $_POST['description'] : null;
   $image = isset($_POST['image']) ? $_POST['image'] : null;

   if($name && $price && $discount && $description && $image){
    $result = $ModelProduct -> addProduct($name, $price, $discount, $status, $description, $image);
    if ($result->status == 200) {
      echo "<script>alert('Thêm sản phẩm thành công!')</script>";
      // header("Location: ./Badminton_Admin.php");
      exit;
  } else {
      echo "<script>alert('Không thể thêm sản phẩm:')</script> " . $result->message;
  }
} else {
  echo "<script>alert('Vui lòng nhập đầy đủ thông tin!')</script>";
}
  }
