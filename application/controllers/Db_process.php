<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Db_process extends CI_Controller{
   public function __construct()
      {
          parent::__construct();

           $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
           $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
           $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
           $this->output->set_header('Pragma: no-cache');
    }

  public function reset(){

    $current=date("Y-m-d");
    $db = new counter_queries();
   
    $where = array('datelimit' => '2017-01-01');
    $data['count']=$db->counter_queries->get_counter_where('counter',$where);

    foreach($data['count'] as $cnt){
      $data = array(
        'client_num' => $cnt->client_num,
        'frequency' => 0,
        'datelimit' => $current, 
        );
    }
    $db->update_counter('counter', $where, $data);

    $id=$this->session->userdata('account_id');

    $db1 = new log_queries();
    $db1->action='reset result';
    date_default_timezone_set("Asia/Manila");
    $db1->date=date("Y-m-d h:i:sa");
    $db1->account_id=$id;

    redirect('Page/report/');
  }

  public function activitylog(){

  $i=0;
  $arr=array();
  $id;

  $db = new log_queries();
  $db1 = new accounts_queries();

  $data['logs']=$db->view_logs();

  foreach($data['logs'] as $data_item){
    $id=$data_item->account_id;

      $arr[$i]['date']=$data_item->date;
      $arr[$i]['action']=$data_item->action;
      $arr[$i]['account_id']=$data_item->account_id;

    $this->load->model('accounts_queries');
    $where = array('account_id' => $id); 
    $data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

    foreach($data['accounts'] as $info){
      $arr[$i]['usertype']=$info->usertype;
      $arr[$i]['username']=$info->username;
      $arr[$i]['fname']=$info->fname;
      $arr[$i]['lname']=$info->lname;
    }
    $i++;
  }

    $data['array']=$arr;

    $this->load->view('header/header');
    $this->load->view('sidebar/adminsidebar');
    $this->load->view('activity_log',$data);
    $this->load->view('footer/footer');

  }

  public function addstud_examtest($exam_num=''){

  
   $cntid=0;
   $num = 0;
   $date;
   $refno;
   $stt='cleared';
   $id=$this->session->userdata('account_id');
   
   $client_num = $this->session->userdata('clienttest');

   
 
   $db2 = new counter_queries();
   $where = array('client_num' => $client_num);
   $data['counter'] = $db2->counter_queries->get_counter_where('counter',$where);
   foreach ($data['counter'] as $data_item){
      $cntid=$data_item->counter_num;
      $num=$data_item->frequency;
      $date=$data_item->datelimit;
      
   }


   $db8 = new container_queries();
   $db9 = new referral_queries();
   $where = array('client_num' => $client_num);
   $data['reff'] = $db9->referral_queries->get_referral('referral',$where);

   foreach($data['reff'] as $data_reff){
      if($data_reff->date > $date){
        $refno=$data_reff->ref_num;

        $where = array('ref_num' => $refno , 'con' => 'active', 'status' => 'unfinish');
        $data['cont'] = $db8->container_queries->get_container_where('container',$where);
        foreach($data['cont'] as $data_cont){
          if($data_cont->exam_num == $exam_num){
            $stt='cant';
          }
        }
      }
   }

   if($num>=3){
    $stt='warn';
   }

   if($stt=='cleared'){

   $db = new referral_queries();

   $db->client_num= $client_num;
   date_default_timezone_set("Asia/Manila");
   $db->date=date("Y-m-d h:i:sa");
   $db->add_referral();

   $num=$num+1;

   $db3 = new counter_queries();
   $where = array('counter_num' => $cntid);
   $insert = array(
      'frequency' => $num,
      );
   $db3->update_counter('counter', $where, $insert);

   $db1 = new log_queries();
   $db1->action='add exam';
   $db1->date=date("Y-m-d");
   $db1->account_id=$id;
   $db1->add_log();

   $this->container_addtest($exam_num,$client_num);
  }else{
     


    $i=0;
      $arr=array();
      

      $this->load->model('client_queries');
      $where = array('client_num' => $client_num); 
      $data['clients'] = $this->client_queries->get_client('client',$where);

      $this->load->model('container_queries');
      $where = array('client_num' => $client_num , 'con' => 'active', 'status' => 'unfinish');
      $data['container'] = $this->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr[$i]['ref_num']= $data_con->ref_num;
          $arr[$i]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr[$i]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr[$i]['exam_name']= $data_item1->exam_name;
            $arr[$i]['examid'] = $data_item1->exam_num;
            }

            $db5 = new counter_queries();
            $where = array('client_num' => $client_num);
            $data['counter'] = $db5->counter_queries->get_counter_where('counter',$where);
            foreach($data['counter'] as $data_item1){
              $arr[$i]['frequency']= $data_item1->frequency;
              }
            $i++;


      }

      $this->load->model('counter_queries');
      $where = array('client_num' => $client_num);
      $data['ctr'] = $this->counter_queries->get_counter_where('counter',$where);


      $data['array']=$arr;
     

      $prmt = array();
      $prmt [] = array(
      'status' => $stt,
      );
      $data['prmpt']= $prmt;

      $this->load->view('header/header');
      $this->load->view('sidebar/guidancesidebar');
      $this->load->view('testingrecord',$data);
      $this->load->view('footer/footer'); 
  } 
  
  }
  public function container_addtest($exam_num='',$client_num=''){
    
    $db = new container_queries();

    $this->load->model('referral_queries');
    $where = array('client_num' => $client_num,'date' => date("Y-m-d")); 
    $data['ref_num'] = $this->referral_queries->get_referral('referral',$where);

    foreach($data['ref_num'] as $data_item){
    $db->ref_num=$data_item->ref_num;
    }
    $db->status='unfinish';
    $db->exam_num = $exam_num;
    $db->client_num = $client_num;
    $db->con = 'active';

    $db->add_container();

    $db2 = new exam_queries;

    $where = array('exam_num' => $exam_num);
    $data['exam']=$db2->exam_queries->get_exam('exam',$where);
    foreach($data['exam'] as $exam_item){
      $inform = array(
        'exam_name' => $exam_item->exam_name,
        'no_of_takers' => $exam_item->no_of_takers + 1,
        'date_create' => $exam_item->date_create,
        'descrip' => $exam_item->descrip
        );
    }

    $db2->update_exam('exam', $where, $inform);

    $this->testingrecord($client_num);   
  }
  public function testingrecord($client_num = '')
  {
   $i=0;
      $arr=array();
      $arr1=array();

      $this->load->model('client_queries');
      $where = array('client_num' => $client_num); 
      $data['clients'] = $this->client_queries->get_client('client',$where);

      $this->load->model('container_queries');
      $where = array('client_num' => $client_num , 'con' => 'active', 'status' => 'unfinish');
      $data['container'] = $this->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr[$i]['ref_num']= $data_con->ref_num;
          $arr[$i]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr[$i]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr[$i]['exam_name']= $data_item1->exam_name;
            $arr[$i]['examid'] = $data_item1->exam_num;
            }

            $db5 = new counter_queries();
            $where = array('client_num' => $client_num);
            $data['counter'] = $db5->counter_queries->get_counter_where('counter',$where);
            foreach($data['counter'] as $data_item1){
              $arr[$i]['frequency']= $data_item1->frequency;
              }
            $i++;


      }

      $prmt = array();
      $prmt [] = array(
      'status' => 'successsexam',
      );
      $data['prmpt']= $prmt;

      $this->load->model('counter_queries');
            $where = array('client_num' => $client_num);
            $data['ctr'] = $this->counter_queries->get_counter_where('counter',$where);


      $data['array']=$arr;
     

    $this->load->view('header/header');
    $this->load->view('sidebar/testingcentersidebar');
    $this->load->view('testingrecord',$data);
    $this->load->view('footer/footer');
  }

  public function addstud_exam($exam_num=''){

   $cntid=0;
   $num = 0;
   $date;
   $refno;
   $stt='cleared';
   $id=$this->session->userdata('account_id');
   
   $client_num = $this->session->userdata('client');

   
 
   $db2 = new counter_queries();
   $where = array('client_num' => $client_num);
   $data['counter'] = $db2->counter_queries->get_counter_where('counter',$where);
   foreach ($data['counter'] as $data_item){
   		$cntid=$data_item->counter_num;
      $num=$data_item->frequency;
      $date=$data_item->datelimit;
      
   }


   $db8 = new container_queries();
   $db9 = new referral_queries();
   $where = array('client_num' => $client_num);
   $data['reff'] = $db9->referral_queries->get_referral('referral',$where);

   foreach($data['reff'] as $data_reff){
      if($data_reff->date > $date){
        $refno = $data_reff->ref_num;

        $where = array('ref_num' => $refno , 'con' => 'active', 'status' => 'unfinish');
        $data['cont'] = $db8->container_queries->get_container_where('container',$where);
        foreach($data['cont'] as $data_cont){
          if($data_cont->exam_num == $exam_num){
            $stt='cant';
          }
        }
      }
   }

   if($num>=3){
    $stt='warn';
   }
   

   if($stt=='cleared'){

   $db = new referral_queries();

   $db->client_num= $client_num;
   $db->date=date("Y-m-d");
   $db->add_referral();

   $num=$num+1;

   $db3 = new counter_queries();
   $where = array('counter_num' => $cntid);
   $insert = array(
      'frequency' => $num,
      );
   $db3->update_counter('counter', $where, $insert);

   $db1 = new log_queries();
   date_default_timezone_set("Asia/Manila");

   $db1->action='add exam';
   $db1->date=date("Y-m-d h:i:sa");
   $db1->account_id=$id;
   $db1->add_log();

   $this->container_add($exam_num,$client_num);
  }else{
     


    $i=0;
      $arr=array();
      $arr1=array();

      $this->load->model('client_queries');
      $where = array('client_num' => $client_num); 
      $data['clients'] = $this->client_queries->get_client('client',$where);

      $this->load->model('container_queries');
      $where = array('client_num' => $client_num , 'con' => 'active', 'status' => 'unfinish');
      $data['container'] = $this->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr[$i]['ref_num']= $data_con->ref_num;
          $arr[$i]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr[$i]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr[$i]['exam_name']= $data_item1->exam_name;
            $arr[$i]['examid'] = $data_item1->exam_num;
            }

            $db5 = new counter_queries();
            $where = array('client_num' => $client_num);
            $data['counter'] = $db5->counter_queries->get_counter_where('counter',$where);
            foreach($data['counter'] as $data_item1){
              $arr[$i]['frequency']= $data_item1->frequency;
              }
            $i++;


      }

      $j=0;
      $db6 = new container_queries();
      $where = array('client_num' => $client_num , 'con' => 'active', 'status' => 'finish');
      $data['container'] = $db6->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr1[$j]['ref_num']= $data_con->ref_num;
        $arr1[$j]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr1[$j]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr1[$j]['exam_name']= $data_item1->exam_name;
            }

            $db3 = new resultgen_queries();
          $where = array('exam_num' => $examnum, 'ref_num' => $ref_num); 
          $data['resultgen'] = $db3->resultgen_queries->get_resultgen_where('resultgen',$where);
          foreach($data['resultgen'] as $data_item1){
            $arr1[$j]['res_date'] = $data_item1->date;
            }

            $j++;
      }
      $this->load->model('counter_queries');
      $where = array('client_num' => $client_num);
      $data['ctr'] = $this->counter_queries->get_counter_where('counter',$where);


      $data['array']=$arr;
      $data['array2']=$arr1;

      $prmt = array();
      $prmt [] = array(
      'status' => $stt,
      );
      $data['prmpt']= $prmt;

      $this->load->view('header/header');
      $this->load->view('sidebar/guidancesidebar');
      $this->load->view('guidancerecord',$data);
      $this->load->view('footer/footer'); 
  } 
  }
  public function container_add($exam_num='',$client_num=''){
    
    $db = new container_queries();

    $this->load->model('referral_queries');
    $where = array('client_num' => $client_num,'date' => date("Y-m-d")); 
    $data['ref_num'] = $this->referral_queries->get_referral('referral',$where);

    foreach($data['ref_num'] as $data_item){
    $db->ref_num=$data_item->ref_num;
    }
    $db->status='unfinish';
    $db->exam_num = $exam_num;
    $db->client_num = $client_num;
    $db->con = 'active';

    $db->add_container();


    $db2 = new exam_queries;

    $where = array('exam_num'=>$exam_num);
    $data['exam']=$db2->exam_queries->get_exam('exam',$where);
    foreach($data['exam'] as $exam_item){
      $inform = array(
        'exam_name' => $exam_item->exam_name,
        'no_of_takers' => $exam_item->no_of_takers + 1,
        'date_create' => $exam_item->date_create,
        'descrip' => $exam_item->descrip,
        );
    }

    $db2->update_exam('exam', $where, $inform);

    $this->view_records($client_num);
  }
  public function view_records($client_num = '')
    {
      $i=0;
      $arr=array();
      $arr1=array();

      $this->load->model('client_queries');
      $where = array('client_num' => $client_num); 
      $data['clients'] = $this->client_queries->get_client('client',$where);

      $this->load->model('container_queries');
      $where = array('client_num' => $client_num , 'con' => 'active', 'status' => 'unfinish');
      $data['container'] = $this->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr[$i]['ref_num']= $data_con->ref_num;
          $arr[$i]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr[$i]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr[$i]['exam_name']= $data_item1->exam_name;
            $arr[$i]['examid'] = $data_item1->exam_num;
            }

            $db5 = new counter_queries();
            $where = array('client_num' => $client_num);
            $data['counter'] = $db5->counter_queries->get_counter_where('counter',$where);
            foreach($data['counter'] as $data_item1){
              $arr[$i]['frequency']= $data_item1->frequency;
              }
            $i++;


      }

      $j=0;
      $db6 = new container_queries();
      $where = array('client_num' => $client_num , 'con' => 'active', 'status' => 'finish');
      $data['container'] = $db6->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr1[$j]['ref_num']= $data_con->ref_num;
        $arr1[$j]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr1[$j]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr1[$j]['exam_name']= $data_item1->exam_name;
            }

            $db3 = new resultgen_queries();
          $where = array('exam_num' => $examnum, 'ref_num' => $ref_num); 
          $data['resultgen'] = $db3->resultgen_queries->get_resultgen_where('resultgen',$where);
          foreach($data['resultgen'] as $data_item1){
            $arr1[$j]['res_date'] = $data_item1->date;
            }

            $j++;
      }
      $this->load->model('counter_queries');
      $where = array('client_num' => $client_num);
      $data['ctr'] = $this->counter_queries->get_counter_where('counter',$where);


      $data['array']=$arr;
      $data['array2']=$arr1;

      $prmt = array();
      $prmt [] = array(
      'status' => 'successexam',
      );
      $data['prmpt']= $prmt;

      $this->load->view('header/header');
      $this->load->view('sidebar/guidancesidebar');
      $this->load->view('guidancerecord',$data);
      $this->load->view('footer/footer');
      
    }
  public function add_client(){

   $account_id;
   $flag='cleared';
   $fname;
   $lname;
   $mname;
   $idnum;
   $email;
   $no;
   $crs;
   $school;

   $this->load->library('form_validation');
   $this->form_validation->set_rules('sex', 'Gender', 'required');
   $idnum = $this->input->post('id_num');
   $fname = $this->input->post('fname');
   $lname = $this->input->post('lname');
   $mname = $this->input->post('mname');
   $email = $this->input->post('email');
   $crs = $this->input->post('course');

   $this->load->model('course_queries');
   $where = array('coursecode' => $crs);
   $data['schl']=$this->course_queries->get_course('course',$where);
   foreach($data['schl'] as $data_item){
    $school = $data_item->school;
   }

    if(ctype_alpha($fname)){
    if(ctype_alpha($lname)){
      if(ctype_alpha($mname)){
        $flag='cleared';
      }else{
        $flag='mname';
      }
    }else{
      $flag='lname';
    }
   }else{
    $flag='fname';
   }

   $db4 = new client_queries;
   $data['checkuser']=$db4->view_active();
   if(is_numeric($idnum)){
   foreach($data['checkuser'] as $data_check){
    if($data_check->id_num == $idnum){
      $flag='idnum';
    }

    if($data_check->fname == $fname){
      if($data_check->mname == $mname){
        if($data_check->lname == $lname){
          $flag='name';
        }
      }
    }

    if($data_check->email == $email){
      $flag='email';
    }
   }
   }else{
      $flag='num';
   }

  

  if($flag=='cleared'){ 
   $db = new client_queries();
   $db->id_num = $this->input->post('id_num');
   $db->lname= $this->input->post('lname');
   $db->fname= $this->input->post('fname');
   $db->mname= $this->input->post('mname');
   $db->course = $this->input->post('course');
   $db->school = $school;
   $db->yrlvl = $this->input->post('yrlvl');
   if ($this->form_validation->run()) {
      $db->sex = $this->input->post('sex');
    }
    else {
      $error = validation_errors();
    }
   $db->email = $this->input->post('email');
   $db->status = 'active';
   $db->add_client();

  $db1 = new log_queries();

   $db1->action='add student';
   date_default_timezone_set("Asia/Manila");
   $db1->date=date("Y-m-d h:i:sa");
   $db1->account_id=$this->session->userdata('account_id');

   $db1->add_log();
  $db3 = new client_queries();
  $where = array('id_num' => $idnum); 
  $data['clients'] = $db3->client_queries->get_client('client',$where);
  foreach ($data['clients'] as $data_item){
    $db2 = new counter_queries();

    $db2->client_num = $data_item->client_num;

    $db2->datelimit = '2017-01-01';
    $db2->frequency = 0;

    $db2->add_counter();
  }
  $this->add_account($data['clients']);

  }else{
    
    $error = array();
    $error [] = array(
      'status' => $flag,
      );
    $data['err']= $error;

    $this->load->view('header/header');
    $this->load->view('sidebar/guidancesidebar');
    $this->load->view('guidanceaddstud',$data);
    $this->load->view('footer/footer');
  }
  }
  public function deactivatestud($clientnum=''){
    $action='inactive'; 
    $checker='can';
    $id=$this->session->userdata('account_id');

    $check = new container_queries();
    $where = array('client_num' => $clientnum);
    $data['check'] = $check->container_queries->get_container_where('container',$where);
    foreach($data['check'] as $info){
      if($info->con == 'active'){
        if($info->status == 'unfinish'){
          $checker = 'cant';
        }
    }
    }
    

    $arr=array();
    
    

    if($checker=='can'){
    $arr[0]['status']=1;
    $db = new client_queries();
    $where = array('client_num' => $clientnum); 
    $data['client'] = $this->client_queries->get_client('client',$where);

    foreach($data['client'] as $info){
      $data = array(
        'id_num' => $info->id_num,
        'lname' => $info->lname,
        'fname' => $info->fname,
        'mname' => $info->mname,
        'course' => $info->course,
        'yrlvl' => $info->yrlvl,
        'sex' => $info->sex,
        'email' => $info->email,
        'status' =>$action,
        );
    }
    $db->update_c('client', $where, $data);
    
    $db1 = new log_queries();

   $db1->action='deactivate student';
   date_default_timezone_set("Asia/Manila");
   $db1->date=date("Y-m-d h:i:sa");
    $db1->account_id=$id;

    $db1->add_log();
    
    $db2 = new client_queries();
    $data['clients'] = $db2->view_active();
    $data['status']=$arr;

    $prmt = array();
    $prmt [] = array(
      'status' => 'deac'
      );
    $data['prmpt']= $prmt;

    $this->load->view('header/header');
    $this->load->view('sidebar/guidancesidebar');
    $this->load->view('guidancehome',$data);
    $this->load->view('footer/footer');
  }else{

    $db2 = new client_queries();
    $data['clients'] = $db2->view_active();
    $data['status']=$arr;

    $prmt = array();
    $prmt [] = array(
      'status' => 'cant'
      );
    $data['prmpt']= $prmt;

    $this->load->view('header/header');
    $this->load->view('sidebar/guidancesidebar');
    $this->load->view('guidancehome',$data);
    $this->load->view('footer/footer');
  }
  }
  public function activatestud($clientnum=''){
    $action='active';

    $id=$this->session->userdata('account_id');

    $db = new client_queries();

    $where = array('client_num' => $clientnum); 
    $data['client'] = $this->client_queries->get_client('client',$where);

    foreach($data['client'] as $info){
      $data = array(
        'id_num' => $info->id_num,
        'lname' => $info->lname,
        'fname' => $info->fname,
        'mname' => $info->mname,
        'course' => $info->course,
        'yrlvl' => $info->yrlvl,
        'sex' => $info->sex,
        'email' => $info->email,
        'status' =>$action,
        );
    }

    $db->update_c('client', $where, $data);

    $db1 = new log_queries();

   $db1->action='reactivate student';
   date_default_timezone_set("Asia/Manila");
   $db1->date=date("Y-m-d h:i:sa");
   $db1->account_id=$id;

   $db1->add_log();
 
    $data['clients'] = $db->view_active();

    $prmt = array();
    $prmt [] = array(
      'status' => 'reac'
      );
    $data['prmpt']= $prmt;

    $this->load->view('header/header');
    $this->load->view('sidebar/guidancesidebar');
    $this->load->view('guidancehome',$data);
    $this->load->view('footer/footer');
  }
  public function deactivatesexam($examnum=''){

    $id=$this->session->userdata('account_id');

    $db = new exam_queries();

    $where = array('exam_num' => $examnum); 
    $data['exam'] = $this->exam_queries->get_exam('exam',$where);

    foreach($data['exam'] as $info){
      $data = array(
        'exam_name' => $info->exam_name,
        'date_create' => $info->date_create,
        'status' => 'deactivated',
        'descrip' => $info->descrip,
        );
        
    }

    $db->update_exam('exam', $where, $data);

    $db1 = new log_queries();

   $db1->action='deactivate exam';
   date_default_timezone_set("Asia/Manila");
   $db1->date=date("Y-m-d h:i:sa");
   $db1->account_id=$id;

   $db1->add_log();

    $where = array('status' => 'active'); 
    $data['exams'] = $this->exam_queries->get_exam('exam',$where);

    $prmt = array();
    $prmt [] = array(
    'status' => 'deacsucc'
    );
    $data['prmpt']= $prmt;

    $this->load->view('header/header');
    $this->load->view('sidebar/testingcentersidebar');
    $this->load->view('testingexam',$data);
    $this->load->view('footer/footer');
  }
  public function deactivateaccount($account_id=''){

    $checker='deac';
    $status=0;
    $user;
    $num;
    

    $id=$this->session->userdata('account_id'); 
    
    $check2 = new accounts_queries();
    $where = array('account_id' => $account_id);
    $data['check1'] = $check2->accounts_queries->get_accounts('accounts',$where);
    foreach($data['check1'] as $counter){
      $user=$counter->usertype;
      $num=$counter->client_num;
    }
    
    if($user='student'){
    $check = new container_queries();
    $where = array('client_num' => $num);
    $data['check'] = $check->container_queries->get_container_where('container',$where);
    foreach($data['check'] as $info){
      if($info->con == 'active'){
        if($info->status == 'unfinish'){
          $checker = 'cant';
        }
    }
    }
    }
          if($checker=='deac'){
          $db = new accounts_queries();
          $this->load->library('form_validation');

          $where = array('account_id' => $account_id); 
          $data['accounts'] = $db->accounts_queries->get_accounts('accounts',$where);

          foreach($data['accounts'] as $data_item){
          $data = array(
          'client_num' => $data_item->client_num,
          'username' => $data_item->username,
          'password' => $data_item->password,
          'usertype' => $data_item->usertype,
          'fname' => $data_item->fname,
          'lname' => $data_item->lname,
          'status' => 'inactive',
          );
          }

          $db->update_accounts('accounts', $where, $data);

          $db1 = new log_queries();

          $db1->action='deactivate account';
          date_default_timezone_set("Asia/Manila");
          $db1->date=date("Y-m-d h:i:sa");
          $db1->account_id=$id;

          $db1->add_log();

          }
    $prmt = array();
    $prmt [] = array(
    'status' => $checker
    );
    $data['prmpt']= $prmt;

    $where = array('status' => 'active'); 
    $data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

    $this->load->view('header/header');
    $this->load->view('sidebar/adminsidebar');
    $this->load->view('superadminhome',$data);
    $this->load->view('footer/footer');
  }

   public function reactivateaccount($account_id=''){

    $id=$this->session->userdata('account_id'); 
               

    $db = new accounts_queries();
    $this->load->library('form_validation');

    $where = array('account_id' => $account_id); 
    $data['accounts'] = $db->accounts_queries->get_accounts('accounts',$where);

    foreach($data['accounts'] as $data_item){
      $data = array(
        'client_num' => $data_item->client_num,
        'username' => $data_item->username,
        'password' => $data_item->password,
        'usertype' => $data_item->usertype,
        'fname' => $data_item->fname,
        'lname' => $data_item->lname,
        'status' => 'active',
        );
        
    }

    $db->update_accounts('accounts', $where, $data);

   $db1 = new log_queries();

   $db1->action='reactivate account';
   date_default_timezone_set("Asia/Manila");
   $db1->date=date("Y-m-d h:i:sa");
   $db1->account_id=$id;

   $db1->add_log();

    $where = array('status' => 'inactive'); 
    $data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);


    $prmt = array();
    $prmt [] = array(
    'status' => 'reac'
    );
    $data['prmpt']= $prmt;


    $this->load->view('header/header');
    $this->load->view('sidebar/adminsidebar');
    $this->load->view('deactivatedaccounts',$data);
    $this->load->view('footer/footer');
  }
  public function activatesexam($examnum=''){

    $id=$this->session->userdata('account_id');

    $db = new exam_queries();

    $where = array('exam_num' => $examnum); 
    $data['exam'] = $this->exam_queries->get_exam('exam',$where);

    foreach($data['exam'] as $info){
      $data = array(
        'exam_name' => $info->exam_name,
        'date_create' => $info->date_create,
        'no_of_takers' => $info->no_of_takers,
        'status' => 'active',
        'descrip' => $info->descrip,
        );
        
    }

    $db->update_exam('exam', $where, $data);

    $db1 = new log_queries();

   $db1->action='activate exam';
   date_default_timezone_set("Asia/Manila");
   $db1->date=date("Y-m-d h:i:sa");
   $db1->account_id=$id;

   $db1->add_log();

    $where = array('status' => 'deactivated'); 
    $data['exams'] = $this->exam_queries->get_exam('exam',$where);

    $this->load->view('header/header');
    $this->load->view('sidebar/testingcentersidebar');
    $this->load->view('deactestingexam',$data);
    $this->load->view('footer/footer');
  }

  public function removeexam($exam_num=''){
    $default=0;
    $clientnum;
    $num;
    $id=$this->session->userdata('account_id'); 
    $refnum;
    $client_num;
    $clnt=$this->session->userdata('clnt'); 

    $db = new container_queries();
    $where = array('exam_num'=>$exam_num, 'status'=>'unfinish', 'client_num' => $clnt);
    $data['container'] = $this->container_queries->get_container_where('container',$where);
    foreach($data['container'] as $con){
       $refnum = $con->ref_num;
       $clientnum = $con->client_num;
        $data = array(
        'con' => 'delete',
        );
      $clientnum=$con->client_num;
      $client_num=$clientnum;
    }
    $db->update_con('container', $where, $data);

    $db1 = new log_queries();

   $db1->action='deactivate student';
   date_default_timezone_set("Asia/Manila");
   $db1->date=date("Y-m-d h:i:sa");
   $db1->account_id=$id;

   $db1->add_log();

    $db2 = new exam_queries;

    $where = array('exam_num'=>$exam_num);
    $data['exam']=$db2->exam_queries->get_exam('exam',$where);
    foreach($data['exam'] as $exam_item){
      $inform = array(
        'exam_name' => $exam_item->exam_name,
        'no_of_takers' => $exam_item->no_of_takers - 1,
        'date_create' => $exam_item->date_create,
        'descrip' => $exam_item->descrip,
        );
    }
    $db2->update_exam('exam', $where, $inform);

    $db3 = new counter_queries();
    $where = array('client_num' => $clientnum);
    $data['counter'] = $db3->counter_queries->get_counter_where('counter',$where);
    foreach ($data['counter'] as $data_item){
        $num = $data_item->frequency;    
    }
    $num = $num - 1;
    $data = array(
       'frequency' => $num,
       );
    $db3->update_counter('counter', $where, $data);


      $i=0;
      $arr=array();
      $arr1=array();

      $this->load->model('client_queries');
      $where = array('client_num' => $clientnum); 
      $data['clients'] = $this->client_queries->get_client('client',$where);

      $this->load->model('container_queries');
      $where = array('client_num' => $clientnum , 'con' => 'active', 'status' => 'unfinish');
      $data['container'] = $this->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr[$i]['ref_num']= $data_con->ref_num;
          $arr[$i]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr[$i]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr[$i]['exam_name']= $data_item1->exam_name;
            $arr[$i]['examid'] = $data_item1->exam_num;
            }

            $db5 = new counter_queries();
            $where = array('client_num' => $client_num);
            $data['counter'] = $db5->counter_queries->get_counter_where('counter',$where);
            foreach($data['counter'] as $data_item1){
              $arr[$i]['frequency']= $data_item1->frequency;
              }
            $i++;


      }

      $j=0;
      $db6 = new container_queries();
      $where = array('client_num' => $client_num , 'con' => 'active', 'status' => 'finish');
      $data['container'] = $db6->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr1[$j]['ref_num']= $data_con->ref_num;
        $arr1[$j]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr1[$j]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr1[$j]['exam_name']= $data_item1->exam_name;
            }

            $db3 = new resultgen_queries();
          $where = array('exam_num' => $examnum, 'ref_num' => $ref_num); 
          $data['resultgen'] = $db3->resultgen_queries->get_resultgen_where('resultgen',$where);
          foreach($data['resultgen'] as $data_item1){
            $arr1[$j]['res_date'] = $data_item1->date;
            }

            $j++;
      }
      $this->load->model('counter_queries');
      $where = array('client_num' => $client_num);
      $data['ctr'] = $this->counter_queries->get_counter_where('counter',$where);


      $data['array']=$arr;
      $data['array2']=$arr1;



      $prmt = array();
      $prmt [] = array(
      'status' => 'successexamremove',
      );
      $data['prmpt']= $prmt;

      $this->load->view('header/header');
      $this->load->view('sidebar/guidancesidebar');
      $this->load->view('guidancerecord',$data);
      $this->load->view('footer/footer');

  }
  public function removeexamtesting($exam_num=''){
    
    $default=0;
    $clientnum;
    $num;
    $id=$this->session->userdata('account_id'); 
    $refnum;
    $client_num;
    $clnt=$this->session->userdata('clnt'); 

    $db = new container_queries();

    $where = array('exam_num'=>$exam_num, 'status'=>'unfinish', 'client_num' => $clnt);
    $data['container'] = $this->container_queries->get_container_where('container',$where);
    foreach($data['container'] as $con){
       $refnum = $con->ref_num;
       $clientnum = $con->client_num;
        $data = array(
        'con' => 'delete',
        );
      $clientnum=$con->client_num;
      $client_num=$clientnum;
    }
    $db->update_con('container', $where, $data);

    $db1 = new log_queries();

   $db1->action='deactivate student';
   date_default_timezone_set("Asia/Manila");
   $db1->date=date("Y-m-d h:i:sa");
   $db1->account_id=$id;

   $db1->add_log();

    $db2 = new exam_queries();

    $where = array('exam_num'=>$exam_num);
    $data['exam']=$db2->exam_queries->get_exam('exam',$where);
    foreach($data['exam'] as $exam_item){
      $inform = array(
        'exam_name' => $exam_item->exam_name,
        'no_of_takers' => $exam_item->no_of_takers - 1,
        'date_create' => $exam_item->date_create,
        'descrip' => $exam_item->descrip,
        );
    }
    $db2->update_exam('exam', $where, $inform);

    $db3 = new counter_queries();
    $where = array('client_num' => $clientnum);
    $data['counter'] = $db3->counter_queries->get_counter_where('counter',$where);
    foreach ($data['counter'] as $data_item){
        $num = $data_item->frequency;
        
    }
    $num = $num -1;
    $data = array(
       'frequency' => $num,
       );
    $db3->update_counter('counter', $where, $data);


      $i=0;
      $arr=array();
      $arr1=array();

      $this->load->model('client_queries');
      $where = array('client_num' => $clientnum); 
      $data['clients'] = $this->client_queries->get_client('client',$where);

      $this->load->model('container_queries');
      $where = array('client_num' => $clientnum , 'con' => 'active', 'status' => 'unfinish');
      $data['container'] = $this->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr[$i]['ref_num']= $data_con->ref_num;
          $arr[$i]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr[$i]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr[$i]['exam_name']= $data_item1->exam_name;
            $arr[$i]['examid'] = $data_item1->exam_num;
            }

            $db5 = new counter_queries();
            $where = array('client_num' => $client_num);
            $data['counter'] = $db5->counter_queries->get_counter_where('counter',$where);
            foreach($data['counter'] as $data_item1){
              $arr[$i]['frequency']= $data_item1->frequency;
              }
            $i++;


      }

      
      $this->load->model('counter_queries');
      $where = array('client_num' => $client_num);
      $data['ctr'] = $this->counter_queries->get_counter_where('counter',$where);


      $data['array']=$arr;
     



      $prmt = array();
      $prmt [] = array(
      'status' => 'successexamremove',
      );
      $data['prmpt']= $prmt;

      $this->load->view('header/header');
      $this->load->view('sidebar/testingcentersidebar');
      $this->load->view('testingrecord',$data);
      $this->load->view('footer/footer');

  }


  public function editaccount(){
   
   

   $flag='cleared';
   $aid;
   $fname;
   $lname;
   $username;
   $password;
   $no;
   $utype;

   $this->load->library('form_validation');
   $aid = $this->input->post('aid');
   $fname = $this->input->post('fname');
   $lname = $this->input->post('lname');
   $username = $this->input->post('username');
   $password = $this->input->post('password');
   $utype = $this->input->post('usertype');
   md5($password);
   
    if(ctype_alpha($fname)){
      if(ctype_alpha($lname)){
        $flag='cleared';
        }else{
        $flag='lname';
        }
    }else{
    $flag='fname';
    }

   if($password !== $this->input->post('cpassword')){
    $flag='cpass';
   }

   $db4 = new accounts_queries();
   $data['accounts']=$db4->view_active();

   foreach($data['accounts'] as $data_check){
    if($data_check->account_id !== $aid){

    if($data_check->fname == $fname){
        if($data_check->lname == $lname){
          $flag='name';
        }
    }

    if($data_check->username == $username){
       $flag='uname';
    }
   }
   }
   

  
   if($flag=='cleared'){
    
    $db1 = new accounts_queries();
    $where = array('account_id' => $aid); 
    
    $data = array(
    
      'lname' => $lname,
      'fname' => $fname,
      'username' => $username,
      'password' => $password,
      'usertype' => $utype,
      'status' => 'active',  
    );
    
    $db1->update_accounts('accounts', $where, $data);
    
    $db1 = new log_queries();

    $db1->action='edit account';
    date_default_timezone_set("Asia/Manila");
    $db1->date=date("Y-m-d h:i:sa");
    $db1->account_id=$this->session->userdata('account_id');
    $db1->add_log();

    $db = new accounts_queries();
  
    $where = array('status' => 'active'); 
    $data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

    $status=0;

    $prmt = array();
    $prmt [] = array(
    'status' => 'addsuc',
    );
    $data['prmpt']= $prmt;

    $this->load->view('header/header');
    $this->load->view('sidebar/adminsidebar');
    $this->load->view('superadminhome',$data);
    $this->load->view('footer/footer'); 

  }else{

    $db = new accounts_queries();
  
    $where = array('account_id' => $aid); 
    $data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

    $status=0;


      $prmt = array();
      $prmt [] = array(
        'status' => $flag
        );
      $data['err']= $prmt;

    $this->load->view('header/header');
    $this->load->view('sidebar/adminsidebar');
    $this->load->view('editaccount',$data);
    $this->load->view('footer/footer');

  }

  }

  public function update($client_num= ''){
   
   $sex;

   $flag='cleared';
   $fname;
   $lname;
   $mname;
   $idnum;
   $email;
   $no;

   $this->load->library('form_validation');
   $this->form_validation->set_rules('sex', 'Gender', 'required');
   $idnum = $this->input->post('id_num');
   $fname = $this->input->post('fname');
   $lname = $this->input->post('lname');
   $mname = $this->input->post('mname');
   $email = $this->input->post('email');

   
    if(ctype_alpha($fname)){
    if(ctype_alpha($lname)){
      if(ctype_alpha($mname)){
        $flag='cleared';
      }else{
        $flag='mname';
      }
    }else{
      $flag='lname';
    }
   }else{
    $flag='fname';
   }


   $db4 = new client_queries();
   $data['checkuser']=$db4->view_active();
   if(is_numeric($idnum)){
   foreach($data['checkuser'] as $data_check){
    if($data_check->client_num !== $client_num){
    if($data_check->id_num == $idnum){
      $flag='idnum';
    }

    if($data_check->fname == $fname){
      if($data_check->mname == $mname){
        if($data_check->lname == $lname){
          $flag='name';
        }
      }
    }

    if($data_check->email == $email){
      $flag='email';
    }
   }
   }
   }else{
      $flag='num';
   }

  
   if($flag=='cleared'){
    $db = new client_queries();

    $where = array('client_num' => $client_num); 
    
    if ($this->form_validation->run()) {
      $sex = $this->input->post('sex');
    }
    else {
      $error = validation_errors();
    }
    

    $data = array(
      'id_num' => $this->input->post('id_num'),
      'lname' => $this->input->post('lname'),
      'fname' => $this->input->post('fname'),
      'mname' => $this->input->post('mname'),
      'course' => $this->input->post('course'),
      'yrlvl' => $this->input->post('yrlvl'),
      'sex' => $sex,
      'email' => $this->input->post('email'),
    );
    
    $db->update_c('client', $where, $data);

    $this->load->model('client_queries');
    $where = array('client_num' => $client_num); 
    $data['clients'] = $this->client_queries->get_client('client',$where);
    
    $db1 = new log_queries();

    $db1->action='edit information';
    date_default_timezone_set("Asia/Manila");
    $db1->date=date("Y-m-d h:i:sa");
    $db1->account_id=$this->input->post('user');
    $db1->add_log();

      $i=0;
      $arr=array();
      $arr1=array();

      $this->load->model('client_queries');
      $where = array('client_num' => $client_num); 
      $data['clients'] = $this->client_queries->get_client('client',$where);

      $this->load->model('container_queries');
      $where = array('client_num' => $client_num , 'con' => 'active', 'status' => 'unfinish');
      $data['container'] = $this->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr[$i]['ref_num']= $data_con->ref_num;
          $arr[$i]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr[$i]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr[$i]['exam_name']= $data_item1->exam_name;
            $arr[$i]['examid'] = $data_item1->exam_num;
            }
            $db5 = new counter_queries();
            $where = array('client_num' => $client_num);
            $data['counter'] = $db5->counter_queries->get_counter_where('counter',$where);
            foreach($data['counter'] as $data_item1){
                          $arr[$i]['frequency']= $data_item1->frequency;
            }
                 $i++;
      }

      $j=0;
      $this->load->model('container_queries');
      $where = array('client_num' => $client_num , 'con' => 'active', 'status' => 'finish');
      $data['container'] = $this->container_queries->get_container_where('container',$where);
      foreach($data['container'] as $data_con){
        $ref_num=$data_con->ref_num;
        $examnum=$data_con->exam_num;

        $arr1[$j]['ref_num']= $data_con->ref_num;
          $arr1[$j]['client_num']= $data_con->client_num;

        $db4 = new referral_queries();
          $where = array('ref_num' => $ref_num);
          $data['referral'] = $this->referral_queries->view_ref('referral',$where);
          foreach($data['referral'] as $data_item3){
            $arr1[$j]['date']= $data_item3->date;
          }
          $db2 = new exam_queries();
          $where = array('exam_num' => $examnum);
          $data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);
          foreach($data['exams'] as $data_item1){
            $arr1[$j]['exam_name']= $data_item1->exam_name;
            }

            $db3 = new resultgen_queries();
        $where = array('exam_num' => $examnum, 'ref_num' => $ref_num); 
        $data['resultgen'] = $db3->resultgen_queries->get_resultgen_where('resultgen',$where);
        foreach($data['resultgen'] as $data_item1){
            $arr1[$j]['res_date']= $data_item1->date;
            }

            $j++;
      }

        
            $this->load->model('counter_queries');
            $where = array('client_num' => $client_num);
            $data['ctr'] = $this->counter_queries->get_counter_where('counter',$where);

      $prmt = array();
      $prmt [] = array(
      'status' => 'success',
      );
      $data['prmpt']= $prmt;

      $data['array']=$arr;
      $data['array2']=$arr1;
      
      $this->load->view('header/header');
      $this->load->view('sidebar/guidancesidebar');
      $this->load->view('guidancerecord',$data);
      $this->load->view('footer/footer');

    }else{

      $error = array();
      $error [] = array(
      'status' => $flag,
      );
      $data['err']= $error;

    $this->load->model('client_queries');
    $where = array('client_num' => $client_num); 
    $data['clients'] = $this->client_queries->get_client('client',$where);

      $this->load->view('header/header');
      $this->load->view('sidebar/guidancesidebar');
      $this->load->view('edit_info',$data);
      $this->load->view('footer/footer');
    }
  } 

  public function add_accountadmin(){
    
    $flag='cleared';
    $db = new accounts_queries();

    $this->load->library('form_validation');
    $id=$this->session->userdata('account_id');
    $lname = $this->input->post('lname');
    $fname = $this->input->post('fname');
    $username = $this->input->post('username');
    $pass = $this->input->post('password');
    $cpass = $this->input->post('cpassword');

    md5($pass);
    md5($cpass);

    if(ctype_alpha($fname)){
     if(ctype_alpha($lname)){
        $flag='cleared';
     }else{
      $flag='lname';
    }
   }else{
    $flag='fname';
   }

   if($pass !== $cpass){
    $flag = 'pass';
   }

   $data['chck']=$db->view_active();
   foreach($data['chck'] as $data_check){
      if($data_check->fname == $fname){  
        if($data_check->lname == $lname){
          $flag='name';
        }   
      }
      if($data_check->username == $username){
        $flag='uname';
      }
   }
    if($flag=='cleared'){
    $db->lname = $this->input->post('lname');
    $db->fname = $this->input->post('fname');
    $db->username = $this->input->post('username');
    $db->password = $pass;
    $db->idnum = $this->input->post('idnum');
    $db->usertype = $this->input->post('usertype');
    $db->status = 'active';

    $db->add_account();
    $db1 = new log_queries();

    $db1->action='add account';
    date_default_timezone_set("Asia/Manila");
    $db1->date=date("Y-m-d h:i:sa");
    $db1->account_id=$id;

    $db1->add_log();

    $prmt = array();
    $prmt [] = array(
      'status' => 'success'
      );
    $data['prmpt']= $prmt;

    $where = array('status' => 'active'); 
    $data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

    $this->load->view('header/header');
    $this->load->view('sidebar/adminsidebar');
    $this->load->view('superadminhome',$data);
    $this->load->view('footer/footer');
    }else{

    $error = array();
    $error [] = array(
      'status' => $flag,
      );
    $data['err']= $error;


    $this->load->view('header/header');
    $this->load->view('sidebar/adminsidebar');
    $this->load->view('createaccount', $data);
    $this->load->view('footer/footer');
    }
  }

  public function add_account($clients){
    
    $db = new accounts_queries();

    foreach($clients as $data_item){
      $password = $data_item->id_num;
      md5($password);

      $db->client_num = $data_item->client_num;
      $db->username = $data_item->id_num;
      $db->password = $password;
      $db->fname = $data_item->fname;
      $db->lname = $data_item->lname;
      $db->usertype = "student";
      $db->status = 'active';
      $db->idnum = $data_item->id_num;
     }
    $db->add_account();


    $prmt = array();
    $prmt [] = array(
      'status' => 'success'
      );
    $data['prmpt']= $prmt;

    $db1 = new client_queries();
  
    $data['clients'] = $db1->view_active();

    $this->load->view('header/header');
    $this->load->view('sidebar/guidancesidebar');
    $this->load->view('guidancehome',$data);
    $this->load->view('footer/footer');


  }

  public function add_evaluation(){

    $refnum = $this->input->post('refnum');
    $examnum = $this->input->post('examnum');
    $clientid = $this->input->post('num');

    $db = new resultgen_queries();
    $where = array('ref_num' => $refnum , 'exam_num' => $examnum);
    $update = array(
      'eval' => $this->input->post('eval'),
      );

    if($db->update_result('resultgen', $where, $update)==TRUE){
    redirect('Page/view_records/'.$clientid);
    }else{
     redirect('Page/report/'.$clientid);
    }
  }

  public function add_course(){

    
    $db = new course_queries();

    $db->coursecode = $this->input->post('ccode');
    $db->cdescrip = $this->input->post('cname');
    $db->status = 0;
    $db->school = $this->input->post('school');

    $db->add_course();

    $db = new accounts_queries();
  
    $where = array('status' => 'active'); 
    $data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

    $status=0;


      $prmt = array();
      $prmt [] = array(
        'status' => 'caddsuc'
        );
      $data['prmpt']= $prmt;

    $this->load->view('header/header');
    $this->load->view('sidebar/adminsidebar');
    $this->load->view('superadminhome',$data);
    $this->load->view('footer/footer');  

  }

  public function check_user($username = ''){
    $chk = 0;
    $this->load->model('accounts_queries');
    $where = array('username' => $username , 'status' => 'active'); 
    $data['username'] = $this->accounts_queries->get_accounts('accounts',$where);
    
    foreach($data['username'] as $data_item){
      if($data_item->usertype == 'guidance'){
        $chk = $data_item->account_id;
      }elseif($data_item->usertype == 'testing'){
        $chk = $data_item->account_id;
      }elseif($data_item->usertype == 'student'){
        $chk = $data_item->account_id;
      }elseif($data_item->usertype == 'admin'){
        $chk = $data_item->account_id;
      }
    }
    return $chk;
  }
  
  public function userlogin(){
    $db = new accounts_queries();
    $client_num;
    $action1='active';
    $usertype = '';
    $account_id;
    $clnt;

    $uname = $this->input->post('username');
    $db->username = $uname;
    $db->password = $this->input->post('password');
    
    $stat = $this->check_user($uname);
   

    $data['logged'] = $db->login();   
    if($data['logged']){
      if($stat !== 0){
      $this->load->model('accounts_queries');
      $where = array('account_id' => $stat); 
      $data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

      foreach($data['accounts'] as $account){
        $usertype = $account->usertype;
        $account_id = $account->account_id;
        $clnt = $account->client_num;
      }

      if($usertype == 'guidance'){
        unset($_SESSION['error_message']);
        $db = new client_queries();
  
  
      $where = array('status' => $action1); 
      $data['clients'] = $this->client_queries->view_active('client',$where);

              $prmt = array();
              $prmt [] = array(
                'status' => 'neut'
               );
              $data['prmpt']= $prmt;

      $this->load->library('session');
        $this->session->set_userdata(array(
                            'account_id' => $account_id
                          ));

      $this->load->view('header/header');
      $this->load->view('sidebar/guidancesidebar');
      $this->load->view('guidancehome',$data);
      $this->load->view('footer/footer');
        
      }

      elseif($usertype == 'testing'){
      unset($_SESSION['error_message']);  
      $db = new client_queries();
  
  
      $where = array('status' => $action1); 
      $data['clients'] = $this->client_queries->view_active('client',$where);

      $this->load->library('session');
        $this->session->set_userdata(array(
                            'account_id' => $account_id
                          ));

      $this->load->view('header/header');
      $this->load->view('sidebar/testingcentersidebar');
      $this->load->view('testinghome',$data);
      $this->load->view('footer/footer');
  
      }

      elseif($usertype == 'admin'){
      unset($_SESSION['error_message']);  
  
  
      $where = array('status' => $action1); 
      $data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

      $this->load->library('session');
        $this->session->set_userdata(array(
                            'account_id' => $account_id
                          ));
      $status=0;
      $arr=array();
      $arr[0]['status']=$status;
      $data['status']=$arr;

       $prmt = array();
       $prmt [] = array(
       'status' => 'neut'
       );
       $data['prmpt']= $prmt;

      $this->load->view('header/header');
      $this->load->view('sidebar/adminsidebar');
      $this->load->view('superadminhome',$data);
      $this->load->view('footer/footer');
  
      }

      elseif($usertype == 'student'){
        unset($_SESSION['error_message']);
        $db = new client_queries();
  
       
        $where = array('client_num' => $clnt); 
        $data['clients'] = $this->client_queries->get_client('client',$where);

        foreach($data['clients'] as $data_item){
           $client_num = $data_item->client_num;
        }

        $this->load->library('session');
        $this->session->set_userdata(array(
                            'account_id' => $client_num
                          ));

        $this->load->view('header/header');
        $this->load->view('sidebar/studentsidebar');
        $this->load->view('studenthome', $data);
        $this->load->view('footer/footer');

      }

    }else{
    $_SESSION['error_message'] = "Deactivated Account";
    redirect('Page/index','refresh');
    }
    }else{
    $_SESSION['error_message'] = "Invalid Username or Password";
    redirect('Page/index','refresh');
    }
  }


}
 ?>
