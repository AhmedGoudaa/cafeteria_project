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
    
    
}
