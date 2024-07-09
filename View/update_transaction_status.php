<?php
require_once __DIR__ .'../../../web_BadmintonStore/Model/ModelTransaction.php';

// Kiểm tra xem yêu cầu là GET và có dữ liệu gửi lên không
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["transactionID"]) && isset($_GET["status"])) {
    // Lấy transactionID và newStatus từ dữ liệu gửi lên
    $transactionID = $_GET["transactionID"];
    $newStatus = $_GET["status"];
 
    

    // Tạo một đối tượng ModelTransaction
    $modelTransaction = new ModelTransaction();

    // Cập nhật trạng thái của giao dịch và kiểm tra kết quả
    if ($modelTransaction->updateTransactionStatus($transactionID, $newStatus)) {
        // Trả về thông báo cập nhật thành công
        echo 'success';
    } else {
        // Trả về thông báo cập nhật thất bại
        echo 'failure';
    }
} else {
    // Trả về thông báo nếu yêu cầu không hợp lệ
    echo 'invalid request';
}
?>
