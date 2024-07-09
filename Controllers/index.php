<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web dụng cụ thể thao cầu lông</title>
    <link rel="stylesheet" href="../View/css/style.css">
    <link href="https://cdn.shopvnb.com/themes/css/breadcrumb_style.scss.css" rel="stylesheet" type="text/css" />
    <script src="../js/cart.js" defer></script>
    <script src="https://www.gstatic.com/firebasejs/9.21.0/firebase-app-compat.js"></script>

        <!-- Firebase Storage SDK -->
        <script src="https://www.gstatic.com/firebasejs/9.21.0/firebase-storage-compat.js"></script>

        <script>
            // Your web app's Firebase configuration
            const firebaseConfig = {
                apiKey: "AIzaSyBsTkEPMoozdFG1qh--RQ1C-gyS9BVFh-w",
                authDomain: "badmintonstorage.firebaseapp.com",
                projectId: "badmintonstorage",
                storageBucket: "badmintonstorage.appspot.com",
                messagingSenderId: "994483053776",
                appId: "1:994483053776:web:de728e8975b81077bfead5",
                measurementId: "G-XWX5PKEHP8"
            };

            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);
            const storage = firebase.storage();

            async function getPromiseUrl(filePath) {
                if (filePath=="" || filePath==null) {
                    alert('Please enter the file path');
                    return;
                }

                try {
                    const fileRef = storage.ref(filePath);
                    const url = await fileRef.getDownloadURL();
                    return url;
                } catch {
                    console.error('Error getting file URL:', error);
                    alert('Error getting file URL: ' + error.message);
                    return "";
                } 
                    
                
            }
/*
            function loadUrlImg(filePath) {
                var tmp;
                getPromiseUrl(filePath).then(url=>{
                    tmp = url;
                    console.log(tmp) ;
                }).catch(error=> {
                    return error;
                });
                return tmp;
            }*/

            function deleteFile() {
                const filePath = document.getElementById('filePath').value;
                if (!filePath) {
                    alert('Please enter the file path');
                    return;
                }

                // Create a reference to the file to delete
                const fileRef = storage.ref(filePath);

                // Delete the file
                fileRef.delete().then(() => {
                    console.log('File deleted successfully');
                    alert('File deleted successfully');
                }).catch((error) => {
                    console.error('Error deleting file:', error);
                    alert('Error deleting file: ' + error.message);
                });
            }

        </script>
        <?php
        session_start();
$total_price_cart = 0;
?>
    <?php
    if (isset($_GET['control'])) {
        if ($_GET['control'] == "ProductCategory") {
            echo '<link rel="stylesheet" href="../View/css/product_nav.css"> <script src="../js/nav.js" defer></script>';
        } else if ($_GET['control'] == "ProductDetail") {
            echo '<link rel="stylesheet" href="../View/css/product_detail.css"> <script src="../js/product_detail.js" defer></script>';
        } else if ($_GET['control'] == "checkDonHang") {
            echo '<link rel="stylesheet" href="../View/css/checktranscation.css">   <script type="text/javascript" src="../js/User.js"></script>
                                                                                    <script type="text/javascript" src="../js/OrderTransaction.js"></script>
                                                                                    <script type="text/javascript" src="../js/Transaction.js"></script>';
        } else if ($_GET['control'] == "DetailOrder") {
            echo '<script src="../js/Transaction.js"> defer</script> <link rel="stylesheet" href="../View/css/detail.css">';
        } else if ($_GET['control'] == "IntroduceCategory") {
            echo '<script src="../js/Introduce.js"> defer</script> <link rel="stylesheet" href="../View/css/intro.css">';
        } else if ($_GET['control'] == "Cart") {
            echo '<script src="../js/Cart.js"> defer</script>';
        } else if ($_GET['control'] == "ContactCategory") {
            echo '<link rel="stylesheet" href="../View/css/contact.css">';
        }

    } else {
        echo '<link rel="stylesheet" href="../View/css/slider.css"> <script src="../js/slider.js" defer></script>';
    }

    ?>
    <link rel="stylesheet" href="../View/css/style.css">
    <link rel="stylesheet" href="../View/css/homepage.css">
    <link rel="stylesheet" href="../View/css/footer.css">
    <link rel="stylesheet" href="../View/css/slider.css">
    <link rel="stylesheet" href="../View/css/signup-menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.shopvnb.com/themes/css/danh_muc_style.scss.css?v=16" rel="stylesheet" type="text/css" />
    <link rel="preload" as='style' type="text/css" href="https://cdn.shopvnb.com/themes/css/sidebar_style.scss.css">
    <link href="https://cdn.shopvnb.com/themes/css/sidebar_style.scss.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<div id="full-cover" style="cursor: pointer;">
    <header id="header">
        <?php include ("../View/user/header.php"); ?>
    </header>

    <body>
        <div class="wrapper" id="wrapper">
            <?php
            if (isset($_GET['control'])) {
                if ($_GET['control'] == "ProductCategory") {
                    include ("../View/user/bread-crumb.php");
                } else if ($_GET['control'] == "ProductDetail") {
                    include ("../View/user/bread-crumb.php");
                } else if ($_GET['control'] == "checkDonHang") {
                    include ("../View/user/bread-crumb.php");
                } else if ($_GET['control'] == "IntroduceCategory") {
                    include ("../View/user/bread-crumb.php");
                } else if ($_GET['control'] == "Cart") {
                    include ("../View/user/bread-crumb.php");
                } else if ($_GET['control'] == "ContactCategory") {
                    include ("../View/user/bread-crumb.php");
                }
            } else {

            }

            ?>
            <?php
            include ("../Controllers/main.php");
            include ("../View/user/footer.php");
            ?>
        </div>
        <script src="../js/backToHome-button.js" defer></script>
        <script src="../js/search-engine.js" defer></script>
        
    </body>
