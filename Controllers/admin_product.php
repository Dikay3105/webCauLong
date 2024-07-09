<?php
require_once (__DIR__ . '/../Model/ModelProduct.php');
require_once (__DIR__ . '/../Model/ModelBrand.php');
require_once (__DIR__ . '/../Model/ModelCatalog.php');
require_once (__DIR__ . '/../Model/ModelVariantDetail.php');
require_once (__DIR__ . '/../Model/ModelVariant.php');
$modelBrand = new ModelBrand();
$modelCatalog = new ModelBrand();

function getImgList($productID) {
    $modelProduct = new ModelProduct();
    $product = $modelProduct->getProductByID($productID);
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
    //$imagePaths = array_values($result)[0];
    return $result;
}

function getVariant($productID, $color) {
    $modelVariant = new ModelVariant();
    $modelVariantDetail = new ModelVariantDetail();
    $listVariant = $modelVariant->getListVariantByProductID($productID);
    
    // Chuyển đổi danh sách các đối tượng Variant thành mảng các mảng kết hợp
    $variantArray = array();
    foreach ($listVariant as $variant) {
        $variantDetail = $modelVariantDetail->getVariantByID($variant->getVariantID());
        if($variantDetail->getColor()==$color) {
            $variantArray[] = array(
                'variantID' => $variant->getVariantID(), // Giả sử có phương thức getVariantID() để truy cập variantID
                'productID' => $variant->getProductID(), // Giả sử có phương thức getProductID() để truy cập productID
                //Thêm các thuộc tính khác nếu cần
            );
        }
        
    }
    
    // Trả về dữ liệu dưới dạng một mảng JSON
    return $variantArray;
}

function getVariantDetail($variantID) {
    $modelVariantDetail = new ModelVariantDetail();
    $variant = $modelVariantDetail->getVariantByID($variantID);
    
    $variantArray = array();
    if ($variant) {
        // Chuyển đổi đối tượng Variant thành một mảng kết hợp
        $variantArray[] = array(
            'variantID' => $variant->getVariantID(),
            'color' => $variant->getColor(),
            'size' => $variant->getSize(),
            'speed' => $variant->getSpeed(),
            'grip' => $variant->getGrip(),
            'weight' => $variant->getWeight(),
            'quantity' => $variant->getQuantity(),
            'list_image' => $variant->getListImage(),
            'status' => $variant->getStatus()
            //Thêm các thuộc tính khác nếu cần
        );
        // Trả về dữ liệu dưới dạng một mảng JSON
        return $variantArray;
    } else {
        // Trả về null nếu không tìm thấy variant
        return null;
    }
}

function saveData($variantID, $grip, $weight, $speed, $size, $quantity) {
    $modelVariantDetail = new ModelVariantDetail();
    if($grip!="null") $modelVariantDetail->updateGrip($variantID,$grip);
    if($weight!="null") $modelVariantDetail->updateWeight($variantID,$weight);
    if($speed!="null") $modelVariantDetail->updateSpeed($variantID,$speed);
    if($size!="null") $modelVariantDetail->updateSize($variantID,$size);
    if($speed!="null") $modelVariantDetail->updateSize($variantID,$speed);
    $modelVariantDetail->updateQuantity($variantID,$quantity);
    
}


