<?php

class OrderTransaction {
    public $orderID;
    public $transactionID;
    public $productID;
    public $variantID;
    public $totalAmount;
    public $note;
    public $quantity;

    public function __construct($orderID, $transactionID, $productID, $variantID, $totalAmount, $note, $quantity) {
        $this->orderID = $orderID;
        $this->transactionID = $transactionID;
        $this->productID = $productID;
        $this->variantID = $variantID;
        $this->totalAmount = $totalAmount;
        $this->note = $note;
        $this->quantity = $quantity;
    }

    // Getter và setter cho orderID
    public function getOrderID() {
        return $this->orderID;
    }

    public function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    // Getter và setter cho transactionID
    public function getTransactionID() {
        return $this->transactionID;
    }

    public function setTransactionID($transactionID) {
        $this->transactionID = $transactionID;
    }

    // Getter và setter cho productID
    public function getProductID() {
        return $this->productID;
    }

    public function setProductID($productID) {
        $this->productID = $productID;
    }

    // Getter và setter cho variantID
    public function getVariantID() {
        return $this->variantID;
    }

    public function setVariantID($variantID) {
        $this->variantID = $variantID;
    }

    // Getter và setter cho totalAmount
    public function getTotalAmount() {
        return $this->totalAmount;
    }

    public function setTotalAmount($totalAmount) {
        $this->totalAmount = $totalAmount;
    }

    // Getter và setter cho note
    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    // Getter và setter cho quantity
    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
}

?>