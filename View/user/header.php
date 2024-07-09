
<div class="header_contentTop">
    <div class="left_header_contentTop">
        <div class="logo">
            <img id="logoImg">
            <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                    getPromiseUrl("images/logo.png").then(url=>{
                        document.getElementById("logoImg").src = url;
                        console.log(url);
                    }).catch(error=> {
                        return error;
                    });
                });
            </script>
        </div>
        <a href="#"> HOTLINE: 0123456789 | 0987654321 </a>
    </div>
    <div class="center_header_contentTop">
        <form action="" method="POST" id="search_box" name="search_box">
            <div class="search-container">
                <input type="search" name="search_text" id="search_text" placeholder="Bạn muốn tìm gì !!!!" value="">
                <i class="fa fa-search" aria-hidden="true" style="color: #e95221;"></i>
            </div>
            <div>
                <ul class="search-list" id="searchList">
                    <!-- Nơi hiển thị kết quả tìm kiếm -->
                </ul>
            </div>

        </form>

    </div>

    <div class="right_header_contentTop">
        <div class="icon-item">
            <li>
                <i class="fa-solid fa-clipboard-list" style="color: #e95221;"></i>
                <span class="icon-name">TRA CỨU</span>
                <ul class="submenu_check" style="height: 30px;">
                    <li class="dropdown-item" style="height: 100%;"> <a href="index.php?control=checkDonHang"> Kiểm tra
                            đơn hàng </a></li>
                </ul>
            </li>
        </div>
        <div class="icon-item">
            <li>
                <i class="fa-solid fa-user" style="color: #e95221;"></i>
                <span class="icon-name" id="spanTK">
                    <?php
                    if (isset($_SESSION['login'])) {
                        if ($_SESSION['login'] == true && !empty($_SESSION['username'])) {
                            echo strtoupper($_SESSION['username']);
                        } else {
                            echo "TÀI KHOẢN";
                        }
                    } else {
                        echo "TÀI KHOẢN";
                    }
                    ?>
                </span>
                <?php
                if (isset($_SESSION['login'])) {
                    if ($_SESSION['login'] == true && !empty($_SESSION['username'])) {
                        echo '
                        <ul class="submenu_user">
                            <li class="dropdown-item"> <a href="index.php?control=infor-user"> Thông tin </a></li>
                            <li class="dropdown-item"> <a href="index.php?control=logout"> Đăng xuất</a></li>
                        </ul>
                        ';
                    } else {
                        echo '
                        <ul class="submenu_user">
                            <li class="dropdown-item"> <a href="index.php?control=signin"> Đăng nhập </a></li>
                            <li class="dropdown-item"> <a href="index.php?control=signup"> Đăng kí</a></li>
                        </ul>';
                    }
                } else {
                    echo '
                    <ul class="submenu_user">
                        <li class="dropdown-item"> <a href="index.php?control=signin"> Đăng nhập </a></li>
                        <li class="dropdown-item"> <a href="index.php?control=signup"> Đăng kí</a></li>
                    </ul>';
                }
                ?>


            </li>
        </div>
        <div class="icon-item" id="hover-cart">
            <li href="index.php?control=Cart">
                <ul class="show-item" onmouseover="showTarget()" onmouseout="hideTarget()">
                    <a class="a-head" href="index.php?control=Cart"><i class="fa-solid fa-cart-arrow-down"
                            style="color: #e95221;"></i></a>
                    <span class="icon-name"><a class="a-head" href="index.php?control=Cart"><span class="icon-name"
                                id="spanGH">GIỎ HÀNG</span></a></span>
                </ul>
            </li>
        </div>
    </div>

