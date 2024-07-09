<?php 
require_once 'database.php';
require_once '..\Model\Entity\Transaction.php';
    class ModelTransaction {
        protected $db;
    
        public function __construct() {
            $this->db = new Database();
        }
        
        // Phương thức để lấy tất cả các giao dịch từ cơ sở dữ liệu
        public function getAllTransactions() {
            $query = "SELECT * FROM `transaction`";
            $result = $this->db->select($query);
            if ($result) {
                $transactions = [];
                while ($row = $result->fetch_assoc()) {
                    $transactions[] = $row;
                }
                return $transactions;
            } else {
                return false;
            }
        }
    
        // Phương thức để lấy thông tin của một giao dịch bằng ID
        public function getTransactionByID($transactionID) {
            $query = "SELECT * FROM `transaction` WHERE `transactionID` = '$transactionID'";
            $result = $this->db->select($query);
            if ($result) {
                return $result->fetch_assoc();
            } else {
                return false;
            }
        }
    
        // Phương thức để thêm một giao dịch mới vào cơ sở dữ liệu
        public function addTransaction($userID, $total, $note, $time, $address, $status) {
            $query = "INSERT INTO `transaction` (`userID`, `total`, `note`, `time`, `address`, 'status') 
                      VALUES ('$userID', '$total', '$note', '$time', '$address', '$status')";
            return $this->db->insert($query);
        }
    
        // Phương thức để cập nhật thông tin của một giao dịch trong cơ sở dữ liệu
        public function updateTransaction($transactionID, $userID, $total, $note, $time, $address,$status) {
            $query = "UPDATE `transaction` 
                      SET `userID` = '$userID', `total` = '$total', `note` = '$note', `time` = '$time', `address` = '$address', `status` = '$status' 
                      WHERE `transactionID` = '$transactionID'";
            return $this->db->update($query);
        }
    
        // Phương thức để xóa một giao dịch khỏi cơ sở dữ liệu
        public function deleteTransaction($transactionID) {
            $query = "DELETE FROM `transaction` WHERE `transactionID` = '$transactionID'";
            return $this->db->delete($query);
        }
        // Phương thức để thống kê doanh số từ cơ sở dữ liệu
    // Trong phương thức displayTotalSales của class ModelTransaction
// Trong phương thức displayTotalSales của class ModelTransaction
public function displayTotalSales($startDate, $endDate) {
    $query = "SELECT DATE(`time`) as date, SUM(`total`) as totalSales 
              FROM `transaction` 
              WHERE `time` BETWEEN '$startDate' AND '$endDate' 
              GROUP BY DATE(`time`)";
    $result = $this->db->select($query);
    if ($result && $result->num_rows > 0) {
        $salesData = array(
            'labels' => array(),
            'sales' => array()
        );
        while ($row = $result->fetch_assoc()) {
            $salesData['labels'][] = $row['date'];
            // Chuyển đổi dữ liệu doanh số từ chuỗi sang số
            $salesData['sales'][] = (float) $row['totalSales'];
        }
        return $salesData;
    } else {
        return false;
    }
}
// Phương thức để hiển thị chi tiết hóa đơn
public function displayTransactionDetails($transactionID) {
    $query = "SELECT * FROM `detail_transaction` WHERE `transactionID` = '$transactionID'";
    $result = $this->db->select($query);
    if ($result && $result->num_rows > 0) {
        $details = [];
        while ($row = $result->fetch_assoc()) {
            $details[] = $row;
        }
        return $details;
    } else {
        return false;
    }
}
public function updateTransactionStatus($transactionID, $newStatus) {
    $sql = "UPDATE `transaction` SET `status` = '$newStatus' WHERE `transactionID` = $transactionID";
    return $this->db->update($sql);
}

public function getTotalSales($startDate, $endDate) {
    $query = "SELECT DATE(`time`) as date, SUM(`total`) as totalSales 
              FROM `transaction` 
              WHERE `time` BETWEEN '$startDate' AND '$endDate' 
              GROUP BY DATE(`time`)";
    $result = $this->db->select($query);
    if ($result && $result->num_rows > 0) {
        $totalSalesData = array(
            'labels' => array(),
            'totalSales' => array()
        );
        while ($row = $result->fetch_assoc()) {
            $totalSalesData['labels'][] = $row['date'];
            $totalSalesData['totalSales'][] = (float) $row['totalSales'];
        }
        return $totalSalesData;
    } else {
        return false;
    }
}
public function getTotalSalesByBrand($startDate, $endDate) {
    $query = "SELECT b.name as brandName, SUM(dt.subtotal) as totalSales 
              FROM detail_transaction dt
              JOIN transaction t ON dt.transactionID = t.transactionID
              JOIN product p ON dt.productID = p.productID
              JOIN brand b ON p.brandID = b.brandID
              WHERE t.time BETWEEN '$startDate' AND '$endDate'
              GROUP BY b.name";
    $result = $this->db->select($query);
    if ($result && $result->num_rows > 0) {
        $totalSalesData = array(
            'labels' => array(),
            'totalSales' => array()
        );
        while ($row = $result->fetch_assoc()) {
            $totalSalesData['labels'][] = $row['brandName'];
            $totalSalesData['totalSales'][] = (float) $row['totalSales'];
        }
        return $totalSalesData;
    } else {
        return false;
    }
}

        }

        

    
    
    

?>
