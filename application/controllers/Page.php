<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	 public function __construct()
      {
          parent::__construct();

           $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
           $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
           $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
           $this->output->set_header('Pragma: no-cache');
    }
    
	public function index()
	{
		$db = new accounts_queries();
		$client_num;
		$action1='active';
		$usertype = '';
		$account_id;
		$id = $this->session->userdata('account_id');

		if($id != null){
			$where = array('account_id' => $id); 
			      $data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

			      foreach($data['accounts'] as $account){
			        $usertype = $account->usertype;
			        $account_id = $account->account_id;
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
			  
			       
			        $where = array('client_num' => $id); 
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
		}
		else{
			$this->load->view('index');
		}
	}

	public function report(){

 	//$datelimit='2017-01-01';
  	$client=0;
  	$numoftakers=0;
  	$male=0;
  	$female=0;
  	$first=0;
  	$second=0;
  	$third=0;
  	$fourth=0;
  	$fifth=0;
  	$safad=0;
  	$sas=0;
  	$shcp=0;
  	$slg=0;
  	$sbe=0;
  	$soed=0;
  	$soe=0;
  	$dataelimit;
    

  	$db4 = new counter_queries();
    $data['count']=$db4->view_counter();
    foreach($data['count'] as $cnt){
    	$datelimit=$cnt->datelimit;
    }

  	$db = new referral_queries();
  	$db1 = new container_queries(); 
  	$db2 = new client_queries();
  	$db3 = new exam_queries();

  	$where = array('status' => 'active');
  	$data['exams']=$db3->exam_queries->get_exam('exam', $where);
	$data['ref']=$db->view_ref();

  	foreach($data['ref'] as $data_item){
    if($data_item->date >= $datelimit)
    {
      $ref_num= $data_item->ref_num;
      
      $where = array('ref_num' => $ref_num , 'status' => 'finish');
      $data['container'] = $db1->container_queries->get_container_where('container', $where);

      foreach($data['container'] as $data1){
        if($data1->con =='active'){

        	$where = array('sex' => 'male');
        	$data['male']=$db2->client_queries->get_client('client',$where);

        	$where = array('sex' => 'female');
        	$data['female']=$db2->client_queries->get_client('client',$where);

        	$where = array('yrlvl' => 1 );
        	$data['firstyr']=$db2->client_queries->get_client('client',$where);

        	$where = array('yrlvl' => 2 );
        	$data['secondyr']=$db2->client_queries->get_client('client',$where);

        	$where = array('yrlvl' => 3 );
        	$data['thirdyr']=$db2->client_queries->get_client('client',$where);

        	$where = array('yrlvl' => 4 );
        	$data['fourthyr']=$db2->client_queries->get_client('client',$where);

        	$where = array('yrlvl' => 5 );
        	$data['fifthyr']=$db2->client_queries->get_client('client',$where);

          $where = array('school' => 'safad' );
          $data['safad']=$db2->client_queries->get_client('client',$where);

          $where = array('school' => 'sas' );
          $data['sas']=$db2->client_queries->get_client('client',$where);

          $where = array('school' => 'shcp' );
          $data['shcp']=$db2->client_queries->get_client('client',$where);

          $where = array('school' => 'slg' );
          $data['slg']=$db2->client_queries->get_client('client',$where);

          $where = array('school' => 'sbe' );
          $data['sbe']=$db2->client_queries->get_client('client',$where);

          $where = array('school' => 'soed' );
          $data['soed']=$db2->client_queries->get_client('client',$where);

          $where = array('school' => 'soe' );
          $data['soe']=$db2->client_queries->get_client('client',$where);


          if($data1->client_num != $client){
            $numoftakers=$numoftakers+1;
            $client=$data1->client_num;
          
          $where = array('client_num' => $client);
          $data['client']=$db2->client_queries->get_client('client',$where);

          foreach($data['client'] as $data2){
            if($data2->sex == 'male'){
              $male=$male+1;
      
            }else{
              $female=$female+1;
      
            }

            if($data2->yrlvl == 1){
              $first=$first+1;
              
            }elseif($data2->yrlvl == 2){
              $second=$second+1;
             
            }elseif($data2->yrlvl == 3){
              $third=$third+1;
      
            }elseif($data2->yrlvl == 4){
              $fourth=$fourth+1;
            
            }else{
              $fifth=$fifth+1;
         
            }

            if($data2->course == 'BSA' || $data2->course == 'BSLA' || $data2->course == 'BSID' || $data2->course == 'BFA AA' || $data2->course == 'BFA FD' || $data2->course == 'BFA PA' || $data2->course == 'BFA C'){
               $safad=$safad+1;
             
            }elseif($data2->course == 'BSB' || $data2->course == 'BSES' || $data2->course == 'BSMB' || $data2->course == 'BSC' || $data2->course == 'BSCS' || $data2->course == 'BSIT' || $data2->course == 'BSICT' || $data2->course == 'ACT MMT' || $data2->course == 'BAAL' || $data2->course == 'BAL' || $data2->course == 'BAC M' || $data2->course == 'BAC CC' || $data2->course == 'BLIS' || $data2->course == 'BSM' || $data2->course == 'BP' || $data2->course == 'BSAP' || $data2->course == 'BSP' || $data2->course == 'BAA' || $data2->course == 'BAH' || $data2->course == 'BAS'){
              $sas=$sas+1;
              
            }elseif($data2->course == 'BSN' || $data2->course == 'BSND' || $data2->course == 'BSPh' || $data2->course == 'BSCPS'){
              $shcp=$shcp+1;
              
            }elseif($data2->course == 'BL' || $data2->course == 'BAPS IRFS' || $data2->course == 'BAPS LPS' || $data2->course == 'BAPS PTS' ||$data2->course == 'BAPS PMD'){
              $slg=$slg+1; 
             
            }elseif($data2->course == 'BSAC' || $data2->course == 'BSACT' || $data2->course == 'BSE' || $data2->course == 'BSREM' || $data2->course == 'BSBA ERM' || $data2->course == 'BSBA FM' || $data2->course == 'BSBA HRDM' || $data2->course == 'BSBA MM' || $data2->course == 'BSBA OM' || $data2->course == 'BSE B' || $data2->course == 'BSE LP' || $data2->course == 'BSE SS' || $data2->course == 'BSE S' || $data2->course == 'BSHRM' || $data2->course == 'BSTM'){
              $sbe=$sbe+1;
              
            }elseif($data2->course == 'BEE' || $data2->course == 'BEEC' || $data2->course == 'BESE' || $data2->course == 'BSE E' || $data2->course == 'BSE RVE' || $data2->course == 'BPE SPE' || $data2->course == 'BSE M' || $data2->course == 'BSE PM' || $data2->course == 'BSE PC' || $data2->course == 'BSE BC'){
              $soed=$soed+1;
             
            }elseif($data2->course == 'BSChE' || $data2->course == 'BSCE' || $data2->course == 'BSCompE' || $data2->course == 'BSEE' || $data2->course == 'BSECE' || $data2->course == 'BSIE' || $data2->course == 'BSME'){
              $soe=$soe+1;
            
            }
          }
          
      	}

        }
      }

    }
    
  }

  		$rep=array();
  		$rep[] = array (
  			'numoftakers' => $numoftakers,
  			'male' => $male,
  			'female' => $female,
  			'first' => $first,
  			'second' => $second,
  			'third' => $third,
  			'fourth' => $fourth,
  			'fifth' => $fifth,
  			'safad' => $safad,
  			'sas' => $sas,
  			'shcp' => $shcp,
  			'slg' => $slg,
  			'sbe' => $sbe,
  			'soed' => $soed,
  			'soe' => $soe,
  			);

  		$data['rep']=$rep;
      

  	$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('report',$data);
		$this->load->view('footer/footer');
  }




	public function adminhome()
	{
		$db = new accounts_queries();
  
    	$where = array('status' => 'active'); 
      	$data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

      	$status=0;


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

	public function addcourse()
	{

		$this->load->view('header/header');
		$this->load->view('sidebar/adminsidebar');
		$this->load->view('adminaddcourse');
		$this->load->view('footer/footer');    
	}

	public function editaccount($account_id='')
	{
		$db = new accounts_queries();
  
    	$where = array('account_id' => $account_id); 
      	$data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

      	$status=0;


    	$prmt = array();
    	$prmt [] = array(
      	'status' => 'neut'
      	);
    	$data['err']= $prmt;

		$this->load->view('header/header');
		$this->load->view('sidebar/adminsidebar');
		$this->load->view('editaccount',$data);
		$this->load->view('footer/footer');    
	}

	public function deactivatedaccounts()
	{
		$db = new accounts_queries();
  
    	$where = array('status' => 'inactive'); 
      	$data['accounts'] = $this->accounts_queries->get_accounts('accounts',$where);

      	$prmt = array();
   	    $prmt [] = array(
        'status' => 'neut'
        );
        $data['prmpt']= $prmt;

		$this->load->view('header/header');
		$this->load->view('sidebar/adminsidebar');
		$this->load->view('deactivatedaccounts',$data);
		$this->load->view('footer/footer');    
	}
	public function createaccount()
	{
	$error = array();
    $error [] = array(
      'status' => 'neut',
      );
    $data['err']= $error;


    $this->load->view('header/header');
    $this->load->view('sidebar/adminsidebar');
    $this->load->view('createaccount', $data);
    $this->load->view('footer/footer');
	}
	public function guidancehome()
	{
		$db = new client_queries();
  
      	$data['clients'] = $db->view_active();

      	$prmt = array();
   	    $prmt [] = array(
        'status' => 'neut'
         );
        $data['prmpt']= $prmt;

		$this->load->view('header/header');
		$this->load->view('sidebar/guidancesidebar');
		$this->load->view('guidancehome',$data);
		$this->load->view('footer/footer');    
	}
	public function referral()
	{
		$examnum;
		$clientnum;
		$i=0;
		$db = new container_queries();

  		$arr=array();

  		$where = array('con' => 'active');
    	$data['container'] = $this->container_queries->get_container_where('container',$where);

    	foreach($data['container'] as $data_item) {
    		$examnum = $data_item->exam_num;
    		$clientnum = $data_item->client_num;
    		$ref_num = $data_item->ref_num;
    		
    		$arr[$i]['ref_num']= $data_item->ref_num;
    		$arr[$i]['client_num']= $data_item->client_num;
    		$arr[$i]['status']= $data_item->status;

    		$db5 = new resultgen_queries();
    		$where = array('ref_num' => $ref_num , 'exam_num' => $examnum);
    		$data['resultgen']=$db5->resultgen_queries->get_resultgen_where('resultgen',$where);
    		foreach($data['resultgen'] as $data_item4){
    			$arr[$i]['checkeval'] = $data_item4->eval;
    		}

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
      		}

    		$db3 = new client_queries();
    		$where = array('client_num' => $clientnum);
    		$data['clients'] = $this->client_queries->get_client('client',$where);
    		foreach($data['clients'] as $data_item2){
    			$arr[$i]['fname']= $data_item2->fname;
    			$arr[$i]['mname']= $data_item2->mname;
    			$arr[$i]['lname']= $data_item2->lname;
    			$arr[$i]['idnum']= $data_item2->id_num;
    		}
    		$i++;
    	}

    	$data['array']=$arr;

		$this->load->view('header/header');
		$this->load->view('sidebar/guidancesidebar');
		$this->load->view('referral',$data);
		$this->load->view('footer/footer');
	}

	public function activity_log()
	{
		$db = new log_queries();

		$data['activitylog'] = $db->view_logs();

		$this->load->view('header/header');
		$this->load->view('sidebar/adminsidebar');
		$this->load->view('activity_log', $data);
		$this->load->view('footer/footer');
	}
	public function add_student()
	{
		
		$error = array();
		$error [] = array(
			'status' => 'valid'
			);
		$data['err']= $error;

		$db = new course_queries();
		$where = array('status' => 0);
		$data['courses'] = $db->course_queries->get_course('course',$where);
		
		$this->load->view('header/header');
		$this->load->view('sidebar/guidancesidebar');
		$this->load->view('guidanceaddstud',$data);
		$this->load->view('footer/footer');
	}
	public function edit_info($client_num = '')
	{
		$this->load->model('client_queries');
		$where = array('client_num' => $client_num); 
		$data['clients'] = $this->client_queries->get_client('client',$where);

		 $error = array();
     	 $error [] = array(
      	 'status' => 'neut',
      	 );
         $data['err']= $error;

        $db = new course_queries();
		$where = array('status' => 0);
		$data['courses'] = $db->course_queries->get_course('course',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/guidancesidebar');
		$this->load->view('edit_info',$data);
		$this->load->view('footer/footer');
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
      		'status' => 'neut',
      		);
      		$data['prmpt']= $prmt;

			$data['array']=$arr;
			$data['array2']=$arr1;

			$this->load->view('header/header');
			$this->load->view('sidebar/guidancesidebar');
			$this->load->view('guidancerecord',$data);
			$this->load->view('footer/footer');
		}
	public function add_exam($client_num='')
	{
		$db = new client_queries();
		$where = array('client_num' => $client_num); 
		$data['clients'] = $db->client_queries->get_client('client',$where);
		
		$db2 = new exam_queries();

		$where = array('status' => 'active'); 
    	$data['exams'] = $db2->exam_queries->get_exam('exam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/guidancesidebar');
		$this->load->view('guidanceaddexam', $data);
		$this->load->view('footer/footer');
	}
	public function stud_rep()
	{
		$this->load->view('header/header');
		$this->load->view('sidebar/guidancesidebar');
		$this->load->view('guidancestudrep');
		$this->load->view('footer/footer');
	}
	public function testinghome()
	{
		$db = new client_queries();
 
    	$where = array('status' => 'active'); 
      	$data['clients'] = $this->client_queries->view_active('client',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('testinghome',$data);
		$this->load->view('footer/footer');
	}
	public function testingexam()
	{
		$db = new exam_queries();

		$where = array('status' => 'active'); 
    	$data['exams'] = $this->exam_queries->get_exam('exam',$where);

    	 $prmt = array();
   	    $prmt [] = array(
        'status' => 'neut'
        );
        $data['prmpt']= $prmt;

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('testingexam', $data);
		$this->load->view('footer/footer');
	}
		public function deactestingexam()
	{
		$db = new exam_queries();

		$where = array('status' => 'deactivated'); 
    	$data['exams'] = $this->exam_queries->get_exam('exam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('deactestingexam', $data);
		$this->load->view('footer/footer');
	}
	public function testingaddexam($client_num='')
	{
		$db = new client_queries();
		$where = array('client_num' => $client_num); 
		$data['clients'] = $this->client_queries->get_client('client',$where);
		
		$db2 = new exam_queries();

		$where = array('status' => 'active'); 
    	$data['exams'] = $this->exam_queries->view_exam_list('exam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('testingaddexam',$data);
		$this->load->view('footer/footer');
	}
	public function testingrecord($client_num = '')
	{
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
      		'status' => 'neut',
      		);
      		$data['prmpt']= $prmt;

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('testingrecord',$data);
		$this->load->view('footer/footer');
	}  
		

		
	public function studenthome($client_num = '')
	{
		$this->load->model('client_queries');
		$where = array('client_num' => $client_num); 
		$data['clients'] = $this->client_queries->get_client('client',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/studentsidebar');
		$this->load->view('studenthome',$data);
		$this->load->view('footer/footer');
	}
	public function studentexamhistory($clientnum = '')
	{
		$examnum;
		$i=0;
		$arr=array();

		$db = new container_queries();
		$where = array('client_num' => $clientnum, 'status' => 'finish', 'con' => 'active'); 
		$data['container'] = $db->container_queries->get_container_where('container',$where);

		foreach ($data['container'] as $data_item) {
			$examnum = $data_item->exam_num;
			$refnum = $data_item->ref_num;
			$arr[$i]['refnum'] = $refnum;

			$db2 = new exam_queries();
			$where = array('exam_num' => $examnum); 
			$data['exams'] = $db2->exam_queries->pass_exam_num('exam',$where);

			foreach($data['exams'] as $data_item1){
				$arr[$i]['exam_num']= $data_item1->exam_num;
    			$arr[$i]['exam_name']= $data_item1->exam_name;
      		}

      		$db3 = new resultgen_queries();
			$where = array('exam_num' => $examnum, 'ref_num' => $refnum); 
			$data['resultgen'] = $db3->resultgen_queries->get_resultgen_where('resultgen',$where);

			foreach($data['resultgen'] as $data_item2){
				$arr[$i]['result']= $data_item2->result;
				$arr[$i]['date']= $data_item2->date;
      			}
   
      		$i++;
      	}
		
		$data['array']=$arr;
		$this->load->view('header/header');
		$this->load->view('sidebar/studentsidebar');
		$this->load->view('studentexamhistory',$data);
		$this->load->view('footer/footer');
	}
	public function aboutus()
	{
		$this->load->view('header/header');
		$this->load->view('sidebar/studentsidebar');
		$this->load->view('aboutus');
		$this->load->view('footer/footer');
	}
	public function createexam()
	{
		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('createexam');
		$this->load->view('footer/footer');
	}
	public function examtype()
	{	
		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('examtype');
		$this->load->view('footer/footer');
	}
	public function editexam()
	{	
		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('testingeditexam');
		$this->load->view('footer/footer');
	}
	public function exam()
	{	
		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('exam');
		$this->load->view('footer/footer');
	}
	public function examresults($refnum = '')
	{
		$res = array();
		$res_sub = array();
		$i = 0;
		$db = new container_queries();
		$where = array('ref_num' => $refnum); 
		$data['container'] = $db->container_queries->get_container_where('container',$where);
		foreach ($data['container'] as $data_item) {
			$res[0]['ref_num'] = $refnum;
			$res[0]['client_num'] = $data_item->client_num;
			$res[0]['exam_num'] = $data_item->exam_num;
		}

		$db2 = new resultgen_queries();
		$where = array('ref_num' => $res[0]['ref_num'], 'exam_num' => $res[0]['exam_num']); 
		$data['resultgen'] = $db2->resultgen_queries->get_resultgen_where('resultgen',$where);

		foreach ($data['resultgen'] as $data_item) {
			$res[0]['gen_tot'] = $data_item->total;
			$res[0]['gen_name'] = $data_item->result;
			$res[0]['gen_date'] = $data_item->date;
		}

		$db3 = new client_queries();
		$where = array('client_num' => $res[0]['client_num']); 
		$data['client'] = $db3->client_queries->get_client('client',$where);

		foreach ($data['client'] as $data_item) {
			$res[0]['c_id'] = $data_item->id_num;
			$res[0]['c_lname'] = $data_item->lname;
			$res[0]['c_fname'] = $data_item->fname;
			$res[0]['c_mname'] = $data_item->mname;
			$res[0]['c_course'] = $data_item->course;
			$res[0]['c_yrlvl'] = $data_item->yrlvl;
		}

		$db4 = new exam_queries();
		$where = array('exam_num' => $res[0]['exam_num']); 
		$data['exam'] = $db4->exam_queries->pass_exam_num('exam',$where);

		foreach ($data['exam'] as $data_item) {
			$res[0]['exam_name'] = $data_item->exam_name;
		}

		$db5 = new resultsub_queries();
		$where = array('ref_num' => $res[0]['ref_num'], 'exam_num' => $res[0]['exam_num']); 
		$data['resultsub'] = $db5->resultsub_queries->get_resultsub_where('resultsub',$where);

		foreach ($data['resultsub'] as $data_item){
			$res_sub[$i]['subexam_num'] = $data_item->subexam_num;
			$res_sub[$i]['total'] = $data_item->total;
			$res_sub[$i]['result'] = $data_item->result;

			$db6 = new subexam_queries();
			$where = array('subexam_num' => $res_sub[$i]['subexam_num']); 
			$data['subexam'] = $db6->subexam_queries->get_subexam_where('subexam',$where);

			foreach ($data['subexam'] as $data_item){
				$res_sub[$i]['subexam_name'] = $data_item->subexam_name;
			}


			$i++;
		}
		$data['res_sub'] = $res_sub;
		$data['array'] = $res;

		$this->load->view('header/header');
		$this->load->view('sidebar/studentsidebar');
		$this->load->view('examresults',$data);
		$this->load->view('footer/footer');
	}
    public function examresultsstud($refnum = '')
  {
    $res = array();
    $res_sub = array();
    $i = 0;
    $db = new container_queries();
    $where = array('ref_num' => $refnum); 
    $data['container'] = $db->container_queries->get_container_where('container',$where);
    foreach ($data['container'] as $data_item) {
      $res[0]['ref_num'] = $refnum;
      $res[0]['client_num'] = $data_item->client_num;
      $res[0]['exam_num'] = $data_item->exam_num;
    }

    $db2 = new resultgen_queries();
    $where = array('ref_num' => $res[0]['ref_num'], 'exam_num' => $res[0]['exam_num']); 
    $data['resultgen'] = $db2->resultgen_queries->get_resultgen_where('resultgen',$where);

    foreach ($data['resultgen'] as $data_item) {
      $res[0]['gen_tot'] = $data_item->total;
      $res[0]['gen_name'] = $data_item->result;
      $res[0]['gen_date'] = $data_item->date;
    }

    $db3 = new client_queries();
    $where = array('client_num' => $res[0]['client_num']); 
    $data['client'] = $db3->client_queries->get_client('client',$where);

    foreach ($data['client'] as $data_item) {
      $res[0]['c_id'] = $data_item->id_num;
      $res[0]['c_lname'] = $data_item->lname;
      $res[0]['c_fname'] = $data_item->fname;
      $res[0]['c_mname'] = $data_item->mname;
      $res[0]['c_course'] = $data_item->course;
      $res[0]['c_yrlvl'] = $data_item->yrlvl;
    }

    $db4 = new exam_queries();
    $where = array('exam_num' => $res[0]['exam_num']); 
    $data['exam'] = $db4->exam_queries->pass_exam_num('exam',$where);

    foreach ($data['exam'] as $data_item) {
      $res[0]['exam_name'] = $data_item->exam_name;
    }

    $db5 = new resultsub_queries();
    $where = array('ref_num' => $res[0]['ref_num'], 'exam_num' => $res[0]['exam_num']); 
    $data['resultsub'] = $db5->resultsub_queries->get_resultsub_where('resultsub',$where);

    foreach ($data['resultsub'] as $data_item){
      $res_sub[$i]['subexam_num'] = $data_item->subexam_num;
      $res_sub[$i]['total'] = $data_item->total;
      $res_sub[$i]['result'] = $data_item->result;

      $db6 = new subexam_queries();
      $where = array('subexam_num' => $res_sub[$i]['subexam_num']); 
      $data['subexam'] = $db6->subexam_queries->get_subexam_where('subexam',$where);

      foreach ($data['subexam'] as $data_item){
        $res_sub[$i]['subexam_name'] = $data_item->subexam_name;
      }


      $i++;
    }
    $data['res_sub'] = $res_sub;
    $data['array'] = $res;

    $this->load->view('header/header');
    $this->load->view('sidebar/studentsidebar');
    $this->load->view('examresultsstud',$data);
    $this->load->view('footer/footer');
  }
	public function guidanceexamresults($refnum = '')
	{
		$res = array();
		$res_sub = array();
		$i = 0;
		$db = new container_queries();
		$where = array('ref_num' => $refnum); 
		$data['container'] = $db->container_queries->get_container_where('container',$where);
		foreach ($data['container'] as $data_item) {
			$res[0]['ref_num'] = $refnum;
			$res[0]['client_num'] = $data_item->client_num;
			$res[0]['exam_num'] = $data_item->exam_num;
		}

		$db2 = new resultgen_queries();
		$where = array('ref_num' => $res[0]['ref_num'], 'exam_num' => $res[0]['exam_num']); 
		$data['resultgen'] = $db2->resultgen_queries->get_resultgen_where('resultgen',$where);

		foreach ($data['resultgen'] as $data_item) {
			$res[0]['gen_tot'] = $data_item->total;
			$res[0]['gen_name'] = $data_item->result;
			$res[0]['gen_date'] = $data_item->date;
			$res[0]['eval'] = $data_item->eval;
		}

		$db3 = new client_queries();
		$where = array('client_num' => $res[0]['client_num']); 
		$data['client'] = $db3->client_queries->get_client('client',$where);

		foreach ($data['client'] as $data_item) {
			$res[0]['c_id'] = $data_item->id_num;
			$res[0]['c_lname'] = $data_item->lname;
			$res[0]['c_fname'] = $data_item->fname;
			$res[0]['c_mname'] = $data_item->mname;
			$res[0]['c_course'] = $data_item->course;
			$res[0]['c_yrlvl'] = $data_item->yrlvl;
		}

		$db4 = new exam_queries();
		$where = array('exam_num' => $res[0]['exam_num']); 
		$data['exam'] = $db4->exam_queries->pass_exam_num('exam',$where);

		foreach ($data['exam'] as $data_item) {
			$res[0]['exam_name'] = $data_item->exam_name;
		}

		$db5 = new resultsub_queries();
		$where = array('ref_num' => $res[0]['ref_num'], 'exam_num' => $res[0]['exam_num']); 
		$data['resultsub'] = $db5->resultsub_queries->get_resultsub_where('resultsub',$where);

		foreach ($data['resultsub'] as $data_item){
			$res_sub[$i]['subexam_num'] = $data_item->subexam_num;
			$res_sub[$i]['total'] = $data_item->total;
			$res_sub[$i]['result'] = $data_item->result;

			$db6 = new subexam_queries();
			$where = array('subexam_num' => $res_sub[$i]['subexam_num']); 
			$data['subexam'] = $db6->subexam_queries->get_subexam_where('subexam',$where);

			foreach ($data['subexam'] as $data_item){
				$res_sub[$i]['subexam_name'] = $data_item->subexam_name;
			}


			$i++;
		}
		$data['res_sub'] = $res_sub;
		$data['array'] = $res;

		$this->load->view('header/header');
		$this->load->view('sidebar/guidancesidebar');
		$this->load->view('examresults',$data);
		$this->load->view('footer/footer');
	}
	public function logout()
	{
		$user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'clienttest' && $key != 'client' && $key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity' && $key != 'account_id' && $key != 'is_error') {
                $this->session->unset_userdata($key);
            }
        }
    unset($_SESSION['exam_error']);
    unset($_SESSION['subexam_error']);
    unset($_SESSION['normgen_error']);
    unset($_SESSION['normsub_edit_error']);
    unset($_SESSION['normgen_edit_error']);
    unset($_SESSION['normsub_error']);
    unset($_SESSION['item_error']);
    unset($_SESSION['choices_error']);
    unset($_SESSION['finishcreate_error']);
    $this->session->sess_destroy();
    redirect(site_url());
	}
	
}