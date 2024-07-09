<?php
require_once(__DIR__ . '/../Model/ModelUser.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'editUser') {
    $id = $_GET['formIdUser'];
    $phone = $_GET['formPhone'];

    $modeluser = new ModelUser();
    if (!$modeluser->checkExistingPhoneNumber2($id, $phone)) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
} else {
    $phone = $_GET['formPhone'];

    $modeluser = new ModelUser();
    if (!$modeluser->checkExistingPhoneNumber($phone)) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
}
?>
