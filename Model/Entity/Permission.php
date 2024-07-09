<?php

class Permission {
    public $roleID;
    public $functionID;
    public $permissionName;

    public function __construct($roleID, $functionID, $permissionName) {
        $this->roleID = $roleID;
        $this->functionID = $functionID;
        $this->permissionName = $permissionName;
    }

    // Getter và setter cho roleID
    public function getRoleID() {
        return $this->roleID;
    }

    public function setRoleID($roleID) {
        $this->roleID = $roleID;
    }

    // Getter và setter cho functionID
    public function getFunctionID() {
        return $this->functionID;
    }

    public function setFunctionID($functionID) {
        $this->functionID = $functionID;
    }

    // Getter và setter cho permissionName
    public function getPermissionName() {
        return $this->permissionName;
    }

    public function setPermissionName($permissionName) {
        $this->permissionName = $permissionName;
    }
}

?>
