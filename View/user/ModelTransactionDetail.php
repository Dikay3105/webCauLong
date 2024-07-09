<?php
require_once 'database.php';
require_once '../Model/Entity/DetailTransaction.php';
class ModelTransactionDetail {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Method to get all transaction details
    public function getAllTransactionDetails() {
        $query = "SELECT * FROM `transaction_detail`";
        return $this->db->select($query);
    }

    // Method to get a single transaction detail by detailID
    public function getTransactionDetailById($detailID) {
        $query = "SELECT * FROM `transaction_detail` WHERE `detailID` = '$detailID'";
        return $this->db->select($query);
    }

    // Method to add a new transaction detail
    public function addTransactionDetail($transactionID, $productID, $quantity, $price) {
        $subtotal = $quantity * $price;
        $query = "INSERT INTO `transaction_detail` (`transactionID`, `productID`, `quantity`, `price`, `subtotal`) 
                  VALUES ('$transactionID', '$productID', '$quantity', '$price', '$subtotal')";
        return $this->db->insert($query);
    }

    // Method to update a transaction detail
    public function updateTransactionDetail($detailID, $transactionID, $productID, $quantity, $price) {
        $subtotal = $quantity * $price;
        $query = "UPDATE `transaction_detail` 
                  SET `transactionID` = '$transactionID', `productID` = '$productID', `quantity` = '$quantity', `price` = '$price', `subtotal` = '$subtotal' 
                  WHERE `detailID` = '$detailID'";
        return $this->db->update($query);
    }

    // Method to delete a transaction detail
    public function deleteTransactionDetail($detailID) {
        $query = "DELETE FROM `transaction_detail` WHERE `detailID` = '$detailID'";
        return $this->db->delete($query);
    }
}
?>
