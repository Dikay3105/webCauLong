<?php

class Variant {
    protected $variantID;
    protected $productID;

    public function __construct($variantID, $productID) {
        $this->variantID = $variantID;
        $this->productID = $productID;
    }

    public function getVariantID() {
        return $this->variantID;
    }

    public function getProductID() {
        return $this->productID;
    }
}

?>
