<?php


class Shuttle {
    public $productID;
    public $speed;
    public $price;
    public $discount;
    public $quantity;
    public $type;
    public $detail;
    public $note;
    public $status;
    public $list_image;

    public function __construct($productID, $speed, $price, $discount, $quantity, $type, $detail, $note, $status, $list_image) {
        $this->productID = $productID;
        $this->speed = $speed;
        $this->price = $price;
        $this->discount = $discount;
        $this->quantity = $quantity;
        $this->type = $type;
        $this->detail = $detail;
        $this->note = $note;
        $this->status = $status;
        $this->list_image = $list_image;
    }

    // Getter và setter cho productID
    public function getProductID() {
        return $this->productID;
    }

    public function setProductID($productID) {
        $this->productID = $productID;
    }

    // Getter và setter cho speed
    public function getSpeed() {
        return $this->speed;
    }

    public function setSpeed($speed) {
        $this->speed = $speed;
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

    // Getter và setter cho quantity
    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    // Getter và setter cho type
    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    // Getter và setter cho detail
    public function getDetail() {
        return $this->detail;
    }

    public function setDetail($detail) {
        $this->detail = $detail;
    }

    // Getter và setter cho note
    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    // Getter và setter cho status
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
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

