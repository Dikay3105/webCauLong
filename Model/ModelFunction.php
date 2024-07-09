<?php

require_once 'database.php';
require_once '..\Model\Entity\function_user.php';

class ModelFunction {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các chức năng từ cơ sở dữ liệu
    public function getAllFunctions() {
        $query = "SELECT * FROM `function`";
        $result = $this->db->select($query);
        if ($result) {
            $functions = [];
            while ($row = $result->fetch_assoc()) {
                $functions[] = $row;
            }
            return $functions;
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin chức năng bằng ID
    public function getFunctionByID($functionID) {
        $query = "SELECT * FROM `function` WHERE functionID = '$functionID'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để thêm một chức năng mới vào cơ sở dữ liệu
    public function addFunction($functionName) {
        $query = "INSERT INTO `function` (functionName) VALUES ('$functionName')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin chức năng trong cơ sở dữ liệu
    public function updateFunction($functionID, $functionName) {
        $query = "UPDATE `function` SET functionName = '$functionName' WHERE functionID = '$functionID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một chức năng khỏi cơ sở dữ liệu
    public function deleteFunction($functionID) {
        $query = "DELETE FROM `function` WHERE functionID = '$functionID'";
        return $this->db->delete($query);
    }
}

?>
