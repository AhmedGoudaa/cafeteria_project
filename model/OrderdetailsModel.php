<?php

class OrderdetailsModel extends Database {



    public $product_id;
    public $order_id;
    public $quantity;
    public $orderdetails;
    public $user_ID;
    
    public $columns_names = "(order_id , product_id , quantity)";

    public function __construct() {
        $this->table = "order_details";
    }


    public function insertMultiple(){

       global $conn;

       $sql = "INSERT INTO " . $this->table ." ".$this->columns_names."  VALUES " . $this->orderdetails;


       if (mysqli_query($conn, $sql)) {
          // echo "New record created successfully";
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
       }

       // mysqli_close($conn);


     }



    public function selectJoin(){

       global $conn;

       $sql = "SELECT od. product_id,o.user_id,p.name,p.photo,p.price FROM cafeteria.order_details od INNER JOIN cafeteria.order o on od.order_id=o.id INNER JOIN cafeteria.product p ON p.id=od.product_id where o.user_id=".$this->user_ID." GROUP BY od. product_id ORDER BY COUNT(*) DESC LIMIT 3;";


       if ($res = mysqli_query($conn, $sql)) {
          // echo "New record created successfully";
        return $res ;
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
       }

       // mysqli_close($conn);


     }


    
    
}

