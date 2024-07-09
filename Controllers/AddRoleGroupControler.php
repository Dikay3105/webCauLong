<?php
require_once '../Model/ModelRole.php';
require_once '../Model/ModelPermission.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu JSON từ body của yêu cầu
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    // Kiểm tra xem dữ liệu JSON có được giải mã thành công hay không
    if (is_null($data)) {
        echo json_encode(['error' => 'Invalid JSON data']);
        exit;
    }

    // Kiểm tra sự tồn tại của roleID và switchValues
    if (!isset($data['roleID']) || !isset($data['switchValues'])) {
        echo json_encode(['error' => 'Missing roleID or switchValues']);
        exit;
    }

    $roleID = $data['roleID'];
    $switchValues = $data['switchValues']; // Đây là một mảng các đối tượng { functionID: x, permissionName: y }

    $modelPermission = new ModelPermission();

    foreach ($switchValues as $switchValue) {
        // Kiểm tra xem switchValue có phải là một mảng và chứa các khóa cần thiết hay không
        if (!is_array($switchValue) || !isset($switchValue['functionID']) || !isset($switchValue['permissionName'])) {
            echo json_encode(['error' => 'Invalid switchValue format']);
            exit;
        }

        $functionID = $switchValue['functionID'];
        $permissionName = $switchValue['permissionName'];

        // Thêm quyền mới vào cơ sở dữ liệu
        $result = $modelPermission->addPermission($roleID, $functionID, $permissionName);

        if (!$result) {
            echo json_encode(false);
            exit;
        }
    }

    echo json_encode(true);
}
?>
