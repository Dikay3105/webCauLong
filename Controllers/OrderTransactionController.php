<?php
    require_once '..\Model\ModelOrderTransaction.php';

    class OrderTransactionController {
        private $modelOrderTransaction;

        public function __construct()
        {
            $this->modelOrderTransaction = new ModelOrderTransaction();
        }
        
        public function getAllOrderTransactions() {
            echo json_encode($this->modelOrderTransaction->getAllOrderTransactions());
        }
    
        public function getOrderTransactionByOrderID($orderID) {
            echo json_encode($this->modelOrderTransaction->getOrderTransactionByOrderID($orderID));
        }

        public function checkOrderDetail($id) {
            echo json_encode($this->modelOrderTransaction->checkOrderDetail($id));
        }

        public function addOrderTransaction($productID, $variantID, $total_amonut, $quantity){
            echo json_encode($this->modelOrderTransaction->addOrderTransaction($productID, $variantID, $total_amonut, $quantity));
        }
    }

    $CTHD = new ModelOrderTransaction();
    // $action = $_POST['action'];
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;

    switch ($action){
        case 'get-cthd':
            $ma_hd = $_POST['id_transaction'];
            echo json_encode($CTHD->getOrderTransactionByOrderID($ma_hd));
            break;
        case 'check-order':
            $ma_cthd = $_POST['id'];
            echo json_encode($CTHD->checkOrderDetail($ma_cthd));
            break;
        case "add-order":
            $productID = $_POST['proID'];
            $variantID = $_POST['varID'];
            $total_amonut = $_POST['total_amonut'];
            $quantity = $_POST['quantity'];
            $CTHD->addOrderTransaction($productID, $variantID, $total_amonut, $quantity);
            break;
        default:
            break;
    }
?>