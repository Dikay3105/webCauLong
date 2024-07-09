<div id = "main">
    <?php 

        if(isset($_GET['control'])){
            $tmp = $_GET['control'];
        }
        else $tmp = '';
        if($tmp=='ProductCategory'){
            include("../View/user/pages/product_page.php");
        }
        else if($tmp=='SaleOffCategory'){
            include("../View/user/pages/saleOff_page.php");
        }
        else if($tmp=='IntroduceCategory'){
            include("../View/user/pages/intro_page.php");
        }
        else if($tmp=='ContactCategory'){
            include("../View/user/pages/contact_page.php");
        }
        else if($tmp=='checkDonHang'){
            include("../View/user/pages/orderTransaction_page.php");
        }
        else if($tmp=='DetailOrder'){
            include("../View/user/pages/detailTransaction_page.php");
        }
        else if($tmp=='ProductDetail'){
            include("../View/user/pages/product_detail.php");
        } else if($tmp=='Cart'){
            include("../View/user/pages/cart_page.php");
        }
        else{
            include("../View/user/pages/home_page.php");
        }
        echo '
        <div class="back-to-top" onclick="scrollToTop()">
            <a class="" href="#"><i class="fa-solid fa-arrow-up back-top-top-icon" style="color: #ffffff;"></i></a>
        </div>'
    ?>
        

</div>
<!-- Đăng nhập vào admin -->
<?php
     if (isset($_SESSION['login']) && $_SESSION['type'] == 'admin') 
    {
         echo '<script>window.location.href = "Badminton_Admin.php";</script>';
    } 
?>

<?php 
        if(isset($_GET['control'])){
            $tmp = $_GET['control'];
        }
        else $tmp = '';
        if($tmp=='signup'){
            include("../View/user/pages/signup.php");
        }
        else if($tmp=='signin'){
            include("../View/user/pages/signin.php");
        }
        else if($tmp=='infor-user'){
            include("../View/user/pages/infor_user.php");        
        }
        else if($tmp=='logout'){
            //Neu nguoi dung da dang nhap thanh cong, thi huy bien session
            if (isset($_SESSION['login'])) 
            {
                unset($_SESSION['login']);
                unset($_SESSION['username']);
                unset($_SESSION['type']);
            }
            echo '<script>window.location.href = "index.php";</script>';
        }

        /*require_once(__DIR__ . '/../Model/ModelUser.php');
        $modeluser = new ModelUser();
        $add_user = $modeluser->addUser(1, 111, 1, 111, "a@gmail.com", "0364985452", 0, 'normal', 1);
        echo $add_user;
        require_once(__DIR__ . '/../Model/check-email.php');*/
    ?>
        <?php 
            /*session_start(); // Đảm bảo session đã được khởi tạo*/
            require_once('../Model/ModelUser.php');

            // Kiểm tra và gán giá trị cho $_SESSION['username']
            $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
            
            // Truy vấn thông tin người dùng từ cơ sở dữ liệu
            if (!empty($username)) {
                $modeluser = new ModelUser();
                $user = $modeluser->getUserByUsername($username);
            }
            
    ?>