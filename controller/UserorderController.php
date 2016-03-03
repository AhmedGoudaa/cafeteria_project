<?php
class UserorderController{
    public function index() {
        
 
      if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->commanfn();
            
            
        }
        elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['orderId'])) {
                $orderId=$_POST['orderId'];
                $order = new OrderModel();
                $order->deleteOrder($orderId);
                $this->commanfn();
                
                
            }else{
            $from=$_POST['datefrom']." 12:00 AM";
            $to=$_POST['dateto']." 11:59 PM";
            //echo  $from.',,,,,'.$to."<br/>";
            $from  = DATE(" Y-m-d H:i:s " , STRTOTIME($from));
            $to  = DATE(" Y-m-d H:i:s " , STRTOTIME($to));          
            //echo $from.",,".$to;
             $order = new OrderModel();

//           $user_id=$_SESSION["user_id"];
             $user_id=1;
             
            $result1 = $order->userOrdersPluse($user_id,$from,$to);
            $result2 = $order->ordersDetailsPluse($user_id,$from,$to);
            $total = $order->totalPluse($user_id,$from,$to);
           // print_r($result);
            $num_results = mysqli_num_rows($result1);
            $orders = array();
            for ($i = 0; $i < $num_results; $i++) {
                $orders[] = mysqli_fetch_assoc($result1);
            }
             $num_results = mysqli_num_rows($result2);
            $ordersdetails = array();
            
            for ($i = 0; $i < $num_results; $i++) {
                $ordersdetails[] = mysqli_fetch_assoc($result2);
            }


            $row = array("orders" => $orders,"ordersdetails"=>$ordersdetails,"total"=>$total);


            $template = new Template();
            $template->render("userorders/filter.php", $row);
        }
        }
    }
    public function commanfn() {
        $order = new OrderModel();

           $user_id=1;
            $result1 = $order->userOrders($user_id);
            $result2 = $order->ordersDetails($user_id);
            $total = $order->total($user_id);
           // print_r($result);
            $num_results = mysqli_num_rows($result1);
            $orders = array();
            for ($i = 0; $i < $num_results; $i++) {
                $orders[] = mysqli_fetch_assoc($result1);
            }
             $num_results = mysqli_num_rows($result2);
            $ordersdetails = array();
            for ($i = 0; $i < $num_results; $i++) {
                $ordersdetails[] = mysqli_fetch_assoc($result2);
            }


            $row = array("orders" => $orders,"ordersdetails"=>$ordersdetails,"total"=>$total);


            $template = new Template();
            $template->render("userorders/index.php", $row);
            
        
    }
    
    function update(){
          $order = new OrderModel();

           $user_id=1;
            $result1 = $order->userOrders($user_id);
            $result2 = $order->ordersDetails($user_id);
            $total = $order->total($user_id);
           // print_r($result);
            $num_results = mysqli_num_rows($result1);
            $orders = array();
            for ($i = 0; $i < $num_results; $i++) {
                $orders[] = mysqli_fetch_assoc($result1);
            }
             $num_results = mysqli_num_rows($result2);
            $ordersdetails = array();
            for ($i = 0; $i < $num_results; $i++) {
                $ordersdetails[] = mysqli_fetch_assoc($result2);
            }
 $row = array("orders" => $orders,"ordersdetails"=>$ordersdetails,"total"=>$total);
        
               echo json_encode(array("status" => "success", "insertData" => $row));
        
        
    }
    
    
}