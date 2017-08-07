<?php
class student_queries extends CI_Model{

  const DB_TABLE = 'student';
  const DB_TABLE_PK = 'client_num';
  public $id_num;
  public $lname;
  public $fname;
  public $mname;
  public $course;
  public $year_lvl;
  public $sex;
  public $email;
  
  public function add_stud(){
    $this->db->insert($this::DB_TABLE, $this);
  }

  public function view_stud(){
    $query = $this->db->get('student');
    return $query->result();
  }
  public function get_stud($table, $where = array()) {
    $query = $this->db->get_where($table, $where);
    return $query->result();
    
  }
  
}

 ?>
