<?php
require_once(__DIR__ . '/../Model/ModelCartDetail.php');
require_once(__DIR__ . '/../Model/ModelUser.php');
require_once(__DIR__ . '/../Model/ModelProduct.php');
require_once(__DIR__ . '/../Model/ModelCatalog.php');
require_once(__DIR__ . '/../Model/Entity/Catalog.php');

$modeluser = new ModelUser();
$modelcartdetail = new ModelCartDetail();
$modelproduct = new ModelProduct();
$modelCatalog = new ModelCatalog();

//$_SESSION['login']

if (isset($_GET['productID']) && isset($_GET['username']) && isset($_GET['variantID']) && isset($_GET['quantity']) && isset($_GET['price'])) {
    // Lấy dữ liệu từ yêu cầu AJAX
    if ($modelcartdetail->checkCartDetail($modeluser->getUIDByUserName($_GET['username']), $_GET['productID'], $_GET['variantID']) == false) {
        $productID = $_GET['productID'];
        $variantID = $_GET['variantID'];
        $quantity = $_GET['quantity'];
        $price = $_GET['price'];
        $username = $_GET['username'];
        $userID = $modeluser->getUIDByUserName($username);
        $modelcartdetail->addCartDetail($userID, $productID, $variantID, $quantity, $price);
        echo count($modelcartdetail->getCartDetailByCartID($userID));
    } else {
        $product = $modelproduct->getProductByID($_GET['productID']);
        $username = $_GET['username'];
        $userID = $modeluser->getUIDByUserName($username);
        $quantity = $_GET['quantity'] + $modelcartdetail->getQuantityCartDetail($_GET['productID'], $_GET['variantID']);
        $price = $product->getPrice() * $quantity;
        $modelcartdetail->updateAddCartDetail($modeluser->getUIDByUserName($_GET['username']), $_GET['productID'], $_GET['variantID'], $quantity, $price);
        echo count($modelcartdetail->getCartDetailByCartID($userID));
    }
    $catalog = $modelCatalog->getCatalogByID($_GET['productID']);
}else if(isset($_GET['action'])) {
    if($_GET['action']=="delete") {
        $modelcartdetail->deleteProductCartDetail($_GET['cartID'], $_GET['productID'], $_GET['variantID']);
        echo $modelcartdetail->getTotalPriceCart($_GET['cartID']);
    } elseif($_GET['action']=="quantity") {
        if($_GET['quantity']>0) {
            $product=$modelproduct->getProductByID($_GET['productID']);
            $modelcartdetail->updateQuantityCartDetail($_GET['cartID'], $_GET['productID'], $_GET['variantID'], $_GET['quantity'], $product->getPrice()*$_GET['quantity']);
            
        }
        echo $modelcartdetail->getTotalPriceCart($_GET['cartID']);
    } 
} else {
    echo json_encode([]);
}


