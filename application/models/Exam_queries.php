<?php
class exam_queries extends CI_Model{

  const DB_TABLE = 'exam';
  const DB_TABLE_PK = 'exam_num';
  public $exam_name;
  public $no_of_takers;
  public $date_create;
  public $descrip;
  public $timelimit;
  
  public function add_exam(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function pass_exam_num($table, $where = array()){
    $query = $this->db->get_where($table, $where);
    return $query->result();
  }
  public function view_exam_list(){  
    $query = $this->db->get('exam');
    return $query->result();
  }
  public function get_exam($table, $where = array()) {
    $query = $this->db->get_where($table, $where);
    return $query->result();
    
  }
  public function update_exam($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return true;
  }
}

 ?>
