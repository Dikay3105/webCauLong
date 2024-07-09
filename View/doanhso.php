<?php
require_once __DIR__ . '../../Model/ModelTransaction.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Retrieve start and end dates from GET request
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    
    // Convert date strings to timestamps for comparison
    $startDateTimestamp = strtotime($startDate);
    $endDateTimestamp = strtotime($endDate);

    // Check if start date is after end date
    if ($startDateTimestamp > $endDateTimestamp) {
        // Return error message as JSON
        echo json_encode(['error' => 'Ngày bắt đầu không được sau ngày kết thúc.']);
        exit();
    }

    // Create an instance of ModelTransaction and fetch sales data
    $modelTransaction = new ModelTransaction();
    $salesData = $modelTransaction->displayTotalSales($startDate, $endDate);

    // Return the sales data as JSON
    echo json_encode($salesData);
}
?>
