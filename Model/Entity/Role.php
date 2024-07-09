<?php

class Role {
    public $roleID;
    public $roleName;

    public function __construct($roleID, $roleName) {
        $this->roleID = $roleID;
        $this->roleName = $roleName;
    }

    // Getter và setter cho roleID
    public function getRoleID() {
        return $this->roleID;
    }

    public function setRoleID($roleID) {
        $this->roleID = $roleID;
    }

    // Getter và setter cho roleName
    public function getRoleName() {
        return $this->roleName;
    }

    public function setRoleName($roleName) {
        $this->roleName = $roleName;
    }
}

?>
