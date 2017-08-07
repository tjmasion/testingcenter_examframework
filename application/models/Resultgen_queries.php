<?php
class resultgen_queries extends CI_Model{

  const DB_TABLE = 'resultgen';
  const DB_TABLE_PK = 'resultgen_num';
  public $ref_num;
  public $exam_num;
  public $total;
  public $result;
  public $date;
  public $eval;
  
  public function add_resultgen(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function get_resultgen_where($table, $where = array()){
    $query = $this->db->get_where($table, $where);
    return $query->result();
  }
  public function update_result($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return TRUE;
    }
}

 ?>
