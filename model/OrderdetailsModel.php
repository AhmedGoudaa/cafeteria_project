<?php

class OrderdetailsModel extends Database {



    public $product_id;
    public $order_id;
    public $quantity;
    public $orderdetails;
    
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

    
    
}
