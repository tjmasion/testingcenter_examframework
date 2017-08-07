<?php
class container_queries extends CI_Model{

  const DB_TABLE = 'container';
  const DB_TABLE_PK = 'container_num';
  public $client_num;
  public $exam_num;
  public $ref_num;
  public $status;
  public $con;
  
  public function add_container(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function view_refcon(){
    $query = $this->db->get('container'); 
    return $query->result();
  }
  public function get_container_where($table, $where = array()){
    $query = $this->db->get_where($table, $where);
    return $query->result();
  }
  public function update_con($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return true;
  }
}
 ?>
