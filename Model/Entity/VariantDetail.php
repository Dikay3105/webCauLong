<?php

class VariantDetail {
    protected $variantID;
    protected $color;
    protected $size;
    protected $speed;
    protected $grip;
    protected $weight;
    protected $quantity;
    protected $list_image;
    protected $status;

    public function __construct($variantID, $color, $size, $speed, $grip, $weight, $quantity, $list_image, $status) {
        $this->variantID = $variantID;
        $this->color = $color;
        $this->size = $size;
        $this->speed = $speed;
        $this->grip = $grip;
        $this->weight = $weight;
        $this->quantity = $quantity;
        $this->list_image = $list_image;
        $this->status = $status;
    }

    // Getter methods
    public function getVariantID() {
        return $this->variantID;
    }

    public function getColor() {
        return $this->color;
    }

    public function getSize() {
        return $this->size;
    }

    public function getSpeed() {
        return $this->speed;
    }

    public function getGrip() {
        return $this->grip;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getListImage() {
        return $this->list_image;
    }

    public function getStatus() {
        return $this->status;
    }

    // Setter methods
    public function setVariantID($variantID) {
        $this->variantID = $variantID;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function setSpeed($speed) {
        $this->speed = $speed;
    }

    public function setGrip($grip) {
        $this->grip = $grip;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function setListImage($list_image) {
        $this->list_image = $list_image;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}

?>
