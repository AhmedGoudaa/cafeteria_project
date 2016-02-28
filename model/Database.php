<?php

class Database {

    protected $columns_names;
    protected $table;
    public $data;
    public $condition;

    function getFields() {
        global $conn;
        $sql = array();
        foreach ($this->columns_names as $column) {
            $this->$column = mysqli_real_escape_string($conn, strip_tags(trim($this->$column)));
            $sql[] = $column . "='{$this->$column}'";
        }
        $sql = implode(",", $sql);
        return $sql;
    }

    public function getAllData() {
        global $conn;
        $result = $conn->query("select * from {$this->table}");
        return $result->fetch_array();
    }

    public function insert() {
        global $conn;
//        print_r("insert into {$this->table} set " . $this->getFields());die("===");
        return $conn->query("insert into {$this->table} set " . $this->getFields());
    }

    public function delete() {
        global $conn;
        $array_keys = array_keys($this->data);
        $array_keys = implode(",", $array_keys);

        $array_values = array_values($this->data);
        $array_values = implode(",", $array_values);

        $sql = "DELETE from " . $this->table . " where " . $array_keys . "=" . $array_values;

        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }

        mysqli_close($conn);
    }

    public function update() {

        global $conn;

        $arr_data = array();

        $array_keys = array_keys($this->data);

        $array_values = array_values($this->data);

        foreach ($this->data as $key => $value) {
            $value = strip_tags(trim($value));
            array_push($arr_data, $key . "=" . $value, " , ");
        }
        array_pop($arr_data);

        $arr_data = implode(" ", $arr_data);

        $condition_keys = array_keys($this->condition);
        $condition_keys = implode(",", $condition_keys);

        $condition_values = array_values($this->condition);
        $condition_values = implode(",", $condition_values);


        $sql = "UPDATE " . $this->table . " SET " . $arr_data . " WHERE " . $condition_keys . "=" . $condition_values;
//        print_r($sql);die("==");
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            return false;
        }
        mysqli_close($conn);
    }

    public function select() {

        global $conn;

        if ($this->data === 'all' && $this->condition == 'no') {

            $sql = "SELECT * from $this->table";
        } elseif ($this->data === 'all') {

            $condition_keys = array_keys($this->condition);
            $condition_keys = implode(",", $condition_keys);

            $condition_values = array_values($this->condition);
            $condition_values = implode(",", $condition_values);

            $sql = "SELECT * from $this->table where " . $condition_keys . "=" . $condition_values;
        } else {


            $this->data = implode(",", $this->data);

            $condition_keys = array_keys($this->condition);
            $condition_keys = implode(",", $condition_keys);

            $condition_values = array_values($this->condition);
            $condition_values = implode(",", $condition_values);

            $sql = "SELECT $this->data from $this->table where " . $condition_keys . "=" . $condition_values;
        }

        if (mysqli_query($conn, $sql)) {
            return mysqli_query($conn, $sql);
        } else {
            return false;
        }

        mysqli_close($conn);
    }

}
//$arr=array('fname' => "'Forest'", 'lname' => "'River'", 'email' => "'Sky'",'password' => "'54321'", 'room_id' => "'2342'", 'picture' => "'Sky'",'ext' => "'32'");
////$arr=array('fname' => "'Forest'");
//$tab='user';
//$cond=array('fname'=>"'Forest'");
//$db=new database();
//
//$sel=array('fname','lname');
////$db->delete($tab,$arr);
////$db->insert($tab,$arr);
//
////$db->update($tab,$arr,$cond);
//$result=$db->select($tab,$sel,$cond);
//$noOfUsrs = mysqli_num_rows($result);
////print_r($result);
//echo $noOfUsrs ;
