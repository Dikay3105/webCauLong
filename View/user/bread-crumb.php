<section class="bread-crumb">
    <div class="container">
        <ul class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
            <?php include('linkHome.php'); ?>
            <?php if (isset($_GET['control']) && $_GET['control'] == "ProductCategory" && !isset($_GET['search'])) include('linkProduct.php');
            else include('linkMenu.php'); ?>
            <?php if (isset($_GET['brandID'])) include('linkProductBrand.php'); ?>
            <?php if (isset($_GET['productID'])) include('linkProductName.php'); ?>
            <?php
            if (isset($_GET['control']) && $_GET['control'] == "ProductCategory" && isset($_GET['search'])) {
                echo '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <strong itemprop="name">Tìm kiếm sản phẩm [' . $_GET['search'] . ']</strong>
                <meta itemprop="position" content="3">
        </li>';
            }
            ?>
        </ul>
    </div>
</section>