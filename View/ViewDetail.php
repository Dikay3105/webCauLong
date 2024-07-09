<?php
require_once __DIR__ . '../../../web_BadmintonStore/Model/ModelOrderTransaction.php';
require_once __DIR__ . '../../../web_BadmintonStore/Model/ModelProduct.php'; 

if (isset($_GET['transactionID'])) {
    $orderID = $_GET['transactionID'];
    $modelOrderTransaction = new ModelOrderTransaction();
    $orderDetails = $modelOrderTransaction->getOrderTransactionDetails($orderID);

    if ($orderDetails) {
        echo "<h2>Chi tiết đơn hàng cho mã đơn hàng $orderID:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Tên sản phẩm</th><th>Số lượng</th><th>Giá</th><th>Thành tiền</th></tr>";
        foreach ($orderDetails as $detail) {
            $subtotal = $detail['quantity'] * $detail['total_amonut']; // Calculate subtotal
            echo "<tr><td>" . $detail['productName'] . "</td><td>" . $detail['quantity'] . "</td><td>" . $detail['productPrice'] . "</td><td>" . $detail['total_amonut'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "Không có chi tiết nào cho đơn hàng có mã $orderID";
    }
} else {
    echo "Mã đơn hàng không được cung cấp";
}

?>
