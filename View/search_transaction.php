<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['startDate']) && isset($_GET['endDate']) && isset($_GET['transport'])) {
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $transport = $_GET['transport'];

    $startDateTimestamp = strtotime($startDate);
    $endDateTimestamp = strtotime($endDate);

    if ($startDateTimestamp > $endDateTimestamp) {
        echo json_encode(['error' => 'Ngày bắt đầu không được sau ngày kết thúc.']);
        exit();
    }

    require_once __DIR__ . '../../Model/ModelTransaction.php';
    $modelTransaction = new ModelTransaction();
    $transactions = $modelTransaction->getTransactionsByDateAndTransport($startDate, $endDate, $transport);

    $tableContent = '';

    if ($transactions) {
        $tableContent .= "<table border='1'>
                    <tr>
                        <th>Transaction ID</th>
                        <th>User ID</th>
                        <th>Total</th>
                        <th>Note</th>
                        <th>Time</th>
                        <th>Address</th>
                        <th>Check</th>
                        <th>Transport</th>
                        <th>Name Receiver</th>
                        <th>Phone Receiver</th>
                        <th>Detail</th>
                        <th>Change Transport</th>
                    </tr>";

        foreach ($transactions as $transaction) {
            $tableContent .= "<tr>";
            $tableContent .= "<td>" . $transaction->getTransactionID() . "</td>";
            $tableContent .= "<td>" . $transaction->getUserID() . "</td>";
            $tableContent .= "<td>" . $transaction->getTotal() . "</td>";
            $tableContent .= "<td>" . $transaction->getNote() . "</td>";
            $tableContent .= "<td>" . $transaction->getTime() . "</td>";
            $tableContent .= "<td>" . $transaction->getAddress() . "</td>";
            $tableContent .= "<td>" . $transaction->getCheck() . "</td>";
            $tableContent .= "<td>" . $transaction->getTransport() . "</td>";
            $tableContent .= "<td>" . $transaction->getNameReceiver() . "</td>";
            $tableContent .= "<td>" . $transaction->getPhoneReceiver() . "</td>";
            $tableContent .= "<td><button onclick='showTransactionDetails(" . $transaction->getTransactionID() . ")'>View Details</button></td>";
            $tableContent .= "<td>
                    <select id='status" . $transaction->getTransactionID() . "'>
                        <option value=''>Select Status</option>
                        <option value='Đang giao hàng'>Đang giao hàng</option>
                        <option value='Đã giao hàng'>Đã giao hàng</option>
                    </select>
                    <button onclick='changeTransactionStatus(" . $transaction->getTransactionID() . ")'>Save</button>
                  </td>";
            $tableContent .= "</tr>";
        }

        $tableContent .= "</table>";
    } else {
        $tableContent = "Không tìm thấy đơn hàng nào trong khoảng thời gian này.";
    }

    echo json_encode(['tableContent' => $tableContent]);
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
