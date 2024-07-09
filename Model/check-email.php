<?php
require_once(__DIR__ . '/../Model/ModelUser.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'editUser') {
    // If action is 'edit', retrieve the user ID and email from the GET parameters
    $id = $_GET['formIdUser'];
    $email = $_GET['formEmail'];
    $modeluser = new ModelUser();
    if (!$modeluser->checkExistingEmail2($id, $email)) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
}  else {
    // If action is not 'edit', simply check the email existence
    $email = $_GET['formEmail'];

    $modeluser = new ModelUser();
    if (!$modeluser->checkExistingEmail($email)) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
} 
?>