</div>

<?php if (isset($_GET['control']) && $_GET['control'] == "ProductDetail"): ?>
    <div id="popup-cart-mobile" class="popup-cart-mobile">
        <div class="header-popcart">
            <div class="top-cart-header">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" height="682.66669pt" viewBox="-21 -21 682.66669 682.66669"
                        width="682.66669pt">
                        <path
                            d="m322.820312 387.933594 279.949219-307.273438 36.957031 33.671875-314.339843 345.023438-171.363281-162.902344 34.453124-36.238281zm297.492188-178.867188-38.988281 42.929688c5.660156 21.734375 8.675781 44.523437 8.675781 68.003906 0 148.875-121.125 270-270 270s-270-121.125-270-270 121.125-270 270-270c68.96875 0 131.96875 26.007812 179.746094 68.710938l33.707031-37.113282c-58.761719-52.738281-133.886719-81.597656-213.453125-81.597656-85.472656 0-165.835938 33.285156-226.273438 93.726562-60.441406 60.4375-93.726562 140.800782-93.726562 226.273438s33.285156 165.835938 93.726562 226.273438c60.4375 60.441406 140.800782 93.726562 226.273438 93.726562s165.835938-33.285156 226.273438-93.726562c60.441406-60.4375 93.726562-140.800782 93.726562-226.273438 0-38.46875-6.761719-75.890625-19.6875-110.933594zm0 0">
                        </path>
                    </svg>
                    Thêm sản phẩm vào giỏ hàng thành công
                </span>
            </div>
            <div class="media-content bodycart-mobile">
                <div class="thumb-1x1" id="thumb-1x1"><img id="product-cart-img" src="" alt="Vợt cầu lông Yonex Nanoflare 700 Cyan - Xách tay">
                </div>
                <div class="body_content">
                    <h4 class="product-title" id="product-title">Vợt cầu lông Yonex Nanoflare 700 Cyan - Xách tay</h4>
                    <div class="product-new-price" id="product-new-price"><b>3.400.000 ₫</b><span>Size: 4U5</span></div>
                </div>
            </div>
            <a class="noti-cart-count" href="/gio-hang" title="Giỏ hàng"> Giỏ hàng của bạn hiện có <span
                    class="count_item_pr">2</span> sản phẩm </a>
            <a title="Đóng" class="cart_btn-close iconclose">
                <i onclick="removeActiveTab()" style="font-size: 20px; color: white;" class="fas fa-times"></i>
                <!-- Font Awesome icon -->
            </a>


            <div class="bottom-action">
                <div class="cart_btn-close tocontinued" onclick="location.reload();">
                    Tiếp tục mua hàng
                </div>
                <a href="index.php?control=Cart" class="checkout" title="Xem giỏ hàng">
                    Xem giỏ hàng
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

</html>