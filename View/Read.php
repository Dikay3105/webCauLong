<?php
//  kết nối server
require_once "../Model/database.php";
require_once "../Model/ModelProduct.php";
require_once "../View/Badminton_Admin.php";

// Viết truy vấn SQL
$sql = "SELECT * FROM `product`";

// Thực thi truy vấn
$result = mysqli_query($conn,$sql);

// Lặp qua kết quả và hiển thị dữ liệu
if (mysqli_num_rows($result)) {
  echo "<table>";
  echo "<tr><th>ID</th><th>Tên</th><th>Giá</th><th>Thương hiệu</th><th>Phân loại</th><th>Trọng lượng</th><th>Kích thước</th><th>Chất liệu</th><th>Hình ảnh</th></tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["productID"] . "</td>";
    echo "<td>" . $row["brandID"] . "</td>";
    echo "<td>" . $row["catalogID"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["price"] . "</td>";
    echo "<td>" . $row["discount"] . "</td>";
    echo "<td>" . $row["description"] . "</td>";
    echo "<td>" . $row["image"] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
  header("Location : Badminton_Admin.php");
} else {
  echo "Không có sản phẩm nào.";
}