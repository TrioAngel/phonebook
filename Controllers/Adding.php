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

  public function results($user_id){
    $sql = $this->_db->get('phonebook', array('user_id', '=', $user_id));
    if($sql->count()){
      foreach ($sql->results() as $results){
        $array = json_decode(json_encode($results), true);
        $id = $array['id'];
        $user_id = $array['user_id'];
        $name = $array['name'];
        $phone = $array['phone'];
        $address = $array['address'];
        $email = $array['email'];

        echo '

          <tr>
						<td>' . $name . '</td>
						<td>' . $phone . '</td>
						<td>' . $address . '</td>
						<td>' . $email . '</td>						
						<td><a href="updatenumber.php?id=' . $id . '" class="link"><button class="btn btn-primary">Update</button></a></td>
            <td><a href="deletenumber.php?id=' . $id . '" class="link"><button class="btn btn-primary">Delete</button></a></td>
					</tr>
        ';
      };
    } else {
      echo '
        <tr>
          <td colspan="6">No results</td>
        </tr>
      ';
    }
  }

  public function delete($id){
    if(!$this->_db->delete('phonebook', array('id', '=', $id))){
      throw new Exception('There was a problem.');
    }
  }

}