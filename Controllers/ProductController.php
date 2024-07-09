<?php
    require_once '..\Model\ModelProduct.php';
    //require_once '..\Controllers\TransactionController.php';

    class ProductController {
        private $modelProduct;

        public function __construct()
        {
            $this->modelProduct = new ModelProduct();
        }

        public function getProductByCode($ProductID){
            echo json_encode($this->modelProduct->getProductByCode($ProductID));
        }

        // public function getProductByID($ProductID){
        //     echo json_encode($this->modelProduct->getProductByCode($ProductID));
        // }

    }

    $order2 = new ProductController();
    $action = $_POST['action'];

    switch ($action) {
        case 'findProCode':
            $ProductID = $_POST['ProductID'];
            $order2->getProductByCode($ProductID);
            break; 
        default:
            break;
        }
?>
