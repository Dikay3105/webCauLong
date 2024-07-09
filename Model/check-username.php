<?php
require_once(__DIR__ . '/../Model/ModelUser.php');

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'editUser') {
    // If action is 'edit', retrieve the user ID and username from the GET parameters
    $id = $_GET['formIdUser'];
    $username = $_GET['formUsername'];

    $modeluser = new ModelUser();
    if (!$modeluser->checkExistingUsername2($id, $username)) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
} else {
    // If action is not 'edit', simply check the username existence
    $username = $_GET['formName'];

    $modeluser = new ModelUser();
    if (!$modeluser->checkExistingUsername($username)) {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
}
?>
