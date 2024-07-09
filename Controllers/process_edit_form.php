<?php 
require_once __DIR__ . '../../Model/ModelPermission.php';

// Khởi tạo đối tượng ModelPermission
$modelPermission = new ModelPermission();

// Lấy danh sách quyền từ cơ sở dữ liệu
$listpermission = $modelPermission->getAllPermissions();

// Chuyển đổi danh sách quyền thành dạng JSON
$permissionsJSON = json_encode($listpermission);

// Trả về dữ liệu JSON
echo $permissionsJSON;
?>