</div>
<div class="header_contentBottom">
    <li> <a class="titlemenu" href="index.php">TRANG CHỦ</a> </li>
    <li>
        <a class="titlemenu" href="#">SẢN PHẨM</a>
        <ul class="submenu">
            <?php
            require_once ('../Model/ModelCatalog.php');
            require_once ('../Model/ModelBrand.php');

            $modelBrand = new ModelBrand();
            $modelCatalog = new ModelCatalog();
            $catalogs = $modelCatalog->getAllCatalogs();

            if (is_array($catalogs) && !empty($catalogs)) {
                foreach ($catalogs as $catalog) {
                    $temp = null;
                    if ($catalog->getName() == "Racket") {
                        $temp = "Vợt cầu lông ";
                    } elseif ($catalog->getName() == "String") {
                        $temp = "Lưới cầu lông ";
                    } elseif ($catalog->getName() == "Shuttle") {
                        $temp = "Quả cầu lông ";
                    } else
                        $temp = "Giày cầu lông ";
                    echo '
                                <li> 
                                    <a class="submenua" href="index.php?control=ProductCategory&id=' . $catalog->getCatalogID() . '">' . $temp . '</a> 
                                    <ul class="menu_item">';
                    $brandIDs = $modelBrand->suggestBrandIDsForCatalog($catalog->getCatalogID());
                    foreach ($brandIDs as $brandID) {
                        $brand = $modelBrand->getBrandByID($brandID);
                        if ($brand != null)
                            echo '<li><a class="fixa" href="index.php?control=ProductCategory&id=' . $catalog->getCatalogID() . '&brandID=' . $brandID . '" style="color: black;text-decoration: none;">' . $temp . ' ' . $brand->getName() . '</a></li>';
                    }

                    echo '
                                        <li><a  href="index.php?control=ProductCategory&id=' . $catalog->getCatalogID() . '" style="color: black; text-decoration: none;">Xem thêm</a></li>
                                    </ul>
                                </li>';
                }
            } else {
                echo "Không thể lấy dữ liệu từ cơ sở dữ liệu hoặc không có dữ liệu nào được tìm thấy";
            }
            ?>
        </ul>



    </li>
    <li> <a class="titlemenu" href="index.php?control=IntroduceCategory">GIỚI THIỆU</a></li>
    <li> <a class="titlemenu" href="index.php?control=ContactCategory">LIÊN HỆ</a></li>
</div>

