<?php
class subexam_queries extends CI_Model{

  const DB_TABLE = 'subexam';
  const DB_TABLE_PK = 'subexam_num';
  public $exam_num;
  public $subexam_name;
  
  public function add_subexam(){
    $this->db->insert($this::DB_TABLE, $this);
  }
   public function view_subexam(){
    $query = $this->db->get('subexam');
    return $query->result();
  }
  public function get_subexam_where($table, $where = array()){
    $query = $this->db->get_where($table, $where);
    return $query->result();
  }
  public function delete_subexam($table, $where = array()) {
    $this->db->where($where);
    $res = $this->db->delete($table); 
    if($res)
      return TRUE;
    else
      return FALSE;
  }
  public function update_subexam($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return true;
  }
}

 ?>
