<?php

class OrdersController{
    
    public function __construct() {
        if ($_SESSION['type'] == 0) {
            header("Location: " . BASE_URL . "errorHandler/index");
        }
    }
    
    public function index() {
        
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
       
            $this->commen();
            
            
            
        }elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $order = new OrderModel();
            $orderId=$_POST['orderId'];
            $order->updateProOrderToOute($orderId);
             $this->commen();
            
            
            
            
            
            
        }
    }
    public function commen() {
             $order = new OrderModel();
            
            $result1=$order->processingOrders();
             $num_results = mysqli_num_rows($result1);
//                           print_r($result1);
            $orders = array();
            for ($i = 0; $i < $num_results; $i++) {
                $orders[] = mysqli_fetch_assoc($result1);
            }
            $result2=$order->processingOrdersDetail();
             $num_results2 = mysqli_num_rows($result2);
            $proOrdersDetails = array();
            for ($i = 0; $i < $num_results2; $i++) {
                $proOrdersDetails[] = mysqli_fetch_assoc($result2);
            }
        $row = array( "orders" => $orders, "proOrdersDetails" => $proOrdersDetails);

//        
        $template = new Template();
        
        $template->render("orders/index.php",$row );
    }
    
    
    
    function update(){
        $order = new OrderModel();
            
            $result1=$order->processingOrders();
             $num_results = mysqli_num_rows($result1);
//                           print_r($result1);
            $orders = array();
            for ($i = 0; $i < $num_results; $i++) {
                $orders[] = mysqli_fetch_assoc($result1);
            }
            $result2=$order->processingOrdersDetail();
             $num_results2 = mysqli_num_rows($result2);
            $proOrdersDetails = array();
            for ($i = 0; $i < $num_results2; $i++) {
                $proOrdersDetails[] = mysqli_fetch_assoc($result2);
            }
        $row = array( "orders" => $orders, "proOrdersDetails" => $proOrdersDetails);

        
               echo json_encode(array("status" => "success", "insertData" => $row));
        
        
    }
    
    
}