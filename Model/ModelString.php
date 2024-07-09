<?php

require_once 'database.php';
require_once '..\Model\Entity\String.php';

class ModelString {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các string từ cơ sở dữ liệu
    public function getAllStrings() {
        $query = "SELECT * FROM `string` WHERE status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $strings = [];
            while ($row = $result->fetch_assoc()) {
                $string = new StringProduct($row['productID'], $row['color'], $row['price'], $row['discount'], $row['status'], $row['quantity'], $row['country'], $row['note'], $row['list_image']);
                $strings[] = $string;
            }
            return $strings;
        } else {
            return false;
        }
    }

    public function getListStringByID($productID) {
        $query = "SELECT * FROM string WHERE productID='$productID' AND status != 0";
        $result = $this->db->select($query);
        $strings = []; // Đổi tên biến từ $string thành $strings để tránh sự nhầm lẫn
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng StringProduct từ dữ liệu trong hàng kết quả
                $string = new StringProduct(
                    $row['productID'],
                    $row['color'],
                    $row['price'],
                    $row['discount'],
                    $row['status'],
                    $row['quantity'],
                    $row['country'],
                    $row['note'],
                    $row['list_image']
                );
                $strings[] = $string; // Thêm đối tượng StringProduct vào mảng $strings
            }
        }
        return $strings; // Trả về mảng chứa các đối tượng StringProduct
    }
    

    public function getStringByIDAndColor($productID,$color) {
        $query = "SELECT * FROM string WHERE productID = '$productID' AND color='$color' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            // Tạo đối tượng Racket từ dữ liệu trong hàng kết quả
            $string = new StringProduct(
                $row['productID'],
                $row['color'],
                $row['price'],
                $row['discount'],
                $row['status'],
                $row['quantity'],
                $row['country'],
                $row['note'],
                $row['list_image']
            );
            return $string;
        } else {
            return null;
        }
    }

    // Phương thức để lấy thông tin một string bằng ID
    public function getStringByID($productID) {
        $query = "SELECT * FROM `string` WHERE `productID` = '$productID' AND status != 0";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $string = new StringProduct($row['productID'], $row['color'], $row['price'], $row['discount'], $row['status'], $row['quantity'], $row['country'], $row['note'], $row['list_image']);
            return $string;
        } else {
            return false;
        }
    }

    // Phương thức để thêm một string mới vào cơ sở dữ liệu
    public function addString($color, $price, $discount, $status, $quantity, $country, $note, $list_image) {
        $query = "INSERT INTO `string` (`color`, `price`, `discount`, `status`, `quantity`, `country`, `note`, `list_image`) 
                  VALUES ('$color', '$price', '$discount', '$status', '$quantity', '$country', '$note', '$list_image')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin của một string trong cơ sở dữ liệu
    public function updateString($productID, $color, $price, $discount, $status, $quantity, $country, $note, $list_image) {
        $query = "UPDATE `string` 
                  SET `color` = '$color', `price` = '$price', `discount` = '$discount', `status` = '$status', 
                      `quantity` = '$quantity', `country` = '$country', `note` = '$note', `list_image` = '$list_image' 
                  WHERE `productID` = '$productID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một string khỏi cơ sở dữ liệu
    public function deleteString($productID) {
        $query = "UPDATE FROM `string` SET status=0 WHERE `productID` = '$productID'";
        return $this->db->delete($query);
    }

    // Phương thức để tìm kiếm string theo màu sắc
    public function searchStringsByColor($color) {
        $query = "SELECT * FROM `string` WHERE `color` = '$color'";
        $result = $this->db->select($query);
        if ($result) {
            $strings = [];
            while ($row = $result->fetch_assoc()) {
                $string = new StringProduct($row['productID'], $row['color'], $row['price'], $row['discount'], $row['status'], $row['quantity'], $row['country'], $row['note'], $row['list_image']);
                $strings[] = $string;
            }
            return $strings;
        } else {
            return false;
        }
    }

    // Phương thức để tìm kiếm string theo giá
    public function searchStringsByPriceRange($minPrice, $maxPrice) {
        $query = "SELECT * FROM `string` WHERE `price` >= '$minPrice' AND `price` <= '$maxPrice'";
        $result = $this->db->select($query);
        if ($result) {
            $strings = [];
            while ($row = $result->fetch_assoc()) {
                $string = new StringProduct($row['productID'], $row['color'], $row['price'], $row['discount'], $row['status'], $row['quantity'], $row['country'], $row['note'], $row['list_image']);
                $strings[] = $string;
            }
            return $strings;
        } else {
            return false;
        }
    }
}

?>
