<?php 
    session_start();
    require_once(__DIR__ . '/../Model/ModelUser.php');
    require_once(__DIR__ . '/../Model/ModelRole.php');
    require_once(__DIR__ . '/../Model/ModelCart.php');
    require_once(__DIR__ . '/../Model/ModelCartDetail.php');
    require_once(__DIR__ . '/../Model/Entity/CartDetail.php');
    if(isset($_POST['action'])) {
        $modeluser = new ModelUser();
        $modelrole = new ModelRole();
        $modelCart = new ModelCart();
        $modelrole = new ModelRole();
        if($_POST['action'] == 'signin') {
            if(isset($_POST['username']) && isset($_POST['password'])) {     
                $username = $_POST['username'];
                $password = $_POST['password'];
                if(!empty($username) && !empty($password)) {
                    $authenticated_user = $modeluser->authenticate($username, $password);
                    if($authenticated_user){ 
                        $authenticated_role = $modeluser->getRoleUsetByID($modeluser->getUIDByUserName($username)); 
                        if($authenticated_role == 4){
                            $_SESSION['login'] = true;
                            $_SESSION['type'] = 'user';
                            $_SESSION['username'] = $username;
                            echo json_encode(array(
                                'message' => "Đăng nhập thành công - tester",
                                'status' => 4
                            ));
                            exit;   
                        }
                        else{
                            $_SESSION['login'] = true;
                            $_SESSION['type'] = 'admin';
                            $_SESSION['username'] = $username;
                            echo json_encode(array(
                                'message' => "Đăng nhập thành công - admin",
                                'status' => 1
                            ));
                            exit;    
                        } 
                     
                       
                    } else {
                        echo json_encode(array(
                            'message' => "Tên người dùng hoặc mật khẩu không chính xác!",
                            'status' => 0
                        ));
                        exit;
                    }

                } 
            }
        } 
        else if($_POST['action'] == 'infor-user'){
            if(isset($_POST['formName']) && isset($_POST['formPassword']) && isset($_POST['formPhone']) && isset($_POST['formEmail'])) {
                $username = $_POST['formName'];
                $password = $_POST['formPassword'];
                $phone = $_POST['formPhone'];
                $email = $_POST['formEmail'];
                if(!empty($username) && !empty($password) && !empty($phone) && !empty($email)) {
                    $checkError = false;
                    if($modeluser->checkExistingUsername($username)!=false|| $modeluser->checkExistingEmail($email)!=false || $modeluser->checkPhoneNumberFormat($phone)==false) {
                        $checkError = true;
                    }
                    if(!$checkError){ 
                        $usernameold = $_SESSION['username'];
                        $update_user = $modeluser->updateUser($modeluser->getUIDByUserName($usernameold),$username, $password, 4, $username, $email, $phone, 0, 'normal', 1);
                        $_SESSION['username'] = $username;
                        echo json_encode(array(
                            'message' => "Sửa thông tin thành công",
                            'status' => 1
                        ));
                        exit;
                    }
                }
            }
        }
        
        else{
            if(isset($_POST['formName']) && isset($_POST['formPassword']) && isset($_POST['formPhone']) && isset($_POST['formEmail'])) {
                $username = $_POST['formName'];
                $password = $_POST['formPassword'];
                $phone = $_POST['formPhone'];
                $email = $_POST['formEmail'];
                if(!empty($username) && !empty($password) && !empty($phone) && !empty($email)) {
                    $checkError = false;
                    if($modeluser->checkExistingUsername($username)!=false|| $modeluser->checkExistingEmail($email)!=false || $modeluser->checkPhoneNumberFormat($phone)==false) {
                        $checkError = true;
                    }
                    if(!$checkError){ 
                        $add_user = $modeluser->addUser($username, $password, 4, $username, $email, $phone, 0, 'normal', 1);
                        if ($add_user == 1) {
                            $datetime = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                            $time = $datetime->format('Y-m-d H:i:s');
                           /*  $now = new DateTime(); // Tạo một đối tượng DateTime đại diện cho thời gian hiện tại
                            $currentDateTime = $now->format('Y-m-d H:i:s'); // Format thời gian theo định dạng mong muốn */
                            $modelCart->addCart($modeluser->getUIDByUserName($username),$time );
                            $_SESSION['login'] = true;
                            $_SESSION['type'] = 'user';
                            $_SESSION['username'] = $username;
                            echo json_encode(array(
                                'message' => "Đăng kí thành công",
                                'status' => 1
                            ));
                            exit;
                        } else {
                            echo json_encode(array(
                                'message' => "Có lỗi trong quá trình thêm cơ sở dữ liệu",
                                'status' => 0
                            ));
                            exit;
                        }
                    }
                }
            }
            
                
            
/*            else{
                echo json_encode(array(
                    'message' => "Lỗi POST data form",
                    'status' => 0
                ));
            } */
        
            }
    }    
    ?>
    