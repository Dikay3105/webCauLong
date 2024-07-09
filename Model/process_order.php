<?php
session_start();
require_once 'database.php';
require_once __DIR__ . '/../../../Model/ModelUser.php';
require_once __DIR__ . '/../../../Model/ModelTransaction.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modelUser = new ModelUser();
    $modelTransaction = new ModelTransaction();
    
    $db = new Database();

    $result = $db->select("SELECT MAX(transactionID) AS max_id FROM transaction");
    $row = $result->fetch_assoc();
    $transactionID = $row['max_id'] + 1;
    
    $userID = $modelUser->getUIDByUserName($_SESSION['username']);
    $total = $_POST['total'];
    $note = $_POST['notes'];
    $time = date('Y-m-d H:i:s');
    $address = $_POST['address'];
    $check = 'Chưa xác nhận'; 
    $transport = '';
    $status = 1; 
    $name_receiver = $_POST['fullname'];
    $phone_receiver = $_POST['phone'];

    $modelTransaction->addTransaction($transactionID, $userID, $total, $note, $time, $address, $check, $transport, $status, $name_receiver, $phone_receiver);
}
?>
