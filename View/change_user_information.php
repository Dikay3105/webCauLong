<?php
require('../Model/ModelUser.php');

// Check if the request method is GET and if the required parameters are set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
 $userID = $_POST['userID'];
 $username = $_POST['username'];
 $password = $_POST['password'];
 $name = $_POST['name'];
 $roleID = $_POST['role'];
 $email = $_POST['email'];
 $status = $_POST['status'];
 $phoneNumber = $_POST['phoneNumber'];
 $point = $_POST['point'];
 $type = $_POST['type'];    
   
    // Khởi tạo một đối tượng ModelUser
    $modelUser = new ModelUser();
    
    // Gọi phương thức changeUserStatus để thay đổi trạng thái người dùng
    $modelUser->updateUser($userID, $username, $password, $roleID, $name, $email, $phoneNumber, $point, $type, $status);

    // Trả về thông báo thành công
    echo "Thay đổi trạng thái thành công";
} else {
    // Nếu phương thức yêu cầu không phải là GET hoặc các tham số cần thiết không được thiết lập, trả về thông báo lỗi
    echo "Yêu cầu không hợp lệ";
}
?>