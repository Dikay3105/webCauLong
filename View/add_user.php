<?php
// add_user.php
require('../Model/ModelUser.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $phoneNumber = $_POST['phoneNumber'];
    $roleID = $_POST['roleID'];
    $point = $_POST['point'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    $modelUser = new ModelUser();
    $modelUser->addUser($username, $password, $roleID, $name, $mail, $phoneNumber, $point, $type, $status);

    echo "Thêm người dùng thành công";
}
?>
