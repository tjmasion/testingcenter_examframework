<?php
class referral_queries extends CI_Model{

  const DB_TABLE = 'referral';
  const DB_TABLE_PK = 'ref_num';
  public $client_num;
  public $date;
  
  public function add_referral(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function get_referral($table, $where = array()){
  	$query = $this->db->get_where($table, $where);
  	return $query->result();
  }
  public function view_ref(){
    $query = $this->db->get('referral'); 
    return $query->result();
  }
}

 ?>
