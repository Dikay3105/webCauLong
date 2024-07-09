<?php 
require_once 'database.php';
require_once '..\Model\Entity\Transaction.php';
    class ModelTransaction {
        protected $db;
    
        public function __construct() {
            $this->db = new Database();
        }
        
/*         // Phương thức để lấy tất cả các giao dịch từ cơ sở dữ liệu
        public function getAllTransactions() {
            try {
                $query = "SELECT * FROM transaction";
                $result = $this->db->select($query);
                $arrHoaDon = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $arrHoaDon[] = $row;
                }
                return $arrHoaDon;
            } catch (Exception $e) {
                echo 'Error:'. $e->getMessage();
                return null;
            }
        } */
        // Method to get all transactions from the database
        public function getAllTransactions() {
            $query = "SELECT * FROM `transaction`";
            $result = $this->db->select($query);
            if ($result) {
                $transactions = [];
                while ($row = $result->fetch_assoc()) {
                    $transactions[] = new Transaction(
                        $row['transactionID'],
                        $row['userID'],
                        $row['total'],
                        $row['note'],
                        $row['time'],
                        $row['address'],
                        $row['check'],
                        $row['transport'],
                        $row['status'],
                        $row['name_receiver'],
                        $row['phone_receiver']
                    );
                }
                return $transactions;
            } else {
                return false;
            }
        }
    
/*         // Phương thức để lấy thông tin của một giao dịch bằng ID
        public function getTransactionByID($TransactionID) {
            ///$query = "SELECT * FROM transaction WHERE transaction.transactionID = '$transactionID'";
            $query = "SELECT * FROM transaction JOIN ordertransaction ON transaction.transactionID = ordertransaction.transactionID 
                        WHERE ordertransaction.transactionID = '$TransactionID'";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                // Initialize an array to store transactions
                $transactions = array();
                
                // Loop through the result set and fetch each row
                while ($row = $result->fetch_assoc()) {
                    // Add each transaction to the transactions array
                    $transactions[] = $row;
                }
                
                // Return the array of transactions
                return $transactions;
            } else {
                // Return false if no transactions found
                return false;
            }
        } */
        // Method to get a transaction by ID
    // Method to get a transaction by ID
    public function getTransactionByID($transactionID) {
        $query = "SELECT * FROM `transaction` WHERE `transactionID` = '$transactionID'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return new Transaction(
                $row['transactionID'],
                $row['userID'],
                $row['total'],
                $row['note'],
                $row['time'],
                $row['address'],
                $row['check'],
                $row['transport'],
                $row['status'],
                $row['name_receiver'],
                $row['phone_receiver']
            );
        } else {
            return false;
        }
    }
        public function getTransaction($id) {
            try {
                $query = "SELECT * FROM transaction WHERE transactionID = '$id'";
                $result = $this->db->select($query);
                if ($row = mysqli_fetch_assoc($result)) {
                    return $row;
                }
                return null;
            } catch (Exception $e) {
                echo 'Error:'. $e->getMessage();
                return null;
            }
        }

        public function getTransactionByCustomer($ma_kh, $search) {
            try {
                $query = "SELECT *, DATE_FORMAT(time, '%d/%m/%Y') AS FormatDate FROM transaction
                          WHERE userID = '$ma_kh' 
                          AND transactionID = '$search'
                          AND status = 1
                          ORDER BY transactionID DESC";
                $result = $this->db->select($query);
        
                if ($result === false) {
                    // Log the error message
                    error_log("SQL Error: " . $this->db->error);
                    return null;
                }
        
                $arrHoaDon = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $arrHoaDon[] = $row;
                }
                return $arrHoaDon;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
                return null;
            }
        }
        
        
        public function getAllTransactionByCustomer($ma_kh) {
            try {
                $query = "SELECT *, DATE_FORMAT(time, '%d/%m/%Y') AS FormatDate FROM transaction
                          WHERE userID = '$ma_kh'
                          AND status = 1 
                          ORDER BY transactionID DESC";
                $result = $this->db->select($query);
        
                if ($result === false) {
                    // Log the error message
                    error_log("SQL Error in getAllTransactionByCustomer: " . $this->db->error);
                    // Optionally, you can also echo the error message for debugging
                    echo "SQL Error: " . $this->db->error;
                    return null;
                }
        
                $arrHoaDon = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $arrHoaDon[] = $row;
                }
                return $arrHoaDon;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
                return null;
            }
        }
        

        public function getTransactionByPhone($phoneNumber) {
            //$Phonenumber = $this->db->escape_string($Phonenumber);
            $query = "SELECT *, DATE_FORMAT(time, '%d/%m/%Y') AS FormatDate FROM transaction WHERE transaction.userID in 
            (SELECT user.userID FROM user WHERE phoneNumber = '$phoneNumber')
            ORDER BY transactionID DESC";
            $result = $this->db->select($query);
            if ($result && $result->num_rows > 0) {
                // Initialize an array to store transactions
                $transactions = array();
                
                // Loop through the result set and fetch each row
                while ($row = $result->fetch_assoc()) {
                    // Add each transaction to the transactions array
                    $transactions[] = $row;
                }
                
                // Return the array of transactions
                return $transactions;
            } else {
                // Return false if no transactions found
                return false;
            }
        }

        public function deleteHoaDon($status,$ma_hd) {
            try {
                $query = "UPDATE transaction SET status = $status WHERE transactionID = '$ma_hd'";
                $result = $this->db->select($query);
                return $result;
            } catch (Exception $e) {
                echo 'Error:'. $e->getMessage();
                return false;
            }
        }

        public function getAllDeleteHoaDon() {
            try {
                $query = "SELECT *, DATE_FORMAT(time, '%d/%m/%Y') AS FormatDate FROM transaction WHERE status = 0";
                $result = $this->db->select($query);
                $arrHoaDon = array();
                while($row = mysqli_fetch_assoc($result)) {
                    $arrHoaDon[] = $row;
                }
                return $arrHoaDon;
            } catch (Exception $e) {
                echo 'Error:'. $e->getMessage();
                return null;
            }
        }
        // Phương thức để thêm một giao dịch mới vào cơ sở dữ liệu
        public function addTransaction($userID, $total, $note,$time, $address, $name_receiver, $phone_receiver) {
            $query = "INSERT INTO `transaction` (`userID`, `total`, `note`,`time`, `address`, `check`, `transport`, `status` , `name_receiver`, `phone_receiver`) 
                      VALUES ('$userID', '$total', '$note','$time', '$address', 'Đã thanh toán', '', '1', '$name_receiver', '$phone_receiver')";
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
                $salesData['sales'][] = (float) $row['totalSales'];
            }
            return $salesData;
        } else {
            return false;
        }
    }

    // Method to display transaction details
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

    // Method to update the status of a transaction
    public function updateTransactionStatus($transactionID, $newStatus) {
        $query = "UPDATE `transaction` SET `transport` = '$newStatus' WHERE `transactionID` = '$transactionID'";
        return $this->db->update($query);
    }

    // Method to get total sales
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

    // Method to get total sales by brand
   
        public function getTotalSalesByBrand($startDate, $endDate) {
            $query = "SELECT p.brandID, b.name AS brandName, SUM(ot.total_amonut) AS totalSales FROM ordertransaction ot INNER JOIN product p ON ot.productID = p.productID INNER JOIN brand b ON p.brandID = b.brandID INNER JOIN transaction t ON ot.transactionID = t.transactionID WHERE t.time BETWEEN '$startDate' AND '$endDate' GROUP BY p.brandID, b.name;";
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
    // Method to get transactions by date
    public function getTransactionsByDate($startDate, $endDate) {
        $query = "SELECT * FROM `transaction` WHERE `time` BETWEEN '$startDate' AND '$endDate'";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $transactions = [];
            while ($row = $result->fetch_assoc()) {
                $transactions[] = new Transaction(
                    $row['transactionID'],
                    $row['userID'],
                    $row['total'],
                    $row['note'],
                    $row['time'],
                    $row['address'],
                    $row['check'],
                    $row['transport'],
                    $row['status'],
                    $row['name_receiver'],
                    $row['phone_receiver']
                );
            }
            return $transactions;
        } else {
            return false;
        }
    }
    
    
         
        
    public function getTransactionsByDateAndTransport($startDate, $endDate, $transport) {
        // Create the SQL query to fetch transactions based on date range and transport type
        $query = "SELECT * FROM `transaction` WHERE `time` BETWEEN '$startDate' AND '$endDate'";
        
        if (!empty($transport)) {
            $query .= " AND `transport` = '$transport'";
        }

        // Execute the query
        $result = $this->db->select($query);

        // Check if the query was successful
        if ($result && $result->num_rows > 0) {
            $transactions = [];
            while ($row = $result->fetch_assoc()) {
                $transactions[] = new Transaction(
                    $row['transactionID'],
                    $row['userID'],
                    $row['total'],
                    $row['note'],
                    $row['time'],
                    $row['address'],
                    $row['check'],
                    $row['transport'],
                    $row['status'],
                    $row['name_receiver'],
                    $row['phone_receiver']
                );
            }
            return $transactions;
        } else {
            return false;
        }
    }
    public function getBestSellingProducts($topNumber, $statType, $startDate, $endDate) {
        // Validate inputs
        $topNumber = (int)$topNumber;
        if (!in_array($statType, ['totalRevenue', 'numberOfBuyers', 'quantitySold'])) {
            throw new Exception("Invalid statistic type");
        }
    
        // Define the base query
        $query = "SELECT p.productID, p.name, ";
    
        // Modify the query based on the statType
        switch ($statType) {
            case 'totalRevenue':
                $query .= "SUM(ot.total_amonut) AS value ";
                break;
            case 'numberOfBuyers':
                $query .= "COUNT(DISTINCT t.userID) AS value ";
                break;
            case 'quantitySold':
                $query .= "SUM(ot.quantity) AS value ";
                break;
        }
    
        // Add condition for start date and end date
        $query .= "FROM ordertransaction ot
                   JOIN transaction t ON ot.transactionID = t.transactionID
                   JOIN product p ON ot.productID = p.productID
                   WHERE t.time BETWEEN '$startDate' AND '$endDate'
                   GROUP BY p.productID, p.name
                   ORDER BY value DESC
                   LIMIT $topNumber";
    
        // Execute the query
        $result = $this->db->select($query);
    
        // Fetch and return the results
        $bestSellingProducts = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bestSellingProducts[] = $row;
            }
        }
        return $bestSellingProducts;
    }
}
    

    

?>
