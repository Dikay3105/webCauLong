<?php
    require_once '..\Model\ModelUser.php';

    class UserController {
        private $modelUser;

        public function __construct()
        {
            $this->modelUser = new ModelUser();
        }
        
        public function getUIDByUserName($user) {
            echo json_encode($this->modelUser->getUIDByUserName($user));
        }
    
    }

    $acc = new ModelUser();
    // $action = $_POST['action'];
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

    switch ($action){
        case 'get':
            $user = $_POST['user'];
            echo json_encode($acc->getUIDByUserName($user));
            break;
        default:
            break;
    }
?>