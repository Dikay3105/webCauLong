<?php
require_once '../Model/ModelRole.php';
require_once '../Model/ModelPermission.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents("php://input"), true);

    $roleID = $inputData['roleID'] ?? null;
    $switchValues = $inputData['switchValues'] ?? null;
    $modelPermission = new ModelPermission();
    for ($i = 1; $i <= 6; $i++) {
        $modelPermission->deletePermission($roleID, $i);
    }
    
    if ($roleID && $switchValues) {
        
        foreach ($switchValues as $switchValue) {
            $functionID = $switchValue['functionID'];
            $permissionName = $switchValue['permissionName'];

            $result = $modelPermission->addPermission($roleID, $functionID, $permissionName);

            if (!$result) {
                echo json_encode(['error' => 'Failed to add permission']);
                exit;
            }
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Invalid JSON data']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
