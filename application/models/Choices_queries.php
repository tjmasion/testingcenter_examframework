<?php
class choices_queries extends CI_Model{

  const DB_TABLE = 'choices';
  const DB_TABLE_PK = 'choice_id';
  public $exam_num;
  public $choice;
  public $point_equivalent;
  
  public function add_choice(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function get_choices_where($table, $where = array()){
    $query = $this->db->get_where($table, $where);
    return $query->result();
  
  }
  public function delete_choices($table, $where = array()) {
    $this->db->where($where);
    $res = $this->db->delete($table); 
    if($res)
      return TRUE;
    else
      return FALSE;
  }
  public function update_choices($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return true;
  }
}

 ?>
