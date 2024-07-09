<?php
class Racket {
    public $productID;
    public $color;
    public $price;
    public $discount;
    public $flex;
    public $tension_max;
    public $grip;
    public $frame_build;
    public $shaft_build;
    public $weight;
    public $status;
    public $quantity;
    public $swing_weight;
    public $balance_point;
    public $note;
    public $list_image;

    public function __construct($productID, $color, $price, $discount, $flex, $tension_max, $grip, $frame_build, $shaft_build, $weight, $status, $quantity, $swing_weight, $balance_point, $note, $list_image) {
        $this->productID = $productID;
        $this->color = $color;
        $this->price = $price;
        $this->discount = $discount;
        $this->flex = $flex;
        $this->tension_max = $tension_max;
        $this->grip = $grip;
        $this->frame_build = $frame_build;
        $this->shaft_build = $shaft_build;
        $this->weight = $weight;
        $this->status = $status;
        $this->quantity = $quantity;
        $this->swing_weight = $swing_weight;
        $this->balance_point = $balance_point;
        $this->note = $note;
        $this->list_image = $list_image;
    }

    // Getter và setter cho productID
    public function getProductID() {
        return $this->productID;
    }

    public function setProductID($productID) {
        $this->productID = $productID;
    }

    // Getter và setter cho color
    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    // Getter và setter cho price
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    // Getter và setter cho discount
    public function getDiscount() {
        return $this->discount;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }

    // Getter và setter cho flex
    public function getFlex() {
        return $this->flex;
    }

    public function setFlex($flex) {
        $this->flex = $flex;
    }

    // Getter và setter cho tension_max
    public function getTensionMax() {
        return $this->tension_max;
    }

    public function setTensionMax($tension_max) {
        $this->tension_max = $tension_max;
    }

    // Getter và setter cho grip
    public function getGrip() {
        return $this->grip;
    }

    public function setGrip($grip) {
        $this->grip = $grip;
    }

    // Getter và setter cho frame_build
    public function getFrameBuild() {
        return $this->frame_build;
    }

    public function setFrameBuild($frame_build) {
        $this->frame_build = $frame_build;
    }

    // Getter và setter cho shaft_build
    public function getShaftBuild() {
        return $this->shaft_build;
    }

    public function setShaftBuild($shaft_build) {
        $this->shaft_build = $shaft_build;
    }

    // Getter và setter cho weight
    public function getWeight() {
        return $this->weight;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    // Getter và setter cho status
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    // Getter và setter cho quantity
    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    // Getter và setter cho swing_weight
    public function getSwingWeight() {
        return $this->swing_weight;
    }

    public function setSwingWeight($swing_weight) {
        $this->swing_weight = $swing_weight;
    }

    // Getter và setter cho balance_point
    public function getBalancePoint() {
        return $this->balance_point;
    }

    public function setBalancePoint($balance_point) {
        $this->balance_point = $balance_point;
    }

    // Getter và setter cho note
    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    // Getter và setter cho list_image
    public function getListImage() {
        return $this->list_image;
    }

    public function setListImage($list_image) {
        $this->list_image = $list_image;
    }
}

?>
