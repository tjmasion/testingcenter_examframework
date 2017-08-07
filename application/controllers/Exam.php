<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exam extends CI_Controller{
	 public function __construct()
      {
          parent::__construct();

           $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
           $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
           $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
           $this->output->set_header('Pragma: no-cache');
    }
	public function addexam(){
  		$db = new exam_queries();
  		$chk = 0;
  		$exam_num;

  		$exam_name = $this->input->post('exam_name');
  		$data['chk_exam'] = $db->exam_queries->view_exam_list();
  		foreach ($data['chk_exam'] as $data_item) {
  			if($exam_name == $data_item->exam_name){
  				$chk = 1;
  			}
  		}
  		if($chk == 0){
  		$this->session->set_userdata(array(
                            'is_error' => $chk
                          ));
  		unset($_SESSION['exam_error']);
  		$db->exam_name = $this->input->post('exam_name');
  		$db->no_of_takers = 0;
  		$db->date_create = date("Y-m-d");
  		$db->descrip= $this->input->post('descrip');
  		$db->timelimit= $this->input->post('timelimit');

  		$db->add_exam();

  		$where = array('exam_name' => $exam_name); 
		$data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);

		foreach ($data['exams'] as $data_item) {
			$exam_num = $data_item->exam_num;
		}
		$this->modifyexam($exam_num);
		}
		elseif($chk == 1){
			$_SESSION['exam_error'] = "Exam not created: Duplicate exam exists";
			$this->session->set_userdata(array(
                            'is_error' => $chk
                          ));
			redirect('page/testinghome','refresh');
		}
	}
	public function modifyexam($exam_num = ''){
		$db = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);

		$db2 = new subexam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['subexams'] = $db2->subexam_queries->get_subexam_where('subexam',$where);

		$db3 = new normgen_queries();
		$where = array('exam_num' => $exam_num); 
		$data['normgen'] = $db3->normgen_queries->get_normgen_where('normgen',$where);

		$db4 = new choices_queries();
		$where = array('exam_num' => $exam_num); 
		$data['choice'] = $db4->choices_queries->get_choices_where('choices',$where);


  		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('selectsubexam',$data);
		$this->load->view('footer/footer');
	}
	public function addsubexam(){

		unset($_SESSION['subexam_error']);
  		$db = new subexam_queries();
  		$chk = 0;

  		$exam_num = $this->input->post('exam_num');
  		$subexam_name = $this->input->post('subexam_name');
  		$where = array('exam_num' => $exam_num);
  		$data['chk_subexam'] = $db->subexam_queries->get_subexam_where('subexam',$where);
  		foreach ($data['chk_subexam'] as $data_item) {
  			if($subexam_name == $data_item->subexam_name){
  				$chk = 1;
  			}
  		}
  		if($chk == 0){
  		$db->exam_num =  $this->input->post('exam_num');
  		$db->subexam_name = $this->input->post('subexam_name');

  		$db->add_subexam();
  		$where = array('exam_num' => $exam_num); 
		$data['subexams'] = $this->subexam_queries->get_subexam_where('subexam',$where);

		$db2 = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db2->exam_queries->pass_exam_num('exam',$where);

		$db3 = new normgen_queries();
		$where = array('exam_num' => $exam_num); 
		$data['normgen'] = $db3->normgen_queries->get_normgen_where('normgen',$where);

		$db4 = new choices_queries();
		$where = array('exam_num' => $exam_num); 
		$data['choice'] = $db4->choices_queries->get_choices_where('choices',$where);

  		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('selectsubexam',$data);
		$this->load->view('footer/footer');
		}elseif($chk == 1){
			$_SESSION['subexam_error'] = "Subexam not added: Duplicate Subexam exists";
			$this->modifyexam($exam_num);
		}
	}

	public function normgenpage($exam_num = ''){

		$this->load->model('exam_queries');
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('addnormgen',$data);
		$this->load->view('footer/footer');
	} 

	public function subexamspage($exam_num = ''){

		$this->load->model('exam_queries');
		$where = array('exam_num' => $exam_num);
		$data['exams'] = $this->exam_queries->pass_exam_num('exam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('addsubexam',$data);
		$this->load->view('footer/footer');
	}

	public function returnsubexamspage($exam_num = ''){
		unset($_SESSION['normsub_error']);
		unset($_SESSION['item_error']);
		unset($_SESSION['choices_error']);

		$db = new subexam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['subexams'] = $db->subexam_queries->get_subexam_where('subexam',$where);

		$db2 = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db2->exam_queries->pass_exam_num('exam',$where);

		$db3 = new normgen_queries();
		$where = array('exam_num' => $exam_num); 
		$data['normgen'] = $db3->normgen_queries->get_normgen_where('normgen',$where);

		$db4 = new choices_queries();
		$where = array('exam_num' => $exam_num); 
		$data['choice'] = $db4->choices_queries->get_choices_where('choices',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('selectsubexam',$data);
		$this->load->view('footer/footer');
	}

	public function modifysubexam($subexam_num = ''){

		$i=0;
		$j=0;
		$examnum=0;
		$arr=array();
		$arr2=array();

		$this->load->model('subexam_queries');
		$where = array('subexam_num' => $subexam_num); 
		$data['subexams'] = $this->subexam_queries->get_subexam_where('subexam',$where);

		foreach ($data['subexams'] as $data_item) {
			$examnum = $data_item->exam_num;
		}

		$db2 = new exam_queries();
		$where = array('exam_num' => $examnum); 
		$data['exams'] = $db2->exam_queries->pass_exam_num('exam',$where);

		$db3 = new items_queries();
		$where = array('subexam_num' => $subexam_num); 
		$data['item'] = $db3->items_queries->get_item_where('items',$where);

		$db4 = new normsub_queries();
		$where = array('subexam_num' => $subexam_num); 
		$data['normsub'] = $db4->normsub_queries->pass_exam_num('normsub',$where);
    			


		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('subexam',$data);
		$this->load->view('footer/footer');
	}

	public function normsubpage($subexamnum = ''){

		$this->load->model('subexam_queries');
		$where = array('subexam_num' => $subexamnum); 
		$data['subexams'] = $this->subexam_queries->get_subexam_where('subexam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('addnormsub',$data);
		$this->load->view('footer/footer');
	}

	public function itemspage($subexam_num = ''){

		$this->load->model('subexam_queries');
		$where = array('subexam_num' => $subexam_num); 
		$data['subexams'] = $this->subexam_queries->get_subexam_where('subexam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('additem',$data);
		$this->load->view('footer/footer');
	}

	public function choicespage($item_id = ''){

		$this->load->model('items_queries');
		$where = array('item_id' => $item_id); 
		$data['item'] = $this->items_queries->get_item_where('items',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('addchoice',$data);
		$this->load->view('footer/footer');
	} 

	
	public function addnormgen(){

		unset($_SESSION['normgen_error']);
		$db = new normgen_queries();
		$chk = 0;
		$exam_num = $this->input->post('exam_num');
		$normgenname = $this->input->post('name');
		$min = $this->input->post('min');
		$max = $this->input->post('max');
		$where = array('exam_num' => $exam_num);
  		$data['chk_normgen'] = $db->normgen_queries->get_normgen_where('normgen',$where);
  		foreach ($data['chk_normgen'] as $data_item) {
  			if($normgenname == $data_item->name){
  				$chk = 1;
  			}elseif($min == $data_item->min){
  				$chk = 3;
  			}elseif($max == $data_item->max){
  				$chk = 4;
  			}
  		}
  		if($min > $max){
  			$chk = 2;
  		}  		
  		if($chk == 0){
  		unset($_SESSION['normgen_error']);
		$db->exam_num =  $exam_num;
		$db->min =  $min;
		$db->max =  $max;
		$db->name =  $normgenname;

		$db->add_normgen();

		$db3 = new subexam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['subexams'] = $db3->subexam_queries->get_subexam_where('subexam',$where);

		$db2 = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db2->exam_queries->pass_exam_num('exam',$where);

		$db = new normgen_queries();
		$where = array('exam_num' => $exam_num); 
		$data['normgen'] = $db->normgen_queries->get_normgen_where('normgen',$where);

		$db4 = new choices_queries();
		$where = array('exam_num' => $exam_num); 
		$data['choice'] = $db4->choices_queries->get_choices_where('choices',$where);

  		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('selectsubexam',$data);
		$this->load->view('footer/footer');
		}elseif($chk == 1){
			$_SESSION['normgen_error'] = "General Norm not added: Duplicate General Norm exists";
			$this->modifyexam($exam_num);
		}elseif($chk == 2){
			$_SESSION['normgen_error'] = "General Norm not added: General Norm Minimum Value cannot be greater than the General Norm Maximum Value";
			$this->modifyexam($exam_num);
		}elseif($chk == 3){
			$_SESSION['normgen_error'] = "General Norm not added: Duplicate General Norm Min value exists";
			$this->modifyexam($exam_num);
		}elseif($chk == 4){
			$_SESSION['normgen_error'] = "General Norm not added: Duplicate General Norm Max value exists";
			$this->modifyexam($exam_num);
		}

	}
	public function finishcreate($exam_num = ''){
		$examnum = $exam_num;
		$chk = 0;
		$db = new exam_queries();
		$db2 = new subexam_queries();
		$db3 = new normsub_queries();
		$db4 = new normgen_queries();
		$db5 = new items_queries();
		$db6 = new choices_queries();
		$where = array('exam_num' => $exam_num);
		$data['subexams'] = $db2->subexam_queries->get_subexam_where('subexam',$where);
		foreach($data['subexams'] as $data_item) {
			$subexam_num = $data_item->subexam_num;
			$where = array('subexam_num' => $subexam_num);
			$data['normsub'] = $db3->normsub_queries->pass_exam_num('normsub',$where);
			$data['items'] = $db5->items_queries->get_item_where('items',$where);
		}
		$where = array('exam_num' => $exam_num);
		$data['normgen'] = $db4->normgen_queries->get_normgen_where('normgen',$where);
		$data['choices'] = $db6->choices_queries->get_choices_where('choices',$where);
		if(empty($data['subexams']) || empty($data['normsub']) || empty($data['items']) || empty($data['choices']) || empty($data['normgen'])){
			$chk = 1;
		}
		

		if($chk == 0){
		unset($_SESSION['exam_error']);
		unset($_SESSION['subexam_error']);
		unset($_SESSION['normgen_error']);
		unset($_SESSION['normsub_error']);
		unset($_SESSION['item_error']);
		unset($_SESSION['choices_error']);
		unset($_SESSION['finishcreate_error']);
		$db = new exam_queries();
		$data['exams'] = $db->view_exam_list();

		$prmt = array();
   	    $prmt [] = array(
        'status' => 'succ'
        );
        $data['prmpt']= $prmt;

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('testingexam',$data);
		$this->load->view('footer/footer');
		}elseif($chk == 1){
			$_SESSION['finishcreate_error'] = "Cannot create exam: Incomplete Data";
			$this->modifyexam($examnum);
		}
	}
	public function addnormsub(){
		unset($_SESSION['normsub_error']);
		$db = new normsub_queries();
		$chk = 0;
		$exam_num = $this->input->post('exam_num');
		$normsubname = $this->input->post('name');
		$min = $this->input->post('min');
		$max = $this->input->post('max');
		$subexam_num = $this->input->post('subexam_num');
		$where = array('subexam_num' => $subexam_num);
  		$data['chk_normsub'] = $db->normsub_queries->pass_exam_num('normsub',$where);
		foreach ($data['chk_normsub'] as $data_item) {
  			if($normsubname == $data_item->name){
  				$chk = 1;
  			}elseif($min == $data_item->min){
  				$chk = 3;
  			}elseif($max == $data_item->max){
  				$chk = 4;
  			}
  		}
  		if($min > $max){
  			$chk = 2;
  		}  		
  		if($chk == 0){
		$db->exam_num =  $exam_num;
		$db->subexam_num =  $subexam_num;
		$db->min =  $min;
		$db->max =  $max;
		$db->name = $normsubname;

		$db->add_normsub();

		$db2 = new subexam_queries();
		$where = array('subexam_num' => $subexam_num); 
		$data['subexams'] = $this->subexam_queries->get_subexam_where('subexam',$where);

		foreach ($data['subexams'] as $data_item) {
			$examnum = $data_item->exam_num;
		}

		$db3 = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db3->exam_queries->pass_exam_num('exam',$where);

		$db4 = new normsub_queries();
		$where = array('subexam_num' => $subexam_num); 
		$data['normsub'] = $db4->normsub_queries->pass_exam_num('normsub',$where);

		$db5 = new items_queries();
		$where = array('subexam_num' => $subexam_num); 
		$data['item'] = $db5->items_queries->get_item_where('items',$where);


		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('subexam',$data);
		$this->load->view('footer/footer');

		}elseif($chk == 1){
			$_SESSION['normsub_error'] = "Sub Norm not added: Duplicate Sub Norm exists";
			$this->modifysubexam($subexam_num);
		}elseif($chk == 2){
			$_SESSION['normsub_error'] = "Sub Norm not added: General Norm Minimum Value cannot be greater than the General Norm Maximum Value";
			$this->modifysubexam($subexam_num);
		}elseif($chk == 3){
			$_SESSION['normsub_error'] = "Sub Norm not added: Duplicate Sub Norm Min value exists";
			$this->modifysubexam($subexam_num);
		}elseif($chk == 4){
			$_SESSION['normsub_error'] = "Sub Norm not added: Duplicate Sub Norm Max value exists";
			$this->modifysubexam($subexam_num);
		}

	}
	public function additem(){
		unset($_SESSION['item_error']);
		$db = new items_queries();
		$chk = 0;
		$exam_num;
		$subexam_num = $this->input->post('subexam_num');
		$db2 = new subexam_queries();
		$where = array('subexam_num' => $subexam_num);
		$data['subexams'] = $db2->subexam_queries->get_subexam_where('subexam',$where);
		foreach ($data['subexams'] as $data_item) {
			$exam_num = $data_item->exam_num;
		}
		$question = $this->input->post('question');
		$item_no = $this->input->post('item_no');
		$where = array('exam_num' => $exam_num);
		$data['chk_item'] = $db->items_queries->get_item_where('items',$where);
		foreach ($data['chk_item'] as $data_item) {
			if($question == $data_item->question){
  				$chk = 1;
  			}
  			elseif($item_no == $data_item->item_no) {
  				$chk = 2;
  			}
		}
		if($chk == 0){
		$db->exam_num =  $exam_num;
		$db->question =  $question;
		$db->subexam_num =  $subexam_num;
		$db->item_no =  $item_no;

		$db->add_item();

		$db3 = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db3->exam_queries->pass_exam_num('exam',$where);

		$db4 = new normsub_queries();
		$where = array('subexam_num' => $subexam_num); 
		$data['normsub'] = $db4->normsub_queries->pass_exam_num('normsub',$where);

		$db5 = new items_queries();
		$where = array('subexam_num' => $subexam_num); 
		$data['item'] = $db5->items_queries->get_item_where('items',$where);


		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('subexam',$data);
		$this->load->view('footer/footer');

		}elseif($chk == 1){
			$_SESSION['item_error'] = "Item not added: Duplicate Question exists";
			$this->modifysubexam($subexam_num);
		}elseif($chk == 2){
			$_SESSION['item_error'] = "Item not added: Item number conflict";
			$this->modifysubexam($subexam_num);
		}
	}
	public function addchoice(){
		unset($_SESSION['choices_error']);
		$chk = 0;
		$exam_num;
		$db = new choices_queries();

		$exam_num = $this->input->post('exam_num');
		$item_choice = $this->input->post('choice');
		$point_equivalent = $this->input->post('point_equivalent');
		$where = array('exam_num' => $exam_num);
		$data['chk_choice'] = $db->choices_queries->get_choices_where('choices',$where);
		foreach ($data['chk_choice'] as $data_item) {
			if($item_choice == $data_item->choice){
  				$chk = 1;
  			}
		}
		if($chk == 0){
		$db->exam_num = $exam_num;
		$db->choice =  $item_choice;
		$db->point_equivalent =  $point_equivalent;

		$db->add_choice();


		$db3 = new subexam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['subexams'] = $db3->subexam_queries->get_subexam_where('subexam',$where);

		$db2 = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db2->exam_queries->pass_exam_num('exam',$where);

		$db4 = new normgen_queries();
		$where = array('exam_num' => $exam_num); 
		$data['normgen'] = $db4->normgen_queries->get_normgen_where('normgen',$where);

		$db6 = new choices_queries();
		$where = array('exam_num' => $exam_num); 
		$data['choice'] = $db6->choices_queries->get_choices_where('choices',$where);


		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('selectsubexam',$data);
		$this->load->view('footer/footer');

		}elseif($chk == 1){
			$_SESSION['choices_error'] = "Choice not added: Duplicate Choice exists";
			$this->modifyexam($exam_num);
		}
	}
	public function deletesubexam($subexam_num = '') {
		$exam_num = "";
		$db = new subexam_queries();
		$db4 = new normsub_queries();
		$db5 = new items_queries();
		$db6 = new choices_queries();
		$where = array('subexam_num' => $subexam_num); 
		$data['subexam'] = $db->subexam_queries->get_subexam_where('subexam',$where);

		foreach($data['subexam'] as $data_item) {	
			$exam_num = $data_item->exam_num;
		}

		$where = array('subexam_num' => $subexam_num);
		$db5->items_queries->delete_item('items',$where);
		$db4->normsub_queries->delete_normsub('normsub',$where);
		$db->subexam_queries->delete_subexam('subexam',$where);

		$where = array('exam_num' => $exam_num); 
		$data['subexams'] = $this->subexam_queries->get_subexam_where('subexam',$where);

		$db2 = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db2->exam_queries->pass_exam_num('exam',$where);

		$db3 = new normgen_queries();
		$where = array('exam_num' => $exam_num); 
		$data['normgen'] = $db3->normgen_queries->get_normgen_where('normgen',$where);

		$db4 = new choices_queries();
		$where = array('exam_num' => $exam_num); 
		$data['choice'] = $db4->choices_queries->get_choices_where('choices',$where);

  		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('selectsubexam',$data);
		$this->load->view('footer/footer');

	}
	public function deletenormgen($norm_id = '') {
		$exam_num = "";
		$db = new normgen_queries();
		$where = array('norm_id' => $norm_id); 
		$data['normgen'] = $db->normgen_queries->get_normgen_where('normgen',$where);

		foreach($data['normgen'] as $data_item) {	
			$exam_num = $data_item->exam_num;
		}

		$where = array('norm_id' => $norm_id); 
		$db->normgen_queries->delete_normgen('normgen',$where);

		$where = array('exam_num' => $exam_num); 
		$data['subexams'] = $this->subexam_queries->get_subexam_where('subexam',$where);

		$db2 = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db2->exam_queries->pass_exam_num('exam',$where);

		$db3 = new normgen_queries();
		$where = array('exam_num' => $exam_num); 
		$data['normgen'] = $db3->normgen_queries->get_normgen_where('normgen',$where);

  		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('selectsubexam',$data);
		$this->load->view('footer/footer');
	}
	public function deletenormsub($norm_id = '') {
		$subexam_num = '';
		$db = new normsub_queries();
		$where = array('norm_id' => $norm_id); 
		$data['normsub'] = $db->normsub_queries->pass_exam_num('normsub',$where);

		foreach($data['normsub'] as $data_item) {	
			$subexam_num = $data_item->subexam_num;
		}

		$where = array('norm_id' => $norm_id); 
		$db->normsub_queries->delete_normsub('normsub',$where);	
		$this->modifysubexam($subexam_num);
	}
	public function deleteitem($item_id = ''){
		$subexam_num = '';
		$db = new items_queries();
		$where = array('item_id' => $item_id); 
		$data['items'] = $db->items_queries->get_item_where('items',$where);
		foreach($data['items'] as $data_item) {	
			$subexam_num = $data_item->subexam_num;
		}
	
		$db->items_queries->delete_item('items',$where);	

		$this->modifysubexam($subexam_num);
	}
	public function deletechoice($choice_id = ''){
		$exam_num = '';
		$db = new choices_queries();
		$where = array('choices_id' => $choice_id); 
		$data['choices'] = $db->choices_queries->get_choices_where('choices',$where);
		foreach($data['choices'] as $data_item) {	
			$exam_num = $data_item->exam_num;
		}
		$where = array('choices_id' => $choice_id); 
		$db->choices_queries->delete_choices('choices',$where);	

		$this->modifyexam($exam_num);
	}
	public function availableexams($clientnum = ''){
		$examnum;
		$i=0;
		$arr=array();

		$db = new container_queries();
		$where = array('client_num' => $clientnum, 'con' => 'active'); 
		$data['container'] = $db->container_queries->get_container_where('container',$where);

		foreach ($data['container'] as $data_item) {	
			$examnum = $data_item->exam_num;
			$stat = $data_item->status;

			if($stat != 'finish'){
			$db2 = new exam_queries();
			$where = array('exam_num' => $examnum); 
			$data['exams'] = $db2->exam_queries->pass_exam_num('exam',$where);

			foreach($data['exams'] as $data_item1){
				$arr[$i]['exam_num']= $data_item1->exam_num;
    			$arr[$i]['exam_name']= $data_item1->exam_name;
      		}
      		}
      		$i++;
      	}
		
		$data['array']=$arr;
		$this->load->view('header/header');
		$this->load->view('sidebar/studentsidebar');
		$this->load->view('studentexamslist',$data);
		$this->load->view('footer/footer');

	}
	public function examspage($exam_num = ''){
		$arr=array();
		$arr2=array();
		$subexam_num;

		$db = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db->exam_queries->pass_exam_num('exam',$where);

		$db2 = new subexam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['subexam'] = $db2->subexam_queries->get_subexam_where('subexam',$where);

		foreach ($data['subexam'] as $data_item) {
			$subexam_num = $data_item->subexam_num;
		}

		$db3 = new items_queries();
		$where = array('exam_num' => $exam_num); 
		$data['item'] = $db3->items_queries->get_item_where('items',$where);

		$db4 = new choices_queries();
		$where = array('exam_num' => $exam_num); 
		$data['choice'] = $db4->choices_queries->get_choices_where('choices',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/takeexamsidebar');
		$this->load->view('exam',$data);
		$this->load->view('footer/footer');
	}
	public function scoring(){

		$this->load->library('form_validation');
		$total_items = 0;
		$examnum = $this->input->post('exam_num');
		$clientnum = $this->input->post('client_num');
		$tot = 0;
		$i=0;
		$j=0;
		$k=0;
		$arr=array();
		$arr2=array();
		$arr3=array();
		$ans_arr=array();
		$resultsub_arr=array();
		$choice_arr=array();
		$raw_score = 0;
		$no_subexams = 0;
		$normsub_no = 0;
		$refnum;
		$num_of_takers=0;
		$tot=0;

		$db = new exam_queries();
		$where = array('exam_num' => $examnum); 
		$data['exams'] = $db->exam_queries->pass_exam_num('exam',$where);

		$db2 = new subexam_queries();
		$where = array('exam_num' => $examnum); 
		$data['subexam'] = $db2->subexam_queries->get_subexam_where('subexam',$where);

		$db3 = new items_queries();
		$where = array('exam_num' => $examnum); 
		$data['item'] = $db3->items_queries->get_item_where('items',$where);

		$db5 = new container_queries();
			$where = array('exam_num' => $examnum, 'client_num' => $clientnum); 
			$data['cont'] = $db5->container_queries->get_container_where('container',$where);

			foreach($data['cont'] as $data_item){
				$refnum = $data_item->ref_num;
			}

		foreach($data['item'] as $data_item){
			if($data_item->exam_num == $examnum){
				$total_items++;
			}
			$item_id = $data_item->item_id;
			$arr[$i]['item_id'] = $data_item->item_id;
			$arr[$i]['ques'] = $data_item->question;
			$arr[$i]['item_no'] = $data_item->item_no;
			$arr[$i]['subexam_num'] = $data_item->subexam_num;


			$i++;
		}
			$db4 = new choices_queries();
			$where = array('exam_num' => $examnum); 
			$data['choice'] = $db4->choices_queries->get_choices_where('choices',$where);

			foreach($data['choice'] as $data_item1){
				$arr2[$j]['choice_id'] = $data_item1->choices_id;
    			$arr2[$j]['choice'] = $data_item1->choice;
    			$arr2[$j]['point_equivalent'] = $data_item1->point_equivalent;

    			$j++;
      		}

      		foreach ($data['subexam'] as $data_item) {
      			$no_subexams++;
      			$arr3[$k]['subexam_num']  = $data_item->subexam_num;

      			$k++;
      		}


		for($i=0; $i != $total_items; $i++){
			$this->form_validation->set_rules($arr[$i]['item_id'], 'Answer', 'required');
			if ($this->form_validation->run()) {
			  $ans_arr[$i]['ans_choice_id'] = $this->input->post($arr[$i]['item_id']);
			  $ans_arr[$i]['ans_subexam_num'] = $arr[$i]['subexam_num'];
			  $where = array('choices_id' => $ans_arr[$i]['ans_choice_id']); 
			  $data['choice'] = $db4->choices_queries->get_choices_where('choices',$where);


			  foreach($data['choice'] as $data_item2){
					$ans_arr[$i]['ans_point_equivalent'] = $data_item2->point_equivalent;
      				$raw_score += $ans_arr[$i]['ans_point_equivalent'];
      			}


			  
			}else{
			  $error = validation_errors();
			}
		}

		for($i=0; $i < $no_subexams; $i++){
			$resultsub_arr[$i]['subexam_total'] = 0;
			$resultsub_arr[$i]['subexamnum'] = $arr3[$i]['subexam_num'];

		}
		for($i=0; $i < $no_subexams; $i++){
			for($j=0; $j < $total_items; $j++){
				if($resultsub_arr[$i]['subexamnum'] == $ans_arr[$j]['ans_subexam_num']){
					$resultsub_arr[$i]['subexam_total'] += $ans_arr[$j]['ans_point_equivalent'];
				}
			}
		}

		$db6 = new normsub_queries();
		$where = array('exam_num' => $examnum);
		$data['normsub'] = $db6->pass_exam_num('normsub', $where);

		for($i=0; $i < $no_subexams; $i++){
			foreach ($data['normsub'] as $data_item) {
					if($data_item->subexam_num == $resultsub_arr[$i]['subexamnum']){
						if($resultsub_arr[$i]['subexam_total'] >= $data_item->min  && $resultsub_arr[$i]['subexam_total'] <= $data_item->max){

							$db7 = new resultsub_queries();

							$db7->ref_num = $refnum;
							$db7->exam_num = $data_item->exam_num;
							$db7->subexam_num = $resultsub_arr[$i]['subexamnum'];
							$db7->total = $resultsub_arr[$i]['subexam_total'];
							$db7->result = $data_item->name;

							$db7->add_resultsub();
						}
					}
			}
		}

		$resultgen_arr = array(
						$resultgen_arr['ref_num'] = 0,
						$resultgen_arr['exam_num'] = 0,
						$resultgen_arr['subexam_num'] = 0,
							);
		$resultgen_raw = 0;
		$db7 = new resultsub_queries();
		$where = array('exam_num' => $examnum);
		$data['resultsub'] = $db7->get_resultsub_where('resultsub', $where);
		foreach($data['resultsub'] as $data_item){
			if($data_item->exam_num == $examnum){
				$resultgen_arr['ref_num'] = $data_item->ref_num;
				$resultgen_arr['exam_num'] = $data_item->exam_num;
				$resultgen_arr['subexam_num'] = $data_item->subexam_num;
				$resultgen_raw = $raw_score;
			}
		}
		$resultgen_tot = $resultgen_raw;
		$resultgen_arr['resultgen_total'] = $resultgen_tot;

		$db8 = new normgen_queries();
		$where = array('exam_num' => $examnum);
		$data['normgen'] = $db8->get_normgen_where('normgen', $where);

		foreach ($data['normgen'] as $data_item) {
			if($resultgen_tot >= $data_item->min  && $resultgen_tot <= $data_item->max){
				
				$db9 = new resultgen_queries();

				$refnum = $resultgen_arr['ref_num'];
				$db9->ref_num = $refnum;
				$db9->exam_num = $resultgen_arr['exam_num'];
				$db9->total = $resultgen_arr['resultgen_total'];
				$db9->result = $data_item->name;
				$db9->date = date("Y-m-d");

				$db9->add_resultgen();
			}	
		}

		$db5 = new container_queries();
		$where = array('exam_num' => $examnum, 'client_num' => $clientnum);
		$data = array(
		 	'status' => "finish"
		);
		$db5->update_con('container', $where, $data);

		$this->load->model('exam_queries');
		$where = array('exam_num' => $examnum);
		$data['exm']=$this->exam_queries->get_exam('exam',$where);
		foreach ($data['exm'] as $data_exam) {
			$tot = $data_exam->total;	
			$num_takers = $data_item->no_of_takers;	
		}
		$num_takers--;
		$tot++;
		$exms = array(
			'total' => $tot, 
			'no_of_takers' => $num_takers
			);
		$db->update_exam('exam', $where, $exms);

		redirect('Page/examresults/'.$refnum);
	}
	public function editexam($exam_num = ''){
		$db = new exam_queries();
  		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db->exam_queries->pass_exam_num('exam',$where);

		$db2 = new subexam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['subexams'] = $db2->subexam_queries->get_subexam_where('subexam',$where);

		$db3 = new normgen_queries();
		$where = array('exam_num' => $exam_num); 
		$data['normgen'] = $db3->normgen_queries->get_normgen_where('normgen',$where);

		$db4 = new choices_queries();
		$where = array('exam_num' => $exam_num); 
		$data['choice'] = $db4->choices_queries->get_choices_where('choices',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('selectsubexam',$data);
		$this->load->view('footer/footer');
	}
	public function editexamname($exam_num = ''){
		$db = new exam_queries();
  		$where = array('exam_num' => $exam_num); 

  		$data = array(
			'exam_name' => $this->input->post('exam_name')
		);
		$db->update_exam('exam', $where, $data);

		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db->exam_queries->pass_exam_num('exam',$where);

		$db2 = new subexam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['subexams'] = $db2->subexam_queries->get_subexam_where('subexam',$where);

		$db3 = new normgen_queries();
		$where = array('exam_num' => $exam_num); 
		$data['normgen'] = $db3->normgen_queries->get_normgen_where('normgen',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('selectsubexam',$data);
		$this->load->view('footer/footer');
	}
	public function editsubexamname($subexam_num = ''){
		$db = new subexam_queries();
  		$where = array('subexam_num' => $subexam_num);

  		$data = array(
			'subexam_name' => $this->input->post('subexam_name')
		);
		$db->update_subexam('subexam', $where, $data);

		$this->modifysubexam($subexam_num);
	}
	public function editnormgenpage($norm_id = ''){
		$db = new normgen_queries();
		$where = array('norm_id' => $norm_id); 
		$data['normgen'] = $db->normgen_queries->get_normgen_where('normgen',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('editnormgen',$data);
		$this->load->view('footer/footer');
	} 
	public function editnormgen(){
		unset($_SESSION['normgen_edit_error']);
		$db = new normgen_queries();

		$chk = 0;
		$norm_id = $this->input->post('norm_id');
		$exam_num = $this->input->post('exam_num');
		$name = $this->input->post('name');
		$min = $this->input->post('min');
		$max = $this->input->post('max');


		$where = array('exam_num' => $exam_num); 
		$data['chk_normgen'] = $db->normgen_queries->get_normgen_where('normgen',$where);

		foreach ($data['chk_normgen'] as $data_item) {
  			
  			if($min > $max){
  				$chk = 2;
  			}
  		}  		
  		if($chk == 0){
  			unset($_SESSION['normgen_edit_error']);
			$where = array('norm_id' => $norm_id);
			$data = array(
				'name' => $name,
				'min' => $min,
				'max' => $max
			);
			$db->update_normgen('normgen', $where, $data);

			$this->editexam($exam_num);
		}elseif($chk == 2){
			$_SESSION['normgen_edit_error'] = "General Norm not edited: General Norm Minimum Value cannot be greater than the General Norm Maximum Value";
			$this->editnormgenpage($norm_id);
		}elseif($chk == 3){
			$_SESSION['normgen_edit_error'] = "General Norm not edited: Duplicate General Norm Min value exists";
			$this->editnormgenpage($norm_id);
		}elseif($chk == 4){
			$_SESSION['normgen_edit_error'] = "General Norm not edited: Duplicate General Norm Max value exists";
			$this->editnormgenpage($norm_id);
		}
	}
	public function editnormsubpage($norm_id = ''){
		unset($_SESSION['normsub_edit_error']);

		$db = new normsub_queries();
		$where = array('norm_id' => $norm_id); 
		$data['normsub'] = $db->normsub_queries->pass_exam_num('normsub',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('editnormsub',$data);
		$this->load->view('footer/footer');
	} 
	public function editnormsub(){
		$db = new normsub_queries();

		$chk = 0;
		$norm_id = $this->input->post('norm_id');
		$exam_num = $this->input->post('exam_num');
		$subexam_num = $this->input->post('subexam_num');
		$name = $this->input->post('name');
		$min = $this->input->post('min');
		$max = $this->input->post('max');


		$where = array('subexam_num' => $subexam_num); 
		$data['chk_normsub'] = $db->normsub_queries->pass_exam_num('normsub',$where);

		foreach ($data['chk_normsub'] as $data_item) {
  			if($min > $max){
  				$chk = 2;
  			}
  		}  		
		if($chk == 0){
  		unset($_SESSION['normgen_edit_error']);
		$where = array('norm_id' => $norm_id);
		$data = array(
			'name' => $this->input->post('name'),
			'min' => $this->input->post('min'),
			'max' => $this->input->post('max')
		);
		$db->update_normsub('normsub', $where, $data);

		$this->modifysubexam($subexam_num);
		}elseif($chk == 2){
			$_SESSION['normsub_edit_error'] = "Sub Norm not edited: Sub Norm Minimum Value cannot be greater than the Sub Norm Maximum Value";
			$this->editnormsubpage($norm_id);
		}elseif($chk == 3){
			$_SESSION['normsub_edit_error'] = "Sub Norm not edited: Duplicate Sub Norm Min value exists";
			$this->editnormsubpage($norm_id);
		}elseif($chk == 4){
			$_SESSION['normsub_edit_error'] = "Sub Norm not edited: Duplicate Sub Norm Max value exists";
			$this->editnormsubpage($norm_id);
		}
	}
	public function edititempage($item_id = ''){

		$db = new items_queries();
		$where = array('item_id' => $item_id); 
		$data['item'] = $db->items_queries->get_item_where('items',$where);


		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('edititem',$data);
		$this->load->view('footer/footer');
	}
	public function edititem(){
		$db = new items_queries();

		$item_id = $this->input->post('item_id');
		$where = array('item_id' => $item_id);
		$data['item'] = $db->items_queries->get_item_where('items',$where);

		foreach ($data['item'] as $data_item) {
			$subexam_num = $data_item->subexam_num;
		}

		$data = array(
			'question' => $this->input->post('question'),
			'item_no' => $this->input->post('item_no')
		);
		$db->update_items('items', $where, $data);

		$this->modifysubexam($subexam_num);
	}
	public function editchoicepage($choices_id = ''){

		$db = new choices_queries();
		$where = array('choices_id' => $choices_id); 
		$data['choice'] = $db->choices_queries->get_choices_where('choices',$where);


		$this->load->view('header/header');
		$this->load->view('sidebar/createexamsidebar');
		$this->load->view('editchoice',$data);
		$this->load->view('footer/footer');
	}
	public function editchoice(){
		$db = new choices_queries();
		$exam_num = '';

		$choice_id = $this->input->post('choices_id');
		$where = array('choices_id' => $choice_id); 
		$data['choice'] = $db->choices_queries->get_choices_where('choices',$where);
		foreach ($data['choice']  as $data_item) {
			$exam_num = $data_item->exam_num;
		}
		$where = array('choices_id' => $choice_id); 
		$data = array(
			'choice' => $this->input->post('choice'),
			'point_equivalent' => $this->input->post('point_equivalent')
		);
		$db->update_choices('choices', $where, $data);

		$this->modifyexam($exam_num);
	}
	public function cancelcreate(){


		unset($_SESSION['exam_error']);
		unset($_SESSION['subexam_error']);
		unset($_SESSION['normgen_error']);
		unset($_SESSION['normsub_error']);
		unset($_SESSION['item_error']);
		unset($_SESSION['choices_error']);
	}
	public function view_exam($exam_num = ''){
		$arr=array();
		$arr2=array();
		$subexam_num;

		$db = new exam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['exams'] = $db->exam_queries->pass_exam_num('exam',$where);

		$db2 = new subexam_queries();
		$where = array('exam_num' => $exam_num); 
		$data['subexam'] = $db2->subexam_queries->get_subexam_where('subexam',$where);

		foreach ($data['subexam'] as $data_item) {
			$subexam_num = $data_item->subexam_num;
		}

		$db3 = new items_queries();
		$where = array('exam_num' => $exam_num); 
		$data['item'] = $db3->items_queries->get_item_where('items',$where);

		$db4 = new choices_queries();
		$where = array('exam_num' => $exam_num); 
		$data['choice'] = $db4->choices_queries->get_choices_where('choices',$where);
		
		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('view_exam',$data);
		$this->load->view('footer/footer');
	}
}
 ?>