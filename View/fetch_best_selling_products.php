<?php
require_once __DIR__ . '../../Model/ModelTransaction.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $startDate = $_GET['startDate']; // Thêm dòng này để lấy ngày bắt đầu
    $endDate = $_GET['endDate']; // Thêm dòng này để lấy ngày kết thúc
    $topNumber = $_GET['topNumber'];
    $statType = $_GET['statType'];
 

    try {
        $modelTransaction = new ModelTransaction();
        $bestSellingProducts = $modelTransaction->getBestSellingProducts($topNumber, $statType, $startDate, $endDate); // Thêm tham số cho hàm
        echo json_encode($bestSellingProducts);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
