<?php
class course_queries extends CI_Model{

  const DB_TABLE = 'course';
  const DB_TABLE_PK = 'course_id';
  public $coursecode;
  public $cdescrip;
  public $school;
  public $status;
 

  
  public function view_course(){
  $query = $this->db->get('course'); 
  return $query->result();
  }

  public function get_course($table, $where = array()) {
  $query = $this->db->get_where($table, $where);
  return $query->result();  
  }

	public function add_course(){
  $this->db->insert($this::DB_TABLE, $this);
  }  

  public function update_course($table, $where = array(), $data){
  $this->db->where($where);
  $this->db->update($table, $data);
  return true;
  }

 
  
}

 ?>
