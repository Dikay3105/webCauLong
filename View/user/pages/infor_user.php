<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .form-password {
            position: relative;
        }
        .fa-solid.fa-eye {
            color: #e95221; /* Màu sắc của icon */
            cursor: pointer; /* Đổi con trỏ chuột khi hover */
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            z-index: 1;
            font-size: 1.8rem;
        }
        .fa-solid.fa-eye-slash {
            color: #e95221; /* Màu sắc của icon */
            cursor: pointer; /* Đổi con trỏ chuột khi hover */
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            z-index: 1;
            font-size: 1.8rem;
        }
        .signin {
            background-color: #fff;
            border-radius: 10px;
            padding: 2rem; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 45%; 
            max-width: 35rem; 
            height: 80%;
        }
        .form-input {
            font-family: 'Poppins', sans-serif;
            color: black;
            padding: 1.5rem;
            border-radius: 1rem;
            outline: none;
            font-size: 1.6rem;
            font-weight: 500;
            border: 1px solid #eee; 
            background-color: #eee;
            transition: .25s linear;
            width: 100%;
            height: 10%;
        }
        .form-submit {
            border-radius: 10px;
            color: white;
            outline: none;
            padding: 1.5rem;
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            text-align: center;
            cursor: pointer;
            border: 0;
            width: 80%;
            background-color: #ed673a;
            margin-top: 0.3rem;
        }
        .signin-heading {
            font-size: 2.5rem;
            text-align: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    require_once __DIR__ . '../../../../Model/ModelUser.php';
    $modelUser = new ModelUser();
    $userData = $modelUser->getUserDataByUsername($username);
    if ($userData) {
        $name = $userData['name'];
        $phoneNumber = $userData['phoneNumber'];
        $email = $userData['mail'];
        $password = $userData['password'];
    } else {
        $name = 'Default Name';
        $phoneNumber = '';
        $email = '';
    }
    echo '
    <div id="sigin-background">
        <div class="signin" id="create">
            <a class="signin-icon" onclick="displaySignMenu(\'none\')"><i class="fa-solid fa-x"></i></a>
            <h2 class="signin-heading">THÔNG TIN TÀI KHOẢN</h2>
            <p class="signin-already" id="signin-already"> 
                <a href="index.php?control=signin" class="signin-link-underline" onclick="fdn()"></a>
            </p>
            <div class="error-signup"> <p class="error-message"></p> </div>
            <form id="infor-form" action="../Controllers/Signin-upController.php" method="post">
                <div class="form-user-name">
                    <input type="text" class="form-input" placeholder="Name" id="form-Name" name="formName" value="'.$name.'">
                </div>
                <div class="form-password">
                    <input type="password" class="form-input" placeholder="Password" id="form-Password" name="formPassword" value="'.$password.'">
                    <input type="text" class="form-input form-input-visible" placeholder="Password" id="form-Password-Visible" value="'.$password.'" style="display: none;">
                    <i class="fa-solid fa-eye" id="toggle-password" style="color: #e95221;"></i>
                </div>

                <div class="form-phone">
                    <input type="text" class="form-input" placeholder="Phone" id="form-Phone" name="formPhone" value="'.$phoneNumber.'">
                </div>
                <div class="form-email">
                    <input type="text" class="form-input" placeholder="E-mail" id="form-Email" name="formEmail" value="'.$email.'">
                </div>
                <div>
                    <button type="submit" class="form-submit">
                        <span class="form-submit-text">Cập nhật</span>             
                        <i class="fa fa-long-arrow-right form-submit-icon"></i>      
                    </button>
                </div>
                <input type="hidden" name="action" value="infor-user">
            </form>
        </div>
    </div>';
}
?>
    <script>
        document.getElementById("toggle-password").addEventListener("click", function() {
        var passwordField = document.getElementById("form-Password");
        var passwordVisibleField = document.getElementById("form-Password-Visible");

        if (passwordField.style.display === "none") {
            passwordField.style.display = "block";
            passwordVisibleField.style.display = "none";
            this.classList.remove("fa-eye-slash");
            this.classList.add("fa-eye");
        } else {
            passwordField.style.display = "none";
            passwordVisibleField.style.display = "block";
            this.classList.remove("fa-eye");
            this.classList.add("fa-eye-slash");
        }
});

    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js" defer></script>
    <script src="../js/infor_user.js" defer></script>
    <script src="../js/signin-up.js" defer></script>
</body>
</html>

    
      
