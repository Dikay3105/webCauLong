<?php


class CartDetail {
    public $cartDetailID;
    public $cartID;
    public $productID;
    public $quantity;
    public $price;
    public $variantID;

    public function __construct($cartDetailID, $cartID, $productID, $variantID, $quantity, $price) {
        $this->cartDetailID = $cartDetailID;
        $this->cartID = $cartID;
        $this->productID = $productID;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->variantID = $variantID;
    }

    // Getter và setter cho cartDetailID
    public function getCartDetailID() {
        return $this->cartDetailID;
    }

    public function setCartDetailID($cartDetailID) {
        $this->cartDetailID = $cartDetailID;
    }

    public function getVariantID() {
        return $this->variantID;
    }

    public function setVariantID($variantID) {
        $this->variantID = $variantID;
    }

    // Getter và setter cho cartID
    public function getCartID() {
        return $this->cartID;
    }

    public function setCartID($cartID) {
        $this->cartID = $cartID;
    }

    // Getter và setter cho productID
    public function getProductID() {
        return $this->productID;
    }

    public function setProductID($productID) {
        $this->productID = $productID;
    }

    // Getter và setter cho quantity
    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    // Getter và setter cho price
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }
}

?>
