<?php
class counter_queries extends CI_Model{

  const DB_TABLE = 'counter';
  const DB_TABLE_PK = 'counter_num';
  public $client_num;
  public $frequency;
  public $datelimit;

  
  public function add_counter(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function view_counter(){
    $query = $this->db->get('counter'); 
    return $query->result();
  }
  public function get_counter_where($table, $where = array()){
    $query = $this->db->get_where($table, $where);
    return $query->result();
  }
  public function update_counter($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return true;
  }
}
 ?>
