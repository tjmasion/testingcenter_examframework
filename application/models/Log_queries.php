<?php
class log_queries extends CI_Model{

  const DB_TABLE = 'activitylog';
  const DB_TABLE_PK = 'log_id';
  public $account_id;
  public $date;
  public $action;
  
  public function add_log(){
    $this->db->insert($this::DB_TABLE, $this);
  }
  public function view_logs(){
    $query = $this->db->get('activitylog'); 
    return $query->result();
  }
  
  }
 ?>
