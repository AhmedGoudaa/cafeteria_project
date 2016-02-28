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
        $result = mysqli_query($conn, $sql." order by u.id");
        $num_results = mysqli_num_rows($result);
        $users = array();
        for ($i = 0; $i < $num_results; $i++) {
            $users[] = mysqli_fetch_assoc($result);
        }
        return $users;
    }

}
