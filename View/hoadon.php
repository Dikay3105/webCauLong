<div id="hoadon-content" class="content-section">
        <div id="transaction-details"></div>
        
        <?php
    
require_once __DIR__ . '../../Model/ModelTransaction.php';

// Tạo một đối tượng ModelTransaction
$modelTransaction = new ModelTransaction();

// Lấy tất cả các giao dịch từ cơ sở dữ liệu
$transactions = $modelTransaction->getAllTransactions();

// Kiểm tra xem có giao dịch nào không
if ($transactions) {
    // In ra tiêu đề của bảng
    echo "<table border='1'>
            <tr>
                <th>Transaction ID</th>
                <th>Total</th>
                <th>Note</th>
                <th>Time</th>
                <th>Address</th>
                <th>Detail</th>
            </tr>";

    // Duyệt qua từng giao dịch và in ra thông tin
    foreach ($transactions as $transaction) {
        $transactionObj = new Transaction(
            $transaction['transactionID'],
            $transaction['userID'],
            $transaction['total'],
            $transaction['note'],
            $transaction['time'],
            $transaction['address']
        );

        echo "<tr>
                <td>".$transactionObj->getTransactionID()."</td>
                <td>".$transactionObj->getTotal()."</td>
                <td>".$transactionObj->getNote()."</td>
                <td>".$transactionObj->getTime()."</td>
                <td>".$transactionObj->getAddress()."</td>
                <td> <button> Xem chi tiet </button> </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Không có giao dịch nào.";
}
?>
<script>
function showTransactionDetails(transactionID) {
    // Tạo một yêu cầu AJAX để lấy chi tiết hóa đơn
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '', true);

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Hiển thị chi tiết hóa đơn trong một cửa sổ popup
            var transactionDetails = JSON.parse(this.responseText);
            var popupContent = '<h2>Chi tiết hóa đơn</h2>';
            popupContent += '<p>Transaction ID: ' + transactionDetails.transactionID + '</p>';
            popupContent += '<p>User ID: ' + transactionDetails.userID + '</p>';
            // Thêm các thông tin khác tùy thuộc vào cấu trúc của dữ liệu chi tiết hóa đơn

            // Hiển thị cửa sổ popup
            var popupWindow = window.open('', '_blank', 'width=600,height=400');
            popupWindow.document.write(popupContent);
        }
    };
    xhr.send("transactionID=" + transactionID);
}
</script>