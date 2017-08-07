<?php
class resultsub_queries extends CI_Model{

  const DB_TABLE = 'resultsub';
  const DB_TABLE_PK = 'resultsub_num';
  public $ref_num;
  public $exam_num;
  public $subexam_num;
  public $total;
  public $result;
  
  public function add_resultsub(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function get_resultsub_where($table, $where = array()){
    $query = $this->db->get_where($table, $where);
    return $query->result();
  }
}

 ?>
