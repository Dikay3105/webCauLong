<?php
class User {
    public $userID;
    public $username;
    public $password;
    public $timeCreated;
    public $roleID;
    public $name;
    public $mail;
    public $phoneNumber;
    public $point;
    public $type;
    public $status;

    public function __construct($userID, $username, $password, $timeCreated, $roleID, $name, $mail, $phoneNumber, $point, $type, $status) {
        $this->userID = $userID;
        $this->username = $username;
        $this->password = $password;
        $this->timeCreated = $timeCreated;
        $this->roleID = $roleID;
        $this->name = $name;
        $this->mail = $mail;
        $this->phoneNumber = $phoneNumber;
        $this->point = $point;
        $this->type = $type;
        $this->status = $status;
    }

    // Getter và setter cho userID
    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    // Getter và setter cho username
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    // Getter và setter cho password
    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    // Getter và setter cho timeCreated
    public function getTimeCreated() {
        return $this->timeCreated;
    }

    public function setTimeCreated($timeCreated) {
        $this->timeCreated = $timeCreated;
    }

    // Getter và setter cho roleID
    public function getRoleID() {
        return $this->roleID;
    }

    public function setRoleID($roleID) {
        $this->roleID = $roleID;
    }

    // Getter và setter cho name
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // Getter và setter cho mail
    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    // Getter và setter cho phoneNumber
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    // Getter và setter cho point
    public function getPoint() {
        return $this->point;
    }

    public function setPoint($point) {
        $this->point = $point;
    }

    // Getter và setter cho type
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    // Getter và setter cho status
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}

?>
