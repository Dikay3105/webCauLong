<?php
require_once 'database.php';
require_once '..\Model\Entity\OrderTransaction.php';
class ModelOrderTransaction {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
/* 
    // Phương thức để lấy tất cả các giao dịch đơn hàng từ cơ sở dữ liệu
    public function getAllOrderTransactions() {
        try {
            $query = "SELECT * FROM ordertransaction";
            $result = $this->db->select($query);
            $arrAllOrderTransactions = array();
            while($row = mysqli_fetch_assoc($result)) {
                $arrAllOrderTransactions = $row;
            }
            return $arrAllOrderTransactions;
        } catch (Exception $e) {
            echo 'Error:'. $e->getMessage();
            return null;
        }
    }*/

    // Phương thức để lấy thông tin giao dịch đơn hàng bằng ID đơn hàng
    public function getOrderTransactionByOrderID($orderID) {
        try{
            $query = "SELECT cthd.*, pro.name , pro.price, pro.description, pro.url_image, var.color FROM ordertransaction cthd
            JOIN product pro ON cthd.productID = pro.productID
            JOIN variantdetail var ON cthd.variantID = var.variantID
            WHERE cthd.transactionID = '$orderID'
            ";

            $result = $this->db->select($query);
            $arr = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $arr[] = $row;
            }
            return $arr;
        } catch (Exception $e) {
            echo 'Error:'. $e->getMessage();
            return null;
        }
    } 
// Phương thức để lấy tất cả các giao dịch đơn hàng từ cơ sở dữ liệu
public function getAllOrderTransactions() {
    $query = "SELECT * FROM `ordertransaction` WHERE status != 0";
    $result = $this->db->select($query);
    if ($result) {
        $orderTransactions = [];
        while ($row = $result->fetch_assoc()) {
            $orderTransactions[] = $row;
        }
        return $orderTransactions;
    } else {
        return false;
    }
}

// Phương thức để lấy thông tin giao dịch đơn hàng bằng ID đơn hàng
// public function getOrderTransactionByOrderID($orderID) {
//     $query = "SELECT * FROM `ordertransaction` WHERE orderID = '$orderID' AND status != 0";
//     $result = $this->db->select($query);
//     if ($result) {
//         return $result->fetch_assoc();
//     } else {
//         return false;
//     }
// }

    public function checkOrderDetail($id) {
        try {
            $query = "SELECT IF(EXISTS (
                SELECT 1
                FROM ordertransaction
                WHERE transactionID = '$id'
            ), 1, 0) AS hasDetails";
            $result = $this->db->select($query);
            if ($row = mysqli_fetch_assoc($result)) {
                return (int)$row['hasDetails'];
            }
            return ['hasDetails' => 0];
        } catch (Exception $e) {
            echo 'Error:'. $e->getMessage();
            return null;
        }
    }

    // Phương thức để thêm một giao dịch đơn hàng mới vào cơ sở dữ liệu
    public function addOrderTransaction($productID, $variantID, $total_amonut, $quantity) {
        $sql = "SELECT MAX(transactionID) AS id FROM transaction";
        $result = $this->db->select($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $transaction_id = $row['id'];

            $insert_sql =  "INSERT INTO `ordertransaction`(`transactionID`, `productID`, `variantID`, `total_amonut`, `quantity`) 
                            VALUES ('$transaction_id','$productID','$variantID','$total_amonut','$quantity')";
            $this->db->select($insert_sql);

            $update_quantity = "UPDATE variantdetail var 
                                JOIN ordertransaction orr ON var.variantID = orr.variantID
                                SET var.quantity = (var.quantity - orr.quantity) 
                                WHERE orr.variantID = '$variantID' AND orr.transactionID = '$transaction_id'";
            $tmdt = $this->db->select($update_quantity);
            if($tmdt === false){
                echo 'Error:';
            }
        }
    }

    // Phương thức để cập nhật thông tin giao dịch đơn hàng trong cơ sở dữ liệu
    public function updateOrderTransaction($orderID, $transactionID, $productID, $total, $note, $status) {
        $query = "UPDATE `ordertransaction` 
                  SET transactionID = '$transactionID', productID = '$productID', total = '$total', 
                      note = '$note', status = '$status' 
                  WHERE orderID = '$orderID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một giao dịch đơn hàng khỏi cơ sở dữ liệu
    public function deleteOrderTransaction($orderID) {
        $query = "UPDATE FROM `ordertransaction` SET status= 0 WHERE orderID = '$orderID'";
        return $this->db->delete($query);
    }
    public function getOrderTransactionDetails($orderID) {
        $query = "SELECT od.productID, p.name as productName, p.price as productPrice, od.quantity, od.total_amonut 
                  FROM ordertransaction od 
                  JOIN product p ON od.productID = p.productID 
                  WHERE od.transactionID = '$orderID'";
        $result = $this->db->select($query);
        if ($result) {
            $details = [];
            while ($row = $result->fetch_assoc()) {
                $details[] = $row;
            }
            return $details;
        } else {
            return false;
        }
    }
}

?>
