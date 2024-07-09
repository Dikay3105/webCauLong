<?php

require_once 'database.php';
require_once '..\Model\Entity\Shuttle.php';

class ModelShuttle {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các shuttle từ cơ sở dữ liệu
    public function getAllShuttles() {
        $query = "SELECT * FROM shuttle WHERE status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $shuttles = [];
            while ($row = $result->fetch_assoc()) {
                $shuttles[] = $row;
            }
            return $shuttles;
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin shuttle bằng ID
    public function getShuttleByID($productID) {
        $query = "SELECT * FROM shuttle WHERE productID = '$productID' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để thêm một shuttle mới vào cơ sở dữ liệu
    public function addShuttle($speed, $price, $discount, $quantity, $type, $detail, $note, $status, $list_image) {
        $query = "INSERT INTO shuttle (speed, price, discount, quantity, type, detail, note, status, list_image) 
                  VALUES ('$speed', '$price', '$discount', '$quantity', '$type', '$detail', '$note', '$status', '$list_image')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin shuttle trong cơ sở dữ liệu
    public function updateShuttle($productID, $speed, $price, $discount, $quantity, $type, $detail, $note, $status, $list_image) {
        $query = "UPDATE shuttle 
                  SET speed = '$speed', price = '$price', discount = '$discount', 
                      quantity = '$quantity', type = '$type', detail = '$detail', 
                      note = '$note', status = '$status', list_image = '$list_image' 
                  WHERE productID = '$productID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một shuttle khỏi cơ sở dữ liệu
    public function deleteShuttle($productID) {
        $query = "UPDATE FROM shuttle SET status =0 WHERE productID = '$productID'";
        return $this->db->delete($query);
    }

    // Phương thức để tìm kiếm shuttle theo giá
    public function searchShuttlesByPrice($minPrice, $maxPrice) {
        $query = "SELECT * FROM shuttle WHERE price BETWEEN $minPrice AND $maxPrice";
        $result = $this->db->select($query);
        if ($result) {
            $shuttles = [];
            while ($row = $result->fetch_assoc()) {
                $shuttles[] = $row;
            }
            return $shuttles;
        } else {
            return false;
        }
    }
}

?>
