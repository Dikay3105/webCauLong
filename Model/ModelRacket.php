<?php

require_once 'database.php';
require_once(__DIR__ . '/Entity/Racket.php');
class ModelRacket {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các vợt từ cơ sở dữ liệu
    public function getAllRackets() {
        $query = "SELECT * FROM racket WHERE status != 0";
        $result = $this->db->select($query);
        $rackets = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Racket từ dữ liệu trong hàng kết quả
                $racket = new Racket(
                    $row['productID'],
                    $row['color'],
                    $row['price'],
                    $row['discount'],
                    $row['flex'],
                    $row['tension_max'],
                    $row['grip'],
                    $row['frame_build'],
                    $row['shaft_build'],
                    $row['weight'],
                    $row['status'],
                    $row['quantity'],
                    $row['swing_weight'],
                    $row['balance_point'],
                    $row['note'],
                    $row['list_image']
                );
                $rackets[] = $racket;
            }
        }
        return $rackets;
    }

    public function getListRacketByID($productID) {
        $query = "SELECT * FROM racket WHERE productID='$productID' AND status != 0";
        $result = $this->db->select($query);
        $rackets = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Racket từ dữ liệu trong hàng kết quả
                $racket = new Racket(
                    $row['productID'],
                    $row['color'],
                    $row['price'],
                    $row['discount'],
                    $row['flex'],
                    $row['tension_max'],
                    $row['grip'],
                    $row['frame_build'],
                    $row['shaft_build'],
                    $row['weight'],
                    $row['status'],
                    $row['quantity'],
                    $row['swing_weight'],
                    $row['balance_point'],
                    $row['note'],
                    $row['list_image']
                );
                $rackets[] = $racket;
            }
        }
        return $rackets;
    }

    // Phương thức để lấy một vợt theo ID
    public function getRacketByID($productID) {
        $query = "SELECT * FROM racket WHERE productID = '$productID' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            // Tạo đối tượng Racket từ dữ liệu trong hàng kết quả
            $racket = new Racket(
                $row['productID'],
                $row['color'],
                $row['price'],
                $row['discount'],
                $row['flex'],
                $row['tension_max'],
                $row['grip'],
                $row['frame_build'],
                $row['shaft_build'],
                $row['weight'],
                $row['status'],
                $row['quantity'],
                $row['swing_weight'],
                $row['balance_point'],
                $row['note'],
                $row['list_image']
            );
            return $racket;
        } else {
            return null;
        }
    }

    // Phương thức để lấy một vợt theo ID và màu
    public function getRacketByIDAndColor($productID,$color) {
        $query = "SELECT * FROM racket WHERE productID = '$productID' AND color='$color' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            // Tạo đối tượng Racket từ dữ liệu trong hàng kết quả
            $racket = new Racket(
                $row['productID'],
                $row['color'],
                $row['price'],
                $row['discount'],
                $row['flex'],
                $row['tension_max'],
                $row['grip'],
                $row['frame_build'],
                $row['shaft_build'],
                $row['weight'],
                $row['status'],
                $row['quantity'],
                $row['swing_weight'],
                $row['balance_point'],
                $row['note'],
                $row['list_image']
            );
            return $racket;
        } else {
            return null;
        }
    }

    // Phương thức để tìm kiếm vợt theo màu sắc
public function searchRacketsByColor($color) {
    $query = "SELECT * FROM racket WHERE color = '$color'";
    $result = $this->db->select($query);
    $rackets = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            // Tạo đối tượng Racket từ dữ liệu trong hàng kết quả
            $racket = new Racket(
                $row['productID'],
                $row['color'],
                $row['price'],
                $row['discount'],
                $row['flex'],
                $row['tension_max'],
                $row['grip'],
                $row['frame_build'],
                $row['shaft_build'],
                $row['weight'],
                $row['status'],
                $row['quantity'],
                $row['swing_weight'],
                $row['balance_point'],
                $row['note'],
                $row['list_image']
            );
            $rackets[] = $racket;
        }
    }
    return $rackets;
}


    // Phương thức để thêm một vợt vào cơ sở dữ liệu
    public function addRacket($racket) {
        $productID = $racket->getProductID();
        $color = $racket->getColor();
        $price = $racket->getPrice();
        $discount = $racket->getDiscount();
        $flex = $racket->getFlex();
        $tensionMax = $racket->getTensionMax();
        $grip = $racket->getGrip();
        $frameBuild = $racket->getFrameBuild();
        $shaftBuild = $racket->getShaftBuild();
        $weight = $racket->getWeight();
        $status = $racket->getStatus();
        $quantity = $racket->getQuantity();
        $swingWeight = $racket->getSwingWeight();
        $balancePoint = $racket->getBalancePoint();
        $note = $racket->getNote();
        $listImage = $racket->getListImage();

        $query = "INSERT INTO racket (productID, color, price, discount, flex, tension_max, grip, frame_build, shaft_build, weight, status, quantity, swing_weight, balance_point, note, list_image) 
                  VALUES ('$productID', '$color', '$price', '$discount', '$flex', '$tensionMax', '$grip', '$frameBuild', '$shaftBuild', '$weight', '$status', '$quantity', '$swingWeight', '$balancePoint', '$note', '$listImage')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin vợt trong cơ sở dữ liệu
    public function updateRacket($racket) {
        $productID = $racket->getProductID();
        $color = $racket->getColor();
        $price = $racket->getPrice();
        $discount = $racket->getDiscount();
        $flex = $racket->getFlex();
        $tensionMax = $racket->getTensionMax();
        $grip = $racket->getGrip();
        $frameBuild = $racket->getFrameBuild();
        $shaftBuild = $racket->getShaftBuild();
        $weight = $racket->getWeight();
        $status = $racket->getStatus();
        $quantity = $racket->getQuantity();
        $swingWeight = $racket->getSwingWeight();
        $balancePoint = $racket->getBalancePoint();
        $note = $racket->getNote();
        $listImage = $racket->getListImage();

        $query = "UPDATE racket 
                  SET color = '$color', 
                      price = '$price', 
                      discount = '$discount', 
                      flex = '$flex', 
                      tension_max = '$tensionMax', 
                      grip = '$grip', 
                      frame_build = '$frameBuild', 
                      shaft_build = '$shaftBuild', 
                      weight = '$weight', 
                      status = '$status', 
                      quantity = '$quantity', 
                      swing_weight = '$swingWeight', 
                      balance_point = '$balancePoint', 
                      note = '$note', 
                      list_image = '$listImage' 
                  WHERE productID = '$productID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một vợt khỏi cơ sở dữ liệu
    public function deleteRacket($productID) {
        $query = "UPDATE FROM racket SET status=0 WHERE productID = '$productID'";
        return $this->db->delete($query);
    }



}

?>
