<?php
// Include các file cần thiết
require_once '../Model/ModelRole.php';
        
// Xử lý yêu cầu AJAX
if (isset($_POST['roleID']) && isset($_POST['roleName'])) {     
    // Lấy dữ liệu từ form
    $roleID = $_POST['roleID'];
    $roleName = $_POST['roleName'];

    // Khởi tạo đối tượng ModelRole
    $modelRole = new ModelRole();

    // Gọi hàm updateRole từ ModelRole để cập nhật vai trò
    $result = $modelRole->updateRole($roleID, $roleName);

    // Kiểm tra kết quả và phản hồi
    if ($result) {
        echo json_encode(array(
            'message' => "Cập nhật thành công.",
            'status' => 1
        ));
        exit;
    } else {
        echo json_encode(array(
            'message' => "Cập nhật thất bại.",
            'status' => 0
        ));
    }
    exit;
} else {
    echo json_encode(array(
        'message' => "Lỗi: Thiếu thông tin cần thiết.",
        'status' => 0
    ));
    exit;
}

?>
