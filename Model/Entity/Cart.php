<?php
class Cart {
    public $cartID;
    public $userID;
    public $timeCreated;

    public function __construct($cartID, $userID, $timeCreated) {
        $this->cartID = $cartID;
        $this->userID = $userID;
        $this->timeCreated = $timeCreated;
    }

    // Getter và setter cho cartID
    public function getCartID() {
        return $this->cartID;
    }

    public function setCartID($cartID) {
        $this->cartID = $cartID;
    }

    // Getter và setter cho userID
    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    // Getter và setter cho timeCreated
    public function getTimeCreated() {
        return $this->timeCreated;
    }

    public function setTimeCreated($timeCreated) {
        $this->timeCreated = $timeCreated;
    }
}

?>
