<?php

class ProductModel extends Database {

    public $id;
    public $name;
    public $price;
    public $cat_id;
    public $photo;
    public $availability;

    public $searchString;
    
    public $columns_names = array('name', 'price', 'cat_id', 'photo', 'availability');

    public function __construct() {
        $this->table = "product";
    }
    




    public function selectSearch(){

       global $conn;

       //$this->searchString = $conn->real_escape_string($this->searchString);

       $sql = 'SELECT * FROM product WHERE name LIKE "%'.$this->searchString.'%" OR id LIKE "%'.$this->searchString.'%"';


       if ($res = mysqli_query($conn, $sql)) {
          // echo "New record created successfully";
        return $res ;
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($conn);
       }

       // mysqli_close($conn);


     }


    public function check(){

       global $conn;

       $this->searchString = $conn->real_escape_string($this->searchString);

       return  $this->searchString;


     }

}

