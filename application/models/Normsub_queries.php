<?php
class normsub_queries extends CI_Model{

  const DB_TABLE = 'normsub';
  const DB_TABLE_PK = 'norm_id';
  public $exam_num;
  public $subexam_num;
  public $min;
  public $max;
  public $name;
  
  public function add_normsub(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function pass_exam_num($table, $where = array()){
    $query = $this->db->get_where($table, $where);
    return $query->result();
  }
  public function delete_normsub($table, $where = array()) {
    $this->db->where($where);
    $res = $this->db->delete($table); 
    if($res)
      return TRUE;
    else
      return FALSE;
  }
  public function update_normsub($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return true;
  }
}

 ?>
