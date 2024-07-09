<?php

require_once 'database.php';
require_once '..\Model\Entity\Role.php';
class ModelRole {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các vai trò từ cơ sở dữ liệu
    public function getAllRoles() {
        $query = "SELECT * FROM role";
        $result = $this->db->select($query);
        if ($result) {
            $roles = [];
            while ($row = $result->fetch_assoc()) {
                $roles[] = $row;
            }
            return $roles;
        } else {
            return false;
        }
    }

    // Phương thức để lấy thông tin vai trò bằng ID
    public function getRoleByID($roleID) {
        $query = "SELECT * FROM role WHERE roleID = '$roleID'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Phương thức để thêm một vai trò mới vào cơ sở dữ liệu
    public function addRole($roleName) {
        $query = "INSERT INTO role (roleName) VALUES ('$roleName')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật thông tin vai trò trong cơ sở dữ liệu
    public function updateRole($roleID, $roleName) {
        $query = "UPDATE role SET roleName = '$roleName' WHERE roleID = '$roleID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một vai trò khỏi cơ sở dữ liệu
    public function deleteRole($roleID) {
        $query = "DELETE FROM role WHERE roleID = '$roleID'";
        return $this->db->delete($query);
    }
}

?>
