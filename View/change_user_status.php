<?php
require_once __DIR__ . '../../Model/ModelUser.php';

// Check if the request method is GET and if the required parameters are set
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['userID']) && isset($_GET['newStatus'])) {
    // Extract userID and newStatus from the GET parameters
    $userID = $_GET['userID'];
    $newStatus = $_GET['newStatus'];
   
    // Khởi tạo một đối tượng ModelUser
    $modelUser = new ModelUser();
    
    // Gọi phương thức changeUserStatus để thay đổi trạng thái người dùng
    $modelUser->changeUserStatus($userID, $newStatus);

    // Trả về thông báo thành công
    echo "User status changed successfully";
} else {
    // Nếu phương thức yêu cầu không phải là GET hoặc các tham số cần thiết không được thiết lập, trả về thông báo lỗi
    echo "Invalid request";
}
?>