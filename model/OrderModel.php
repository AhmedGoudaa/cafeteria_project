<?php

class OrderModel extends Database {



    public $id;
    public $user_id;
    public $room_id;
    public $order_date;
    public $notes;
    public $status;
    public $total_price;
    
    public $columns_names = array('user_id', 'room_id', 'order_date', 'notes','status','total_price');

    public function __construct() {
        $this->table = "`order`";
    }
    

    public function check(){

       global $conn;

       $this->notes = $conn->real_escape_string($this->notes);

       //return  $this->notes;


     }

/////////
 public function allOrders() {
        global $conn;
        
        $sql="SELECT  id,user_id,order_date  , total_price from  `order` where status <>'processing' ; ";
        $res= mysqli_query($conn, $sql);
//      print_r( $res);
//      echo '<br/>';
       return $res;
    }
    public function userOrders($user_id) {
        global $conn;
        
        $sql="SELECT  id,order_date,user_id , status , total_price from  `order` WHERE user_id ={$user_id}  ; ";
        $res= mysqli_query($conn, $sql);
//      print_r( $res);
//      echo '<br/>';
       return $res;
    }
      public function usersOrdersByDate($from,$to) {
        global $conn;
        
        $sql='SELECT  id,order_date,user_id , status , total_price from  `order` WHERE  status <>"processing" and order_date BETWEEN "'.$from.'" AND "'.$to.'"';
//        echo $sql;
//        echo '<br/>';
        $res= mysqli_query($conn, $sql);
//      print_r( $res);
//      echo '<br/>';
       return $res;
    }
    public function updateProOrderToOute($id) {
        global $conn;
        $sql='UPDATE `order` SET `status`="out of delivery" WHERE id='.$id;
//        echo $sql;
//        echo '<br/>';
        $res= mysqli_query($conn, $sql);
//        print_r( $res);
        echo '<br/>';
//         return $res;
        
    }
    public function ordersDetails($user_id) {
        global $conn;

        $sql="SELECT  o.id, od.quantity,
                p.id AS product_id,p.name, p.photo,p.price
        FROM   cafeteria.order o, cafeteria.order_details od,cafeteria.product p 
              WHERE  p.id = od.product_id AND  o.id = od.order_id AND  o.user_id ={$user_id} ;";   
        $res= mysqli_query($conn, $sql);
//               print_r( $res);
       return $res;
    }
    public function deleteOrder($orderId) {
        global $conn;

        $sql="DELETE FROM cafeteria.order WHERE id={$orderId} ;";   
        $res= mysqli_query($conn, $sql);
        
    }
     public function allOrdersDetails() {
        global $conn;

        $sql="SELECT  o.id, od.quantity,
                p.id AS product_id,p.name, p.photo,p.price
        FROM   cafeteria.order o, cafeteria.order_details od,cafeteria.product p 
              WHERE  p.id = od.product_id AND  o.id = od.order_id  ;";   
        $res= mysqli_query($conn, $sql);
       return $res;
    }
    public function total($user_id) {
        global $conn;
        
        $sql="SELECT sum(total_price ) as total from `order` WHERE user_id={$user_id} ; ";
        $res= mysqli_query($conn, $sql);
//        print_r($res);
        $row = mysqli_fetch_row($res);
        $total = $row[0];
       return $total;
    }
    
       public function userOrdersPluse($user_id,$from,$to) {
        global $conn;
        
        $sql='SELECT  id,order_date , status , total_price from  `order` WHERE user_id ='.$user_id.'  AND order_date BETWEEN "'.$from.'" AND "'.$to.'"'; 
//        echo $sql;
        $res= mysqli_query($conn, $sql);
//      print_r( $res);
//      echo '<br/>';
       return $res;
    }
    public function ordersDetailsPluse($user_id,$from,$to) {
        global $conn;

        $sql='SELECT  o.id, od.quantity,
                p.id AS product_id,p.name, p.photo,p.price
        FROM   cafeteria.order o, cafeteria.order_details od,cafeteria.product p 
              WHERE  p.id = od.product_id AND  o.id = od.order_id AND  o.user_id ='.$user_id.'  AND order_date BETWEEN "'.$from.'" AND "'.$to.'"';    
        $res= mysqli_query($conn, $sql);
//               print_r( $res);
       return $res;
    }
    public function totalPluse($user_id,$from,$to) {
        global $conn;
        
        $sql='SELECT sum(total_price ) as total from `order` WHERE user_id='.$user_id.'  AND order_date BETWEEN "'.$from.'" AND "'.$to.'"'; 
        $res= mysqli_query($conn, $sql);
//        print_r($res);
        $row = mysqli_fetch_row($res);
        $total = $row[0];
       return $total;
    }
      public function processingOrders() {
        global $conn;
        $sql='SELECT o.id , o.order_date,o.total_price , concat_ws(" ",u.fname, u.lname)as name , r.room_no , u.ext FROM cafeteria.user u INNER JOIN cafeteria.order o on u.id=o.user_id INNER join room r on r.id=o.room_id WHERE o.status="processing"'; 
        $res= mysqli_query($conn, $sql); 
//        print_r($res);
//        echo '<br/>';
       return $res;
    }
     public function processingOrdersDetail() {
        global $conn;
        $sql='SELECT  o.id as orderId, od.quantity,
                p.id AS product_id,p.name, p.photo,p.price
                FROM   cafeteria.order o, cafeteria.order_details od,cafeteria.product p 
                WHERE  p.id = od.product_id AND  o.id = od.order_id AND o.status="processing" '; 
        $res= mysqli_query($conn, $sql);  
//        print_r($res);
       return $res;
    }
    
    
    
    
    
    
}
