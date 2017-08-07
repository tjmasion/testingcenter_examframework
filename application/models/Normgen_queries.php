<?php
class normgen_queries extends CI_Model{

  const DB_TABLE = 'normgen';
  const DB_TABLE_PK = 'norm_id';
  public $exam_num;
  public $min;
  public $max;
  public $name;
  
  public function add_normgen(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function get_normgen_where($table, $where = array()){
    $query = $this->db->get_where($table, $where);
    return $query->result();
  }
  public function delete_normgen($table, $where = array()) {
    $this->db->where($where);
    $res = $this->db->delete($table); 
    if($res)
      return TRUE;
    else
      return FALSE;
  }
  public function update_normgen($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return true;
  }
}

 ?>