function delImg($productID, $imgIndex, $color) {
    $modelProduct = new ModelProduct();
    $product = $modelProduct->getProductByID($productID);
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

    // Xóa phần tử có giá trị imgIndex trong mảng có key color
    $colorKey = trim(($color));
    if (isset($result[$colorKey])) {
        $imageArray = $result[$colorKey];
        // Sử dụng array_filter để xóa tất cả phần tử có giá trị bằng imgIndex
        $imageArray = array_filter($imageArray, function($value) use ($imgIndex) {
            return $value != $imgIndex;
        });
        // Sắp xếp lại mảng để đảm bảo các chỉ số liên tiếp (nếu cần)
        $result[$colorKey] = array_values($imageArray);
    }

    // Tạo lại chuỗi URL từ mảng kết quả
    $newUrlArray = array();
    foreach ($result as $key => $values) {
        if (!empty($values)) { // Chỉ thêm vào nếu mảng không rỗng
            $newUrlArray[] = $key . ":" . implode(",", $values);
        }
    }
    $newUrlString = implode(";", $newUrlArray);

    // Cập nhật lại URL của sản phẩm
    $product->setUrl($newUrlString);
    $modelProduct->updateUrlImgProduct($productID, $newUrlString);

    // Trả về chuỗi URL mới
    return $newUrlString;
}

function addImg($productID, $imageURLs, $color) {
    $modelProduct = new ModelProduct();
    $product = $modelProduct->getProductByID($productID);
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
            $result[trim($temp[0])] = explode(",", $temp[1]);
        }
    }

    $colorKey = trim($color);

    if (isset($result[$colorKey])) {
        $imageArray = $result[$colorKey];
    } else {
        $imageArray = [];
    }

    // Giải mã chuỗi JSON imageURLs thành một mảng
    $decodedImageURLs = json_decode($imageURLs, true);

    // Kiểm tra xem $decodedImageURLs có phải là một mảng hay không
    if (is_array($decodedImageURLs)) {
        // Thêm tất cả phần tử trong $decodedImageURLs vào mảng
        foreach ($decodedImageURLs as $imgIndex) {
            $imageArray[] = $imgIndex;
        }
    } else {
        // Xử lý lỗi nếu $decodedImageURLs không phải là mảng
        return "Invalid imageURLs";
    }

    // Cập nhật lại mảng con trong $result
    $result[$colorKey] = $imageArray;

    // Tạo lại chuỗi URL từ mảng kết quả
    $newUrlArray = array();
    foreach ($result as $key => $values) {
        if (!empty($values)) { // Chỉ thêm vào nếu mảng không rỗng
            $newUrlArray[] = $key . ":" . implode(",", $values);
        }
    }
    $newUrlString = implode(";", $newUrlArray);

    // Cập nhật lại URL của sản phẩm
    $product->setUrl($newUrlString);
    $modelProduct->updateUrlImgProduct($productID, $newUrlString);

    // Trả về chuỗi URL mới
    return $newUrlString;
}

if (isset($_GET['get'])) {
    if ($_GET['get']=='listImg') {
        if (isset($_GET['productID']))
            echo json_encode(getImgList($_GET['productID']));
    }
    else if ($_GET['get']=='delImg') {
        if (isset($_GET['productID']) && isset($_GET['imgDel']) && isset($_GET['color'])) {
            echo json_encode(delImg($_GET['productID'], $_GET['imgDel'], $_GET['color']));
        }
    } else if ($_GET['get']=='addImg') {
        if (isset($_GET['productID']) && isset($_GET['imageURLs']) && isset($_GET['color'])) {
            echo json_encode(addImg($_GET['productID'], $_GET['imageURLs'], $_GET['color']));
        }
    } else if ($_GET['get']=='variant') {
        if (isset($_GET['productID']) && isset($_GET['color'])) {
            echo json_encode(getVariant($_GET['productID'], $_GET['color']));
        }
    } else if ($_GET['get']=='variantdetail') {
        if (isset($_GET['variantID'])) {
            echo json_encode(getVariantDetail($_GET['variantID']));
        }
    } else if ($_GET['get']=='updatevariant') {
        if (isset($_GET['variantID'])) {
            saveData($_GET['variantID'], $_GET['grip'], $_GET['weight'], $_GET['speed'], $_GET['size'], $_GET['quantity']);
        }
    }
}
else {
    // Nếu không có dữ liệu được gửi, trả về một mảng trống dưới dạng chuỗi JSON
    echo json_encode([]);
}

?>