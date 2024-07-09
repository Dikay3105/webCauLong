<?php
require_once 'database.php';
require_once '..\Model\Entity\Permission.php';
class ModelPermission {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Phương thức để lấy tất cả các quyền từ cơ sở dữ liệu
    public function getAllPermissions() {
        $query = "SELECT * FROM `permission`";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $permissions = [];
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Permission từ dữ liệu và thêm vào mảng
                $permission = new Permission($row['roleID'], $row['functionID'], $row['permissionName']);
                $permissions[] = $permission;
            }
            return $permissions;
        } else {
            return []; // Trả về mảng rỗng nếu không có kết quả
        }
    }

    // Phương thức để lấy quyền của một vai trò dựa trên ID của vai trò
    public function getPermissionsByRoleID($roleID) {
        $query = "SELECT * FROM `permission` WHERE roleID = '$roleID'";
        $result = $this->db->select($query);
        if ($result) {
            $permissions = [];
            while ($row = $result->fetch_assoc()) {
                $permissions[] = $row;
            }
            return $permissions;
        } else {
            return false;
        }
    }

    // Phương thức để thêm một quyền mới vào cơ sở dữ liệu
    public function addPermission($roleID, $functionID, $permissionName) {
        $query = "INSERT INTO `permission` (roleID, functionID, permissionName) 
                  VALUES ('$roleID', '$functionID', '$permissionName')";
        return $this->db->insert($query);
    }

    // Phương thức để cập nhật quyền trong cơ sở dữ liệu
    public function updatePermission($roleID, $functionID, $permissionName) {
        $query = "UPDATE `permission` 
                  SET permissionName = '$permissionName' 
                  WHERE roleID = '$roleID' AND functionID = '$functionID'";
        return $this->db->update($query);
    }

    // Phương thức để xóa một quyền khỏi cơ sở dữ liệu
    public function deletePermission($roleID, $functionID) {
        $query = "DELETE FROM `permission` WHERE roleID = '$roleID' AND functionID = '$functionID'";
        return $this->db->delete($query);
    }
    public function getPermissionByroleIDandfunctionID($roleID, $functionID) {
        $query = "SELECT *
                  FROM permission 
                  WHERE roleID = '$roleID' AND functionID = '$functionID';";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $permissions = [];
            while ($row = $result->fetch_assoc()) {
                // Tạo đối tượng Permission từ dữ liệu và thêm vào mảng
                $permission = new Permission($row['roleID'], $row['functionID'], $row['permissionName']);
                $permissions[] = $permission;
            }
            return $permissions;
        } else {
            return []; // Trả về mảng rỗng nếu không có kết quả
        }
    }
    
}




?>
