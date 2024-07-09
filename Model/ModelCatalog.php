<?php
require_once 'database.php';
require_once(__DIR__ . '/Entity/Catalog.php');
class ModelCatalog {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các danh mục từ cơ sở dữ liệu
    public function getAllCatalogs() {
        $query = "SELECT * FROM catalog";
        $result = $this->db->select($query);
        if ($result) {
            $catalogs = [];
            while ($row = $result->fetch_assoc()) {
                $catalog = new Catalog($row['catalogID'], $row['name'], $row['parentID']);
                $catalogs[] = $catalog;
            }
            return $catalogs;
        } else {
            return false;
        }
    }
    

    // Phương thức để lấy thông tin danh mục bằng ID
    public function getCatalogByID($catalogID) {
        $query = "SELECT * FROM catalog WHERE catalogID = '$catalogID'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return new Catalog($row['catalogID'], $row['name'], $row['parentID']);
        } else {
            return false;
        }
    }

    // Phương thức để thêm một danh mục mới vào cơ sở dữ liệu
    public function addCatalog($name, $parentID) {
        $query = "INSERT INTO catalog (name, parentID) VALUES ('$name', '$parentID')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin danh mục trong cơ sở dữ liệu
    public function updateCatalog($catalogID, $name, $parentID) {
        $query = "UPDATE catalog SET name = '$name', parentID = '$parentID' WHERE catalogID = '$catalogID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một danh mục khỏi cơ sở dữ liệu
    public function deleteCatalog($catalogID) {
        $query = "DELETE FROM catalog WHERE catalogID = '$catalogID'";
        return $this->db->delete($query);
    }
}

?>
