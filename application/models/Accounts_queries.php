<?php
class accounts_queries extends CI_Model{

  const DB_TABLE = 'accounts';
  const DB_TABLE_PK = 'account_id';
  public $client_num;
  public $username;
  public $password;
  public $usertype;
  public $fname;
  public $lname;
  public $status;
  public $idnum;


  	public function login(){
	$status = 0;
	$query = $this->db->get_where('accounts', array('username' => $this->username, 'password' => $this->password));
	
	
	if ( $query->num_rows() == 1 )
		{
			$status = 1;
	}
	return $status;
  	}
  
  public function view_active(){
    $query = $this->db->get('accounts'); 
    return $query->result();
  }

	public function get_accounts($table, $where = array()) {
		$query = $this->db->get_where($table, $where);
		return $query->result();	
	}
	public function add_account(){
    $this->db->insert($this::DB_TABLE, $this);
  	}  

  	public function update_accounts($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return true;
  	}

 
  
}

 ?>
