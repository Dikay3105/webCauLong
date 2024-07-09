<?php
class Brand {
    public $brandID;
    public $name;
    public $description;
    public $status;

    public function __construct($brandID, $name, $description, $status) {
        $this->brandID = $brandID;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
    }

    // Getter và setter cho brandID
    public function getBrandID() {
        return $this->brandID;
    }

    public function setBrandID($brandID) {
        $this->brandID = $brandID;
    }

    // Getter và setter cho name
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // Getter và setter cho description
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
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
