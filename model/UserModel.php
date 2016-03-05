<?php

class UserModel extends Database {

    public $id;
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $room_id;
    public $picture;
    public $ext;
    public $type;
    public $columns_names = array('fname', 'lname', 'email', 'password', 'room_id', 'picture', 'ext', 'type');

    public function __construct() {
        $this->table = "user";
    }

    function selectUserAndRoom($id = null) {
        global $conn;
        if (!$id) {
            $sql = "SELECT u.*,r.room_no FROM user u, room r WHERE u.room_id = r.id";
        } else {
            $sql = "SELECT u.*,r.room_no FROM user u, room r WHERE u.room_id = r.id and u.id =" . $id;
        }
        $result = mysqli_query($conn, $sql . " order by u.id");
        $num_results = mysqli_num_rows($result);
        $users = array();
        for ($i = 0; $i < $num_results; $i++) {
            $users[] = mysqli_fetch_assoc($result);
        }
        return $users;
    }

    function checkExistence($email) {
        global $conn;
        $sql = "SELECT email FROM user WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $num_results = mysqli_num_rows($result);
        if ($num_results > 0) {
            return true;
        }
        return false;
    }

    function checkLogin($email, $password) {
        global $conn;
        $sql = "SELECT * FROM user WHERE email = '$email' and password = md5('$password')";
        $result = mysqli_query($conn, $sql);
        $num_results = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($num_results > 0) {
            return $row;
        } else {
            return false;
        }
    }


    public function usersTotalOrders() {
        global $conn;
        
        $sql='  SELECT  concat_ws(" ",user.fname,user.lname ) AS user_name ,user.id,sum(order.total_price)as total
            FROM cafeteria.user INNER JOIN cafeteria.order on cafeteria.user.id=cafeteria.order.user_id  WHERE cafeteria.order.status <>"processing"
            GROUP BY user.id,user_name; ';
        $res= mysqli_query($conn, $sql);

       return $res;
    }
     public function usersTotalOrdersbyDate($from,$to) {
        global $conn;
        
        $sql='SELECT  concat_ws(" ",user.fname,user.lname ) AS user_name ,user.id,sum(order.total_price)as total
            FROM cafeteria.user INNER JOIN cafeteria.order ON cafeteria.user.id=cafeteria.order.user_id  WHERE cafeteria.order.status <>"processing" AND
            cafeteria.order.order_date BETWEEN "'.$from.'" AND "'.$to.'" GROUP BY user.id; ';
        $res= mysqli_query($conn, $sql);

       return $res;
    }
    public function getAllUsers() {
         global $conn;
        $sql='SELECT id,concat_ws(" ",fname, lname)as name FROM cafeteria.user ;';
        $res= mysqli_query($conn, $sql);
       return $res;
        
    }
    public function getUserOrders($id) {
        global $conn;
        $sql="  SELECT  concat_ws(' ',user.fname,user.lname ) AS user_name ,user.id,sum(order.total_price)as total
            FROM cafeteria.user INNER JOIN cafeteria.order ON cafeteria.user.id=cafeteria.order.user_id  WHERE cafeteria.order.status <>'processing'
            and cafeteria.user.id={$id} GROUP BY cafeteria.user.id;";
        $res= mysqli_query($conn, $sql);
       return $res;
       
     
    }

}
