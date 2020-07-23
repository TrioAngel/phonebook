<?php


class Adding {
  private $_db,
          $_data;

  public function __construct() {
    $this->_db = DB::getInstance();
  }

  public function create($fields = array()){
    if(!$this->_db->insert('phonebook', $fields)){
      throw new Exception('There was a problem adding a number.');
    }
  }

  public function data(){
    return $this->_data;
  }

}