<form action class="popup-cart" onmouseover="showTarget()" onmouseout="hideTarget()">

    <div class="title-cart-head">Giỏ hàng</div>
    <div class="cart-body">
        <div class="ajaxcart-row">
            <?php
            if (isset($_SESSION['username'])) {
                require_once ('../Model/ModelVariantDetail.php');
                require_once ('../Model/ModelUser.php');
                require_once ('../Model/ModelProduct.php');
                require_once ('../Model/ModelCartDetail.php');
                require_once ('../Model/ModelCatalog.php');
                $modelVariantDetail = new ModelVariantDetail();
                $modelUser = new ModelUser();
                $modelProduct = new ModelProduct();
                $modelCartDetail = new ModelCartDetail();
                $modelCatalog = new ModelCatalog();
                $cartDetails = $modelCartDetail->getCartDetailByCartID($modelUser->getUIDByUserName($_SESSION['username']));
                foreach ($cartDetails as $cartDetail) {
                    $variantDetail = $modelVariantDetail->getVariantByID(($cartDetail)->getVariantID());
                    $product = $modelProduct->getProductByID(($cartDetail)->getProductID());
                    $total_price_cart += $product->getPrice();
                    $catalog = $modelCatalog->getCatalogByID($product->getCatalogID())->getName();
                    if ($catalog == "Shuttle" || $catalog == "String") {
                        echo "<div id='" . $modelUser->getUIDByUserName($_SESSION['username']) . "_" . $product->getProductID() . "_" . $variantDetail->getVariantID() . "'>
                                                                                                                    <a title='Xóa' class='remove-item-cart' href='javascript:void(0);' onclick='delProductCart(" . $modelUser->getUIDByUserName($_SESSION['username']) . ", " . $product->getProductID() . ", " . $cartDetail->getVariantID() . ")'><img class='svg-inline' src='../View/images/x-close.svg'></a>
                                                                                                                    <div class='cart-product'>
                                                                                                                        <a href='#' class='cart-image' title='" . $product->getName() . "'><img width='80' height='80' src='../View/images/product/" . $product->getProductID() . "/default/" . $product->getProductID() . ".1.png' alt='" . $product->getName() . "'></a>
                                                                                                                        <div class='cart-info'>
                                                                                                                            <div class='cart-name'>
                                                                                                                            <a href='#' class='' title='" . $product->getName() . "'>" . $product->getName() . "</a>";
                    } else {
                        echo "<div id='" . $modelUser->getUIDByUserName($_SESSION['username']) . "_" . $product->getProductID() . "_" . $variantDetail->getVariantID() . "'>
                                                        <a title='Xóa' class='remove-item-cart' href='javascript:void(0);' onclick='delProductCart(" . $modelUser->getUIDByUserName($_SESSION['username']) . ", " . $product->getProductID() . ", " . $cartDetail->getVariantID() . ")'><img class='svg-inline' src='../View/images/x-close.svg'></a>
                                                        <div class='cart-product'>
                                                            <a href='#' class='cart-image' title='" . $product->getName() . "'><img width='80' height='80' src='../View/images/product/" . $product->getProductID() . "/" . $variantDetail->getColor() . "/" . $product->getProductID() . ".1.png' alt='" . $product->getName() . "'></a>
                                                            <div class='cart-info'>
                                                                <div class='cart-name'>
                                                                <a href='#' class='' title='" . $product->getName() . "'>" . $product->getName() . "</a>";
                    }

                    if ($variantDetail->getColor() != null)
                        echo "<span class='variant-title'>Màu: " . $variantDetail->getColor() . "</span>";
                    if ($variantDetail->getWeight() != null && $variantDetail->getGrip() != null)
                        echo "<span class='variant-title'>Bản: " . ($variantDetail->getWeight() . ' ' . $variantDetail->getGrip()) . "</span>";
                    if ($variantDetail->getSize() != null)
                        echo "<span class='variant-title'>Size: " . $variantDetail->getSize() . "</span>";
                    if ($variantDetail->getSpeed() != null)
                        echo "<span class='variant-title'>Tốc độ: " . $variantDetail->getSpeed() . "</span>";
                    echo "
                                                                </div>
                                                                <div class='grid'>
                                                                    <div class='cart-item-name'>
                                                                        <div class='input-group-btn'>
                                                                            <button class='qty-minus' onclick='var result = document.getElementById(\"qtym" . $product->getProductID() . '_' . $variantDetail->getVariantID() . "\"); var qtypro = parseInt(result.value); if (!isNaN(qtypro) && qtypro > 1) result.value = qtypro - 1; ChangeQuantityProductCart(" . $modelUser->getUIDByUserName($_SESSION['username']) . ", " . $product->getProductID() . "," . $variantDetail->getVariantID() . ", qtypro - 1); return false;' type='button'>-</button>
                                                                            <input type='text' id='qtym" . $product->getProductID() . '_' . $variantDetail->getVariantID() . "' name='so_luong' value='" . $cartDetail->getQuantity() . "' maxlength='3' class='in' onkeypress='if (isNaN(this.value + String.fromCharCode(event.keyCode))) return false;' onchange='if(this.value == 0) this.value=1;'>
                                                                            <button class='qty-plus' onclick='var result = document.getElementById(\"qtym" . $product->getProductID() . '_' . $variantDetail->getVariantID() . "\"); var qtypro = parseInt(result.value); if (!isNaN(qtypro)) result.value = qtypro + 1; ChangeQuantityProductCart(" . $modelUser->getUIDByUserName($_SESSION['username']) . ", " . $product->getProductID() . "," . $variantDetail->getVariantID() . ", qtypro + 1); return false;' type='button'><span>+</span></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class='cart-prices'>
                                                                        <span class='cart-price'>" . number_format($product->getPrice(), 0, '.', '.') . "₫</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div></div>";
                }
            }
            ?>

        </div>
    </div>
    <div class="ajaxcart-footer">
        <div class="ajaxcart-subtotal">
            <div class="cart-subtotal">
                <div class="cart-col-6">Tổng tiền:</div>
                <div class="text-right cart-totle"><span class="total-price"><?php if (isset($_SESSION['username']))
                    echo number_format($modelCartDetail->getTotalPriceCart($modelUser->getUIDByUserName($_SESSION['username'])), 0, '.', '.');
                else
                    echo "0" ?>₫</span></div>
                </div>
            </div>
            <div class="cart-btn-proceed-checkout-dt ">
                <button onclick="location.href='../View/user/pages/payment_page.php'" type="button"
                    class="button btn btn-default cart-btn-proceed-checkout" id="btn-proceed-checkout"
                    title="Thanh toán">Đặt hàng</button>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var searchInput = document.getElementById('search_text');
        var result = [];
        searchInput.addEventListener('input', function () {
            searchProduct(this);
        });

        searchInput.addEventListener('click', function () {
            searchProduct(this);
        });

        function searchProduct(c) {
            var keyword = c.value.trim();

            if (keyword !== '') {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var products = JSON.parse(this.responseText);
                        displayProductNames(products, keyword);
                    }
                };
                xhttp.open("GET", "search_products.php", true);
                xhttp.send();
            } else {
                hideProductNames();
            }
        }

        function hideProductNames() {
            var searchList = document.getElementById('searchList');
            searchList.style.display = 'none';
        }

        function displayProductNames(products, keyword) {
            var searchList = document.getElementById('searchList');
            searchList.innerHTML = '';

            var filteredProducts = products.filter(function (product) {
                return product.name.toLowerCase().includes(keyword.toLowerCase());
            });

            result = filteredProducts;

            var maxResults = 5;
            for (var i = 0; i < filteredProducts.length && i < maxResults; i++) {
                var li = document.createElement('li');
                var link = document.createElement('a');
                link.textContent = `${filteredProducts[i].name} - Giá: ${filteredProducts[i].price}`;
                link.href = "index.php?control=ProductDetail&productID=" + filteredProducts[i].productID;
                li.appendChild(link);
                searchList.appendChild(li);
            }

            if (filteredProducts.length > 0) {
                searchList.style.display = 'block';
                var li = document.createElement('li');
                var link = document.createElement('a');
                link.textContent = 'Xem tất cả';
                link.href = "index.php?control=ProductCategory&search=" + keyword;
                link.style.fontWeight = 'bold';
                link.style.textDecoration = 'underline';
                li.appendChild(link);
                searchList.appendChild(li);
            } else {
                searchList.style.display = 'none';
            }
            if (products == null) {
                searchList.style.display = 'none';
            }
        }



        // Ẩn dropdown khi click ra ngoài ô search
        document.addEventListener('click', function (e) {
            if (!document.getElementById('searchList').contains(e.target) && !document.getElementById('search_box').contains(e.target)) {
                hideProductNames();
            } else {

            }
        });

        function showTarget() {
            var targetElement = document.querySelector('.popup-cart');

            var siuElement = document.getElementById('hover-cart');
            var targetElement = document.querySelector('.popup-cart');
            var siuRect = siuElement.getBoundingClientRect();
            var windowWidth = window.innerWidth;

            if (windowWidth <= 1300) {

            } else {
                targetElement.style.display = 'block';
                targetElement.style.position = 'absolute';
                targetElement.style.top = siuRect.top + 45 + 'px';
                targetElement.style.left = (siuRect.right - 360) + 'px';
            }
        }

        function hideTarget() {
            var targetElement = document.querySelector('.popup-cart');
            targetElement.style.display = 'none';
        }
    </script>