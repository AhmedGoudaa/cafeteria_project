<?php

class CategoryModel extends Database{

    public $id;
    public $cat_name;
    public $columns_names = array('id', 'cat_name');

    public function __construct() {
        $this->table = "category";
    }

}
