<?php

class ProductModel extends Database {

    public $id;
    public $name;
    public $price;
    public $cat_id;
    public $photo;
    public $availability;
    
    public $columns_names = array('name', 'price', 'cat_id', 'photo', 'availability');

    public function __construct() {
        $this->table = "product";
    }
    

}
