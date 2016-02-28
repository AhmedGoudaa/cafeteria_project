<?php

class RoomModel extends Database{

    public $id;
    public $room_no;
    public $columns_names = array('room_no');

    public function __construct() {
        $this->table = "room";
    }

}
