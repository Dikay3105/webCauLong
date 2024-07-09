<?php 
class StringProduct {
    public $productID;
    public $color;
    public $price;
    public $discount;
    public $status;
    public $quantity;
    public $country;
    public $note;
    public $list_image;

    public function __construct($productID, $color, $price, $discount, $status, $quantity, $country, $note, $list_image) {
        $this->productID = $productID;
        $this->color = $color;
        $this->price = $price;
        $this->discount = $discount;
        $this->status = $status;
        $this->quantity = $quantity;
        $this->country = $country;
        $this->note = $note;
        $this->list_image = $list_image;
    }

    // Getter và setter cho các thuộc tính
    public function getProductID() {
        return $this->productID;
    }

    public function setProductID($productID) {
        $this->productID = $productID;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function getListImage() {
        return $this->list_image;
    }

    public function setListImage($list_image) {
        $this->list_image = $list_image;
    }
}

?>