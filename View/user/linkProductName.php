        <?php
$productid = $_GET['productID'];
require_once('../Model/ModelProduct.php');
require_once('../Model/ModelBrand.php');

$modelProduct = new ModelProduct();
$product = $modelProduct->getProductByID($productid);

$modelBrand = new ModelBrand();
$brand = $modelBrand->getBrandByID($product->getBrandID());

require_once('../Model/ModelCatalog.php');

$modelCatalog = new ModelCatalog();
$catalog = $modelCatalog->getCatalogByID($product->getCatalogID());
?>

<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">

        <a itemprop="item" href="index.php?control=ProductCategory&id=<?php echo $catalog->getCatalogID(); ?>" title="<?php echo $catalog->getName(); ?>"><span itemprop="name"><?php echo $catalog->getName(); ?></span></a>

        <meta itemprop="position" content="1">
        <span class="mr_lr">&nbsp;<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10">
                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" class=""></path>
                </svg>&nbsp;</span>
</li>

<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">

        <a itemprop="item" href="index.php?control=ProductCategory&id=<?php echo $catalog->getCatalogID(); ?>&brandID=<?php echo $brand->getBrandID(); ?>" title="<?php echo $brand->getName(); ?> <?php echo $catalog->getName(); ?>"><span itemprop="name"><?php echo $brand->getName(); ?> <?php echo $catalog->getName(); ?></span></a>

        <meta itemprop="position" content="2">
        <span class="mr_lr">&nbsp;<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-chevron-right fa-w-10">
                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" class=""></path>
                </svg>&nbsp;</span>
</li>

<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
    <strong itemprop="name">
    <?php echo $product->getName(); ?> </strong>
    <meta itemprop="position" content="3">
</li>