<?php
require_once 'database.php';
require_once __DIR__ . '/Entity/User.php';
class ModelUser {
    protected $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function getAllUsers() {
        $query = "SELECT * FROM user WHERE status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } else {
            return false;
        }
    }
    public function getAllUsers2() {
        $query = "SELECT * FROM user";
        $result = $this->db->select($query);
        if ($result) {
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } else {
            return false;
        }
    }
    
    public function getUserByID($userID) {
        $query = "SELECT * FROM user WHERE userID = '$userID' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    public function getUserByID2($userID) {
        $query = "SELECT * FROM user WHERE userID = '$userID'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
    public function getUIDByUserName($username) {
        $query = "SELECT userID FROM user WHERE username = '$username' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['userID']; 
        } else {
            return false;
        }
    }
    public function getRoleUsetByID($userID) {
        $query = "SELECT roleID FROM user WHERE userID = '$userID' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['roleID']; 
        } else {
            return false;
        }
    }
    

    

    public function addUser($username, $password, $roleID, $name, $mail, $phoneNumber, $point, $type, $status) {
        $query = "INSERT INTO user (username, password, roleID, name, mail, phoneNumber, point, type, status) 
                  VALUES ('$username', '$password', '$roleID', '$name', '$mail', '$phoneNumber', '$point', '$type', '$status')";
        return $this->db->insert($query);
    }

    public function updateUser($userID, $username, $password, $roleID, $name, $mail, $phoneNumber, $point, $type, $status) {
        // Kiểm tra xem userID có tồn tại trong CSDL không
        $existingUser = $this->getUserByID2($userID);
        if (!$existingUser) {
            // userID không tồn tại, không thể cập nhật
            return false;
        }
    
        // Tiếp tục thực hiện câu lệnh update
        if (!empty($password)) {
            // Không băm mật khẩu, chỉ cập nhật trực tiếp
            $query = "UPDATE user 
                      SET username = '$username', 
                          password = '$password', 
                          roleID = '$roleID', 
                          name = '$name', 
                          mail = '$mail', 
                          phoneNumber = '$phoneNumber', 
                          point = '$point', 
                          type = '$type', 
                          status = '$status' 
                      WHERE userID = '$userID'";
        } else {
            $query = "UPDATE user 
                      SET username = '$username', 
                          roleID = '$roleID', 
                          name = '$name', 
                          mail = '$mail', 
                          phoneNumber = '$phoneNumber', 
                          point = '$point', 
                          type = '$type', 
                          status = '$status' 
                      WHERE userID = '$userID'";
        }
        return $this->db->update($query);
    }
    
    

    public function deleteUser($userID) {
        $query = "UPDATE FROM user SET status=0 WHERE userID = '$userID'";
        return $this->db->update($query);
    }

    public function authenticate($username, $password) {
        $user = $this->getUserByUsername($username);
        if ($user instanceof User) {
            $storedPassword = $user->getPassword();
            if ($password === $storedPassword) {
                return true;
            }
        }
        
        return false;
    }
    
    public function getUserByUsername($username) {
        $query = "SELECT * FROM user WHERE username = '$username' AND status != 0";
        $result = $this->db->select($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new User(
                $row['userID'],
                $row['username'],
                $row['password'],
                $row['timeCreated'],
                $row['roleID'],
                $row['name'],
                $row['mail'],
                $row['phoneNumber'],
                $row['point'],
                $row['type'],
                $row['status']
            );
        } else {
            return null;
        }
    }
    public function getUserDataByUsername($username) {
        $query = "SELECT * FROM user WHERE username = '$username' AND status != 0";
        $result = $this->db->select($query);
        
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); // Trả về mảng thông tin người dùng
        } else {
            return null;
        }
    }
    
    
    
    public function checkExistingUsername($username) {
        $query = "SELECT COUNT(*) AS count FROM user WHERE username = '$username'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    
    public function checkExistingEmail($email) {
        $query = "SELECT COUNT(*) AS count FROM user WHERE mail = '$email'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    
    public function checkExistingPhoneNumber($phoneNumber) {
        $query = "SELECT COUNT(*) AS count FROM user WHERE phoneNumber = '$phoneNumber'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    /*  */
    public function checkExistingUsername2($userID, $username) {
        $query = "SELECT COUNT(*) AS count FROM user WHERE username = '$username' AND userID != '$userID'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    
    public function checkExistingEmail2($userID, $email) {
        $query = "SELECT COUNT(*) AS count FROM user WHERE mail = '$email' AND userID != '$userID'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    
    public function checkExistingPhoneNumber2($userID, $phoneNumber) {
        $query = "SELECT COUNT(*) AS count FROM user WHERE phoneNumber = '$phoneNumber' AND userID != '$userID'";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'] > 0;
        } else {
            return false;
        }
    }
    
    

    public function checkPhoneNumberFormat($phoneNumber) {
        if(preg_match('/^0\d{9}$/', $phoneNumber) && is_numeric($phoneNumber) && strlen($phoneNumber) == 10) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserCountByRoleID($roleID) {
        $query = "SELECT COUNT(*) AS userCount FROM user WHERE roleID = '$roleID' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['userCount'];
        } else {
            return 0; // Trả về 0 nếu có lỗi hoặc không có người dùng nào có vai trò tương ứng
        }
    }
    public function changeUserStatus($userID, $newStatus) {
        // Update the status of the user in the database
        $query = "UPDATE user SET status = '$newStatus' WHERE userID = '$userID'";
        return $this->db->update($query);
    }

    // Lấy role ID bằng username
    public function getRoleIDByUsername($username) {
        $query = "SELECT roleID FROM user WHERE username = '$username' AND status != 0";
        $result = $this->db->select($query);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['roleID'];
        } else {
            return false;
        }
    }

    

}

?>
