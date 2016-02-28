<?php

class Connection {

    public static $instance;
    public $conn;

    private function __construct() {
        @$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    }

    public static function startConnection() {
        if (self::$instance == null) {
            self::$instance = new Connection;
        }
        return self::$instance;
    }
    

}


//
//    
//    public static $conn=null;
//
//    private function __construct() {
//    die("");
//    }
//
//    public static function startConnection() {
//        if (self::$conn == null) {
//       self->$conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
//
////            self::$instance = new Connection;
//        }
//        return self::$conn;
//        
//        $istance->
//        
//        
//    }
