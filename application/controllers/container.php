<?php
class container extends CI_Controller{

	public function addexam(){
  		$db = new exam_queries();

  		$exam_name = $this->input->post('exam_name');
  		$db->exam_name = $this->input->post('exam_name');
  		$db->no_of_takers = 0;
  		$db->date_create = date("Y-m-d");

  		$db->add_exam();
  		$where = array('exam_name' => $exam_name); 
		$data['examnum'] = $this->exam_queries->pass_exam_num('exam',$where);

  		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('addexamtype',$data);
		$this->load->view('footer/footer');
	}
	public function addexamtype(){
  		$db = new subexam_queries();

  		$exam_num = $this->input->post('exam_num');
  		$db->exam_num =  $this->input->post('exam_num');
  		$db->subexam_name = $this->input->post('subexam_name');

  		$db->add_subexam();
  		$where = array('exam_num' => $exam_num); 
		$data['examnum'] = $this->subexam_queries->pass_exam_num('subexam',$where);

  		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('addnormsub',$data);
		$this->load->view('footer/footer');
	}

	public function normgenpage($exam_num = ''){

		$this->load->model('exam_queries');
		$where = array('exam_num' => $exam_num); 
		$data['exam'] = $this->exam_queries->pass_exam_num('exam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('addnormgen',$data);
		$this->load->view('footer/footer');
	} 

	public function subexamspage($exam_num = ''){

		$this->load->model('exam_queries');
		$where = array('exam_num' => $exam_num); 
		$data['examnum'] = $this->exam_queries->pass_exam_num('exam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('addexamtype',$data);
		$this->load->view('footer/footer');
	}

	public function subnormpage($subexam_num = ''){

		$this->load->model('subexam_queries');
		$where = array('subexam_num' => $subexam_num); 
		$data['examnum'] = $this->subexam_queries->pass_exam_num('subexam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('addnormsub',$data);
		$this->load->view('footer/footer');
	}

	public function itemspage($subexam_num = ''){

		$this->load->model('subexam_queries');
		$where = array('subexam_num' => $subexam_num); 
		$data['examnum'] = $this->subexam_queries->pass_exam_num('subexam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('additem',$data);
		$this->load->view('footer/footer');
	}

	public function choicespage($item_id = ''){

		$this->load->model('items_queries');
		$where = array('item_id' => $item_id); 
		$data['item'] = $this->items_queries->pass_item_id('items',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('addchoice',$data);
		$this->load->view('footer/footer');
	} 

	
	public function addnormgen(){
		$db = new normgen_queries();

		$db->exam_num =  $this->input->post('exam_num');
		$db->min =  $this->input->post('min');
		$db->max =  $this->input->post('max');
		$db->name =  $this->input->post('name');

		$db->add_normgen();

		$db2 = new exam_queries();

		$data['exams'] = $db2->view_exam_list();

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('testingexam', $data);
		$this->load->view('footer/footer');
	}
	public function addnormsub(){
		$db = new normsub_queries();

		$subexam_num = $this->input->post('subexam_num');
		$db->exam_num =  $this->input->post('exam_num');
		$db->subexam_num =  $this->input->post('subexam_num');
		$db->min =  $this->input->post('min');
		$db->max =  $this->input->post('max');
		$db->name =  $this->input->post('name');

		$db->add_normsub();
		$where = array('subexam_num' => $subexam_num); 
		$data['examnum'] = $this->normsub_queries->pass_exam_num('subexam',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('additem',$data);
		$this->load->view('footer/footer');
	}
	public function additem(){
		$db = new items_queries();

		$subexam_num = $this->input->post('subexam_num');
		$db->question =  $this->input->post('question');
		$db->subexam_num =  $this->input->post('subexam_num');
		$db->item_no =  $this->input->post('item_no');

		$db->add_item();
		$where = array('subexam_num' => $subexam_num); 
		$data['item'] = $this->items_queries->pass_item_id('items',$where);

		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('addchoice',$data);
		$this->load->view('footer/footer');
	}
	public function addchoice(){
		$db = new choices_queries();

		$item_id = $this->input->post('item_id');
		$db->item_id = $this->input->post('item_id');
		$db->choice =  $this->input->post('choice');
		$db->point_equivalent =  $this->input->post('point_equivalent');

		$db->add_choice();
		$where = array('item_id' => $item_id); 
		$data['choice'] = $this->choices_queries->pass_item_id('choices',$where);

		$this->finaltemp($data['choice']);
	}
	public function finaltemp($choice){

		$itemid;
		$subnormid;
		$subexamnum;
		$examnum;

		foreach($choice as $data_item){
      		$itemid = $data_item->item_id;
      		}

      	$db = new items_queries();
      	$where = array('item_id' => $itemid); 
		$data['item'] = $this->items_queries->pass_item_id('items',$where);
		foreach($data['item'] as $data_item){
      		$subexamnum = $data_item->subexam_num;
      		}

		$db2 = new subexam_queries();
		$where = array('subexam_num' => $subexamnum); 
		$data['subexam'] = $this->subexam_queries->pass_exam_num('subexam',$where);
		foreach($data['subexam'] as $data_item){
      		$examnum = $data_item->exam_num;
      		}

		$db3 = new normsub_queries();
		$where = array('subexam_num' => $subexamnum); 
		$data['normsub'] = $this->normsub_queries->pass_exam_num('normsub',$where);
		foreach($data['normsub'] as $data_item){
      		$subnormid = $data_item->norm_id;
      		}

      	$db4 = new exam_queries();
		$where = array('exam_num' => $examnum); 
		$data['exam'] = $this->exam_queries->pass_exam_num('exam',$where);


		$this->load->view('header/header');
		$this->load->view('sidebar/testingcentersidebar');
		$this->load->view('finaltemp',$data);
		$this->load->view('footer/footer');

	}
}
 ?>