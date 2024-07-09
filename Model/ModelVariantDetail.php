<?php

require_once 'database.php';
require_once(__DIR__ . '/Entity/VariantDetail.php');

class ModelVariantDetail {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    

    // Phương thức để lấy tất cả các biến thể từ cơ sở dữ liệu
    public function getAllVariantsDetail() {
        $query = "SELECT * FROM variantdetail WHERE status=1";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variant = new VariantDetail(
                    $row['productID'],
                    $row['color'],
                    $row['size'],
                    $row['speed'],
                    $row['grip'],
                    $row['weight'],
                    $row['quantity'],
                    $row['list_image'],
                    $row['status']
                );
                $variants[] = $variant;
            }
        }
        return $variants;
    }
    

    public function getListVariantsByID($variantID) {
        $query = "SELECT * FROM variantdetail WHERE variantID = '$variantID' and status=1";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variant = new VariantDetail(
                    $row['productID'],
                    $row['color'],
                    $row['size'],
                    $row['speed'],
                    $row['grip'],
                    $row['weight'],
                    $row['quantity'],
                    $row['list_image'],
                    $row['status']
                );
                $variants[] = $variant;
            }
        }
        return $variants;
    }

    
    // Phương thức để lấy một biến thể theo ID
    public function getVariantByID($variantID) {
        $query = "SELECT * FROM variantdetail WHERE variantID = '$variantID'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
            $variant = new VariantDetail(
                $row['variantID'],
                $row['color'],
                $row['size'],
                $row['speed'],
                $row['grip'],
                $row['weight'],
                $row['quantity'],
                $row['list_image'],
                $row['status']
            );
            return $variant;
        } else {
            return null;
        }
    }

    public function getVariantQuantityByColor($listVariant,$color) {
        $quantity=0;
        foreach($listVariant as $variant):
            if($variant->getColor()==$color):
                $quantity+=$variant->getQuantity();
            endif;
        endforeach;
        return $quantity;
    }

    // Phương thức để thêm một biến thể vào cơ sở dữ liệu
    public function addVariant($variant) {
        $variantID = $variant->getVariantID();
        $color = $variant->getColor();
        $size = $variant->getSize();
        $speed = $variant->getSpeed();
        $grip = $variant->getGrip();
        $weight = $variant->getWeight();
        $quantity = $variant->getQuantity();
        $listImage = $variant->getListImage();
        $status = $variant->getStatus();

        $query = "INSERT INTO variantdetail (variantID, color, size, speed, grip, weight, quantity, list_image, status) 
                  VALUES ('$variantID', '$color', '$size', '$speed', '$grip', '$weight', '$quantity', '$listImage', '$status')";
        return $this->db->insert($query);
    }

    

    public function getListShoesSize() {
        $query = "SELECT DISTINCT vd.size 
              FROM variantdetail vd 
              INNER JOIN variant v ON vd.variantID = v.variantID 
              INNER JOIN product p ON v.productID = p.productID 
              WHERE vd.size IS NOT NULL AND vd.size != 0 AND p.catalogID=4 AND vd.status != 0;";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variants[] = $row['size'];
            }
        }
        return $variants;
    }

    public function getListWeight() {
        $query = "SELECT DISTINCT(weight) FROM variantdetail WHERE weight IS NOT NULL";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variants[] = $row['weight'];
            }
        }
        return $variants;
    }

    public function getListGrip() {
        $query = "SELECT DISTINCT(grip) FROM variantdetail WHERE grip IS NOT NULL AND grip != ''";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variants[] = $row['grip'];
            }
        }
        return $variants;
    }

    public function getListStringColor() {
        $query = "SELECT DISTINCT(color)
        FROM product p, variantdetail vd, variant v
        WHERE p.productID=v.productID AND vd.variantID=v.variantID and p.catalogID=2";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variants[] = $row['color'];
            }
        }
        return $variants;
    }

    public function getListShuttleSpeed() {
        $query = "SELECT DISTINCT(speed) FROM variantdetail WHERE speed IS NOT NULL AND STATUS =0;";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variants[] = $row['speed'];
            }
        }
        return $variants;
    }
    
    // Phương thức để cập nhật thông tin biến thể trong cơ sở dữ liệu
    public function updateVariant($variant) {
        $variantID = $variant->getVariantID();
        $color = $variant->getColor();
        $size = $variant->getSize();
        $speed = $variant->getSpeed();
        $grip = $variant->getGrip();
        $weight = $variant->getWeight();
        $quantity = $variant->getQuantity();
        $listImage = $variant->getListImage();
        $status = $variant->getStatus();

        $query = "UPDATE variantdetail 
                  SET color = '$color', 
                      size = '$size', 
                      speed = '$speed', 
                      grip = '$grip', 
                      weight = '$weight', 
                      quantity = '$quantity', 
                      list_image = '$listImage', 
                      status = '$status' 
                  WHERE variantID = '$variantID'";
        return $this->db->update($query);
    }

    public function updateGrip($variantID, $grip) {

        $query = "UPDATE variantdetail 
                  SET grip = '$grip'
                  WHERE variantID = '$variantID'";
        return $this->db->update($query);
    }
    
    public function updateWeight($variantID, $weight) {

        $query = "UPDATE variantdetail 
                  SET weight = '$weight'
                  WHERE variantID = '$variantID'";
        return $this->db->update($query);
    }

    public function updateSize($variantID, $size) {

        $query = "UPDATE variantdetail 
                  SET size = '$size' 
                  WHERE variantID = '$variantID'";
        return $this->db->update($query);
    }

    public function updateSpeed($variantID, $speed) {

        $query = "UPDATE variantdetail 
                  SET speed = '$speed'
                  WHERE variantID = '$variantID'";
        return $this->db->update($query);
    }

    public function updateQuantity($variantID, $quantity) {

        $query = "UPDATE variantdetail 
                  SET quantity = '$quantity' 
                  WHERE variantID = '$variantID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một biến thể khỏi cơ sở dữ liệu
    public function deleteVariant($variantID) {
        $query = "UPDATE variantdetail SET status = 0 WHERE variantID = '$variantID'";
        return $this->db->delete($query);
    }
}

?>
