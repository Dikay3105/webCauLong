<?php

require_once 'database.php';
require_once '..\Model\Entity\Cart.php';
class ModelCart {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các giỏ hàng từ cơ sở dữ liệu
    public function getAllCarts() {
        $query = "SELECT * FROM cart";
        $result = $this->db->select($query);
        if ($result) {
            $carts = [];
            while ($row = $result->fetch_assoc()) {
                $carts[] = $row;
            }
            return $carts;
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin giỏ hàng bằng ID
    public function getCartByID($cartID) {
        $query = "SELECT * FROM cart WHERE cartID = '$cartID'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function addCart($userID, $timeCreated) {

    
        // Chèn bản ghi mới với cartID mới
        $query = "INSERT INTO cart (cartID, userID, timeCreated) 
                  VALUES ('$userID', '$userID', '$timeCreated')";
       return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin giỏ hàng trong cơ sở dữ liệu
    public function updateCart($cartID, $userID, $timeCreated) {
        $query = "UPDATE cart 
                  SET userID = '$userID', 
                      timeCreated = '$timeCreated' 
                  WHERE cartID = '$cartID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một giỏ hàng khỏi cơ sở dữ liệu
    public function deleteCart($cartID) {
        $query = "DELETE FROM cart WHERE cartID = '$cartID'";
        return $this->db->delete($query);
    }
}

?>
