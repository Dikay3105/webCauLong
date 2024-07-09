<?php
    require_once '..\Model\ModelTransaction.php';
    
    class TransactionController {
        private $modelTransaction;

        public function __construct()
        {
            $this->modelTransaction = new ModelTransaction();
        }

        public function getAllTransactions() {
            echo json_encode($this->modelTransaction->getAllTransactions());
        }

        public function getTransactionByID($TransactionID){
            echo json_encode($this->modelTransaction->getTransactionByID($TransactionID));
        }

        public function deleteHoaDon($status,$id) {
            $check = $this->modelTransaction->getTransaction($id);
            if($check['status'] == 0){
                echo $this->modelTransaction->deleteHoaDon(1,$id);
            } else if($check['status'] == 1){
                echo $this->modelTransaction->deleteHoaDon(0,$id);
            }
        }

        public function getTransaction($id) {
            echo json_encode($this->modelTransaction->getTransaction($id));
        }

        public function getTransactionByCustomer($ma_kh, $search) {
            echo json_encode($this->modelTransaction->getTransactionByCustomer($ma_kh, $search));
        }

        public function getAllTransactionByCustomer($ma_kh) {
            echo json_encode($this->modelTransaction->getAllTransactionByCustomer($ma_kh));
        }

        public function getTransactionByPhone($phoneNumber){
            echo json_encode($this->modelTransaction->getTransactionByPhone($phoneNumber));
        }

        public function getAllDeleteHoaDon() {
            echo json_encode($this->modelTransaction->getAllDeleteHoaDon());
        }

        public function addTransaction($userID, $total, $note,$time, $address, $name_receiver, $phone_receiver){
            echo json_encode($this->modelTransaction->addTransaction($userID, $total, $note,$time, $address, $name_receiver, $phone_receiver));
        }

    }

    $transactionctl = new TransactionController();
    // $action = $_POST['action'];
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

    switch ($action) {
        case 'get-all':
            $transactionctl->getAllTransactions();
            break;
        case 'findPhone':
            $phoneNumber = $_POST['phoneNumber'];
            $transactionctl->getTransactionByPhone($phoneNumber);
            break; 
        case 'get':
            $id = $_POST['id'];
            $transactionctl->getTransaction($id);
            break;
        case 'get-customer-order':
            $ma_kh = $_GET['ma_kh'];
            $search = $_GET['search'];
            $transactionctl->getTransactionByCustomer($ma_kh, $search);
            break;
        case 'get-all-customer-order':
            $ma_kh = $_GET['ma_kh'];
            $transactionctl->getAllTransactionByCustomer($ma_kh);
            break;
        case 'delete':
            $status = $POST['status'];
            $id = $_POST['id'];
            $transactionctl->deleteHoaDon($status,$id);
            break;
        case 'list-delete':
            $transactionctl->getAllDeleteHoaDon();
            break;
        case "add":
                $userID = $_POST['user'];
                $total = $_POST['total'];
                $note = $_POST['notes'];
                $address = $_POST['address'];
                $name_receiver = $_POST['fullname'];
                $phone_receiver = $_POST['phone'];
                $datetime = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                $time = $datetime->format('Y-m-d H:i:s');
                $transactionctl->addTransaction($userID, $total, $note, $time, $address, $name_receiver, $phone_receiver);
                break;
            
        default:
            break;
        }
?>
