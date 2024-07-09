<?php
require_once __DIR__ . '/../../../Model/ModelProduct.php';
require_once __DIR__ . '/../../../Model/ModelBrand.php';
require_once __DIR__ . '/../../../Model/ModelCatalog.php';
require_once __DIR__ . '/../../../Model/ModelVariant.php';
require_once __DIR__ . '/../../../Model/ModelVariantDetail.php';


// Khởi tạo đối tượng ModelProduct
$modelProduct = new ModelProduct();

$productID = $_GET['productID'];

// Lấy thông tin sản phẩm từ cơ sở dữ liệu dựa trên productID
//$productID = 16;
$product = $modelProduct->getProductByID($productID);

// Khởi tạo đối tượng ModelBrand
$modelBrand = new ModelBrand();

// Lấy thông tin sản phẩm từ cơ sở dữ liệu dựa trên brandID
$brand = $modelBrand->getBrandByID($product->getBrandID());

// Khởi tạo đối tượng ModelBrand
$modelCatalog = new ModelCatalog();

// Lấy thông tin sản phẩm từ cơ sở dữ liệu dựa trên catalogID
$catalog = $modelCatalog->getCatalogByID($product->getCatalogID());


$modelVariant = new ModelVariant();
$listvariants = $modelVariant->getListVariantByProductID($productID);

$modelVariantDetail = new ModelVariantDetail();
$listVariantDetails = [];

$totalQuantity = 0;
foreach ($listvariants as $variant) {
    $variantID = $variant->getVariantID();
    $variantDetail = $modelVariantDetail->getVariantByID($variantID);
    $totalQuantity += $variantDetail->getQuantity();
    // Thêm chi tiết biến thể vào mảng $listVariantDetails
    $listVariantDetails[] = $variantDetail;
}

$string = $product->getUrl();

// Tạo mảng để lưu kết quả
$result = array();

// Tách chuỗi theo dấu chấm phẩy để lấy ra các phần tử riêng biệt
$parts = explode(";", $string);

foreach ($parts as $part) {
    // Tách từng phần tử thành tên và các số
    $temp = explode(":", $part);

    // Lưu tên làm key (viết thường) và các số làm value vào mảng kết quả
    if (isset($temp[0]) && isset($temp[1])) {
        $result[trim(($temp[0]))] = explode(",", $temp[1]);
    }
}
$imagePaths = array_values($result)[0];


