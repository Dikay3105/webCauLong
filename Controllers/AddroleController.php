<?php
// Include các file cần thiết
require_once '../Model/ModelRole.php';

// Xử lý yêu cầu AJAX
if (isset($_POST['roleName'])) {     
    // Lấy dữ liệu từ form
    $roleName = $_POST['roleName'];

    // Khởi tạo đối tượng ModelRole
    $modelRole = new ModelRole();

    // Gọi hàm updateRole từ ModelRole để cập nhật vai trò
    $result = $modelRole->addRole($roleName);

    // Kiểm tra kết quả và phản hồi
    if ($result) {
        echo json_encode(array(
            'message' => "Thêm thành công.",
            'status' => 1
        ));
        exit;
    } else {
        echo json_encode(array(
            'message' => "Thêm thất bại.",
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
