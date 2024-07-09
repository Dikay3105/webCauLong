<?php
require_once '../Model/ModelProduct.php'; 
$modelProduct = new ModelProduct();
$products = $modelProduct->getAllProducts();
$productInfo = [];
foreach ($products as $product) {
    $productInfo[] = [
        'productID' => $product->getProductID(),
        'name' => $product->getName(),
        'price' => $product->getPrice(),
        'brandID' => $product->getBrandID(),
        'catalogID' => $product->getCatalogID(),
        'fakePrice' => $product->getFakePrice(),
        'status' => $product->getStatus(),
        'url' => $product->getUrl(),
        'timeCreated' => $product->getTimecreated(),
    ];
}

echo json_encode($productInfo);
?>