if ($catalog->getName() == "Racket") {
} else if ($catalog->getName() == "Shoes") {
    usort($listVariantDetails, function ($a, $b) {
        // Lấy giá trị 'size' của mỗi đối tượng
        $sizeA = $a->getSize();
        $sizeB = $b->getSize();

        if ($sizeA == $sizeB) {
            return 0; // Giữ nguyên vị trí nếu giá trị 'size' bằng nhau
        }

        return ($sizeA < $sizeB) ? -1 : 1; // Trả về số âm, 0 hoặc dương tùy thuộc vào thứ tự của 'size'
    });
} else if ($catalog->getName() == "Shuttle") {
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="=X-UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    </link>
    <link href="https://cdn.shopvnb.com/themes/css/breadcrumb_style.scss.css" rel="stylesheet" type="text/css" />
    <link rel="preload" as='style' type="text/css" href="https://cdn.shopvnb.com/themes/css/breadcrumb_style.scss.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>test</title>
</head>

<body>
    <div class="bodywrap">
        <div class="product-container">
            <div class="product-img">
                <div class="big-img">

                </div>
                <div class="img-container">
                    <div class="slider-wrapper">
                        <button id="prev-slide" class="slide-button material-symbols-rounded">
                            chevron_left
                        </button>
                        <ul class="image-list" id="image-list">

                            <script>
                                // Đảm bảo rằng biến imagePaths đã được định nghĩa trước
                                const imagePaths = <?php echo json_encode($imagePaths); ?>;
                                const productID= <?php echo json_encode($productID); ?>;

                                const bigImageContainer = document.querySelector('.big-img');
                                const bigImage = document.createElement('img');
                                linktmp = "images/product/<?php echo $productID ;?>/<?php echo array_keys($result)[0] ;?>/<?php echo $productID ;?>.1.png";
                                getPromiseUrl(linktmp).then(url => {
                                    bigImage.src = url;
                                }).catch(error => {
                                    return error;
                                });
                                bigImage.style.maxWidth = '100%';
                                bigImage.id = 'big-image';
                                bigImage.style.maxHeight = '100%';
                                bigImage.style.objectFit = 'cover';
                                // Clear previous big image
                                bigImageContainer.innerHTML = '';
                                // Append new big image
                                bigImageContainer.appendChild(bigImage);
                                // Lặp qua mỗi đường dẫn hình ảnh và chèn chúng vào danh sách
                                for(var i=0;i<imagePaths.length;i++) {
                                    // Tạo một thẻ img và đặt thuộc tính src và alt
                                    const image = document.createElement('img');
                                    var link = "images/product/<?php echo $productID ;?>/<?php echo array_keys($result)[0] ;?>/<?php echo $productID ;?>."+imagePaths[i]+".png";
                                    console.log(link);
                                    getPromiseUrl(link).then(url=>{
                                        image.src = url;
                                    }).catch(error=> {
                                        return error;
                                    });
                                    image.alt = `Image ${i + 1}`; // Tùy chỉnh alt nếu cần
                                    image.classList.add('image-item');

                                    // Chọn ul danh sách hình ảnh
                                    const container = document.getElementById("image-list");

                                    // Kiểm tra xem danh sách có tồn tại không trước khi chèn hình vào
                                    if (container) {
                                        container.appendChild(image);
                                    } else {
                                        console.error(`UL with id 'image-list' not found.`);
                                    }
                                }

                            </script>
                        </ul>
                        
                        <button id="next-slide" class="slide-button material-symbols-rounded">
                            chevron_right
                        </button>
                    </div>
                </div>

            </div>

            <div class="product-detail">
                <h1 class="title-product">
                    <?php echo $product->getName(); ?>
                </h1>
                <div class="product-code">
                    <span content="123456789" style="font-size: 14px;">
                        Mã:
                        <span class="code">VNB
                            <?php echo $product->getProductID(); ?>
                        </span>
                    </span>
                </div>

                <div class="product-quantity">
                    <span class="mb-break">
                        <span class="brand-title">Thương hiệu</span>
                        <a class="a-vendor" href="">
                            <?php echo $brand->getName(); ?>
                        </a>
                    </span>
                    <span class="line">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                    <span class="mb-break" id="tinhtrang">
                        <script>
                            const racket = <?php echo json_encode($totalQuantity); ?>;
                            if (racket && racket.quantity <= 0) {
                                document.getElementById('tinhtrang').innerHTML = '<span class="brand-title">Tình trạng: </span><span class="a-vendor">Hết hàng</span>';
                            } else {
                                document.getElementById('tinhtrang').innerHTML = '<span class="brand-title">Tình trạng: </span><span class="a-vendor">Còn hàng</span>';
                            }
                        </script>
                    </span>

                </div>

                <form>
                    <div class="price-box">
                        <span class="special-price">
                            <span class="price product-price">
                                <?php echo number_format($product->getPrice(), 0, ',', '.'); ?> ₫
                            </span>
                        </span>

                        <span class="old-price">
                            Giá niêm yết:
                            <del class="price product-price-old">
                                <?php echo number_format($product->getFakePrice(), 0, ',', '.'); ?> ₫
                            </del>
                        </span>
                    </div>

                    <fieldset class="pro-discount uu-dai" style="margin-top: 10px;">
                        <legend>
                            <img src="../View/images/icon/code_dis.gif" alt="khuyến mãi">ƯU ĐÃI
                        </legend>
                        <div class="product-promotions-list-content">
                            <p>
                                ✔ Tặng 2 Quấn cán vợt Cầu Lông:
                                <a href="">VNB 001</a>, <a href="">VNB 001</a> hoặc <a href="">VNB 001</a>
                            </p>
                            <p>
                                ✔ Tặng 2 Quấn cán vợt Cầu Lông:
                            </p>
                            <p>
                                ✔ Tặng 2 Quấn cán vợt Cầu Lông:
                            </p>
                            <p>
                                ✔ Tặng 2 Quấn cán vợt Cầu Lông:
                            </p>
                            <p>
                                ✔ Tặng 2 Quấn cán vợt Cầu Lông:
                            </p>
                            <p>&nbsp;</p>
                            <span style="font-family:verdana,geneva,sans-serif">
                                <strong>
                                    🎁Ưu đãi thêm khi mua sản phẩm tại
                                    <a href="https://shopvnb.com/cua-hang-vnb-premium.html">VNB Premium</a>
                                </strong>
                            </span>
                            <p>
                                <span style="font-family:verdana,geneva,sans-serif">✅ <a href="https://shopvnb.com/son-logo-mat-vot-mien-phi-tai-shop-vnb-premium.html">Sơn
                                        logo mặt vợt</a> miễn phí</span>
                            </p>
                            <p><span style="font-family:verdana,geneva,sans-serif">✅&nbsp;<a href="https://shopvnb.com/thay-gen-vot-cau-long-mien-phi-tai-vnb-premium.html">Thay
                                        gen vợt</a> miễn phí trọn đời</span></p>
                            <p><span style="font-family:verdana,geneva,sans-serif">✅&nbsp;<a href="https://shopvnb.com/thay-gen-vot-cau-long-mien-phi-tai-vnb-premium.html">Thay
                                        gen vợt</a> miễn phí trọn đời</span></p>
                            <p><span style="font-family:verdana,geneva,sans-serif">✅&nbsp;<a href="https://shopvnb.com/thay-gen-vot-cau-long-mien-phi-tai-vnb-premium.html">Thay
                                        gen vợt</a> miễn phí trọn đời</span></p>
                            <p><span style="font-family:verdana,geneva,sans-serif">✅&nbsp;<a href="https://shopvnb.com/thay-gen-vot-cau-long-mien-phi-tai-vnb-premium.html">Thay
                                        gen vợt</a> miễn phí trọn đời</span></p>
                        </div>
                    </fieldset>
                    <div class="form-product" id="test">

                        <?php if ($catalog->getName() == 'Shuttle') : ?>
                            <div class="select-swatch">
                                <div class="swatch clearfix">
                                    <div class="header">Chọn tốc độ: </div>
                                    <?php foreach ($listVariantDetails as $variantDetail) : ?>
                                        <?php if ($variantDetail->getQuantity() > 0) : ?>
                                            <div class="swatch-element color-<?php echo $variantDetail->getSpeed(); ?>" data-value="<?php echo $variantDetail->getSpeed(); ?>" data-value_2="<?php echo $variantDetail->getSpeed(); ?>">
                                                <input id="color-<?php echo $variantDetail->getSpeed(); ?>" type="radio" name="version" value="<?php echo $variantDetail->getVariantID(); ?>">
                                            <?php else : ?>
                                                <div class="swatch-element soldout color-<?php echo $variantDetail->getSpeed(); ?>" data-value="<?php echo $variantDetail->getSpeed(); ?>" data-value_2="<?php echo $variantDetail->getSpeed(); ?>">
                                                    <input disabled id="color-<?php echo $variantDetail->getSpeed(); ?>" type="radio" name="version" value="<?php echo $variantDetail->getVariantID(); ?>">
                                                <?php endif; ?>
                                                <label for="color-<?php echo $variantDetail->getSpeed(); ?>">
                                                    <?php echo $variantDetail->getSpeed(); ?>
                                                    <img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="<?php echo $variantDetail->getSpeed(); ?>">
                                                </label>
                                                </div>
                                            <?php endforeach; ?>
                                            </div>
                                </div>
                            </div>
                        <?php elseif ($catalog->getName() == 'Racket' || $catalog->getName() == 'Shoes') : ?>
                            <div class="select-swatch">
                                <div class="swatch clearfix">
                                    <div class="header">Chọn màu: </div>
                                    <?php
                                    // Mảng tạm thời để lưu trữ các màu đã xuất hiện
                                    $seenColors = [];

                                    foreach ($listVariantDetails as $variantDetail) :
                                        // Lấy màu của biến thể hiện tại
                                        $color = $variantDetail->getColor();

                                        // Kiểm tra xem màu đã được thêm vào mảng tạm thời chưa
                                        if (!in_array($color, $seenColors)) :
                                            // Thêm màu vào mảng tạm thời
                                            $seenColors[] = $color;

                                            // Hiển thị swatch-element cho màu
                                    ?>
                                            <div class="swatch-element <?php if ($modelVariantDetail->getVariantQuantityByColor($listVariantDetails, $color) <= 0) :
                                                                            echo "soldout";
                                                                        endif; ?> color-<?php echo $color; ?>" data-value="<?php echo $color; ?>" data-value_2="<?php echo $color; ?>">
                                                <input onclick="<?php if ($catalog->getName() == 'Shoes') echo 'loadSize';
                                                                else echo 'loadVersion' ?>('<?php echo $productID; ?>', '<?php echo $color; ?>')" <?php if ($modelVariantDetail->getVariantQuantityByColor($listVariantDetails, $color) <= 0) :
                                                                                                                                                        echo "disabled";
                                                                                                                                                    endif; ?> id="color-<?php echo $color; ?>" type="radio" name="color" value="<?php echo $color; ?>">
                                                <label for="color-<?php echo $color; ?>">
                                                    <?php echo $color; ?>
                                                    <img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="<?php echo $color; ?>">
                                                </label>
                                            </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="select-swatch">
                                <div class="swatch clearfix">
                                    <div class="header">Chọn màu: </div>
                                    <?php
                                    // Mảng tạm thời để lưu trữ các màu đã xuất hiện
                                    $seenColors = [];

                                    foreach ($listVariantDetails as $variantDetail) :
                                        // Lấy màu của biến thể hiện tại
                                        $color = $variantDetail->getColor();

                                        // Kiểm tra xem màu đã được thêm vào mảng tạm thời chưa
                                        if (!in_array($color, $seenColors)) :
                                            // Thêm màu vào mảng tạm thời
                                            $seenColors[] = $color;

                                            // Hiển thị swatch-element cho màu
                                    ?>
                                            <div class="swatch-element <?php if ($modelVariantDetail->getVariantQuantityByColor($listVariantDetails, $color) <= 0) :
                                                                            echo "soldout";
                                                                        endif; ?> color-<?php echo $color; ?>" data-value="<?php echo $color; ?>" data-value_2="<?php echo $color; ?>">
                                                <input <?php if ($modelVariantDetail->getVariantQuantityByColor($listVariantDetails, $color) <= 0) :
                                                            echo "disabled";
                                                        endif; ?> id="color-<?php echo $color; ?>" type="radio" name="version" value="<?php echo $variantDetail->getVariantID(); ?>">
                                                <label for="color-<?php echo $color; ?>">
                                                    <?php echo $color; ?>
                                                    <img class="crossed-out" src="https://cdn.shopvnb.com/themes/images/soldout.png" alt="<?php echo $color; ?>">
                                                </label>
                                            </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </div>
                            </div>

                        <?php endif; ?>

                        <div id="hidden"></div>

                        <div class="boz-form">
                            <div class="clearfix form-group">
                                <div class="flex-quantity">
                                    <div class="custom custom-btn-number show">
                                        <div class="input_number_product">
                                            <button class="btn_num num_1 button button_qty" onclick="var result = document.getElementById('qtym'); var qtypro = parseInt(result.value); if (!isNaN(qtypro) && qtypro > 1) result.value = qtypro - 1; return false;" type="button">-</button>
                                            <input type="text" id="qtym" name="so_luong" value="1" maxlength="3" class="form-control prd_quantity" onkeypress="if (isNaN(this.value + String.fromCharCode(event.keyCode))) return false;" onchange="if(this.value == 0) this.value=1;">
                                            <button class="btn_num num_2 button button_qty" onclick="var result = document.getElementById('qtym'); var qtypro = parseInt(result.value); if (!isNaN(qtypro)) result.value = qtypro + 1; return false;" type="button"><span>+</span></button>
                                        </div>
                                    </div>

                                </div>
                                <div class="flex-quantity">
                                    <div class="btn-mua button_actions clearfix">

                                        <button onclick="addCart()" type="button" class="btn btn_base normal_button btn_add_cart add_to_cart btn-cart"><span class="txt-main">Thêm vào giỏ hàng</span></button>

                                    </div>
                                    <div class="btn-mua button_actions2 clearfix">

<!--                                         <button type="submit" class="btn btn_base normal_button btn_add_cart add_to_cart btn-cart"><span class="txt-main">Mua ngay</span></button>
 -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
        </form>


    </div>

    <div class="description">
        <div class="tab-header">
            <button class="tab-button active" data-tab="tab1">Mô tả sản phẩm</button>
            <button class="tab-button" data-tab="tab2">Thông số kỹ thuật</button>
        </div>
        <div class="tab-content" id="tab1" style="width: 80%; margin-left:10%">
            <?php if ($product->getDescription() != 0) echo $product->getDescription(); ?>
        </div>
        <div id="tab2" class="tab-content content_extab" style="display: none;">
            <div class="thongso-container">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="30%"><b>Trình Độ Chơi:</b></td>
                            <td>Khá Tốt</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Chiều dài vợt:</b></td>
                            <td>675 mm </td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Nội Dung Chơi:</b></td>
                            <td>Cả Đơn và Đôi</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Điểm Cân Bằng:</b></td>
                            <td>Nặng Đầu</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Trọng Lượng:</b></td>
                            <td>3U: 85 - 89g</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Phong Cách Chơi:</b></td>
                            <td>Tấn Công</td>
                        </tr>
                        <tr>
                            <td width="30%"><b>Độ Cứng Đũa:</b></td>
                            <td>Cứng</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="product-data-get" data-product="<?php echo htmlspecialchars(json_encode($product)); ?>"></div>
    <div id="login-data-get" data-login="<?php echo isset($_SESSION['login']) ? htmlspecialchars(json_encode($_SESSION['login'])) : 'false'; ?>"></div>
    <div id="product-data-quantity" data-quantity="<?php echo htmlspecialchars(json_encode($product)); ?>"></div>
    <div id="product-data-user" data-user="<?php echo isset($_SESSION['username']) ? htmlspecialchars(json_encode($_SESSION['username'])) : 'null'; ?>"></div>
    <div id="catalog-data" data-catalog="<?php echo htmlspecialchars(json_encode($catalog->getName())); ?>"></div>
    <div id="image-list-data" data-array=""></div>
    <script>
        var myArray = <?php echo json_encode($result) ?>;
        var divElement = document.getElementById("image-list-data");
        divElement.dataset.array = JSON.stringify(myArray).toLowerCase();
    </script>
</body>

</html>