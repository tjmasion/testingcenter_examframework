<?php
class items_queries extends CI_Model{

  const DB_TABLE = 'items';
  const DB_TABLE_PK = 'item_id';
  public $question;
  public $exam_num;
  public $subexam_num;
  public $item_no;
  
  public function add_item(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function get_item_where($table, $where = array()){
    $query = $this->db->get_where($table, $where);
    return $query->result();
  
  }
  public function delete_item($table, $where = array()) {
    $this->db->where($where);
    $res = $this->db->delete($table); 
    if($res)
      return TRUE;
    else
      return FALSE;
  }
  public function update_items($table, $where = array(), $data){
    $this->db->where($where);
    $this->db->update($table, $data);
    return true;
  }
}

 ?>
