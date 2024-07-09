<?php 
require_once '../Model/ModelUser.php';
require_once '../Model/ModelPermission.php';

session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    $userModel = new ModelUser();
    $permissionModel = new ModelPermission();
    
    $roleID = $userModel->getRoleIDByUsername($username);
    
    if ($roleID) {
        $permissions = $permissionModel->getPermissionsByRoleID($roleID);
        echo json_encode(['status' => 'success', 'permissions' => $permissions]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy vai trò']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Người dùng chưa đăng nhập']);
}


?>