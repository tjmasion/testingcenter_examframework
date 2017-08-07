<?php
class client_queries extends CI_Model{

  const DB_TABLE = 'client';
  const DB_TABLE_PK = 'client_num';
  public $id_num;
  public $lname;
  public $fname;
  public $mname;
  public $course;
  public $yrlvl;
  public $sex;
  public $email;
  public $status;
  public $school;
  
  public function add_client(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function view_active(){
    $this->db->from($this::DB_TABLE);
    $this->db->order_by('lname','asc');
    $query = $this->db->get(); 
    return $query->result();
  }
  public function get_client($table, $where = array()) {
    $query = $this->db->get_where($table, $where);
    return $query->result();
    
  }
  public function update_c($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return true;
  }
  
}

 ?>
