<?php

class Catalog {
    public $catalogID;
    public $name;
    public $parentID;

    public function __construct($catalogID, $name, $parentID) {
        $this->catalogID = $catalogID;
        $this->name = $name;
        $this->parentID = $parentID;
    }

    // Getter và setter cho catalogID
    public function getCatalogID() {
        return $this->catalogID;
    }

    public function setCatalogID($catalogID) {
        $this->catalogID = $catalogID;
    }

    // Getter và setter cho name
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    // Getter và setter cho parentID
    public function getParentID() {
        return $this->parentID;
    }

    public function setParentID($parentID) {
        $this->parentID = $parentID;
    }
}

?>
