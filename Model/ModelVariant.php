<?php

require_once 'database.php'; // Đảm bảo rằng bạn đã có file database.php chứa lớp Database
require_once(__DIR__ . '/Entity/Variant.php');

class ModelVariant {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các biến thể từ cơ sở dữ liệu
    public function getAllVariants() {
        $query = "SELECT * FROM variant";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variant = new Variant(
                    $row['productID'],
                    $row['variantID']
                );
                $variants[] = $variant;
            }
        }
        return $variants;
    }

    public function getListVariantByProductID($productID) {
        $query = "SELECT * FROM variant WHERE productID = '$productID' and status=1";
        $result = $this->db->select($query);
        $variants = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Variant từ dữ liệu trong hàng kết quả
                $variant = new Variant(
                    $row['variantID'],
                    $row['productID']
                );
                $variants[] = $variant;
            }
        }
        return $variants;
    }
    

    // Phương thức để thêm một biến thể vào cơ sở dữ liệu
    public function addVariant($variant) {
        $productID = $variant->getProductID();
        $variantID = $variant->getVariantID();

        $query = "INSERT INTO variant (productID, variantID) 
                  VALUES ('$productID', '$variantID')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin biến thể trong cơ sở dữ liệu
    public function updateVariant($variant) {
        $productID = $variant->getProductID();
        $variantID = $variant->getVariantID();

        $query = "UPDATE variant 
                  SET productID = '$productID'
                  WHERE variantID = '$variantID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một biến thể khỏi cơ sở dữ liệu
    public function deleteVariant($variantID) {
        $query = "DELETE FROM variant WHERE variantID = '$variantID'";
        return $this->db->delete($query);
    }
}

?>
