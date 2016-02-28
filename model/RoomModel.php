<?php

class RoomModel extends Database{


    public $id;
    public $room_no;

    
    public $columns_names = array('id', 'room_name');

    public function __construct() {
        $this->table = "room";
    }

    
}
