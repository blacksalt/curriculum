<?php

class Curriculum extends MY_Controller
{

	function __construct()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->render('gate/login');
	}

	function view($id=0){
		$this->load->model('Curriculums_model');
		if($id!=0){
			for($y=1; $y<=7; $y++){
				for($s=1; $s<=3; $s++){
					$sem = 'sem'.$y.'-'.$s;
					$this->main['data'][$sem]='';
					$result = $this->Curriculums_model->get_subjects($id, $sem);
					foreach($result as $subject){
						$this->main['data'][$sem][] = $this->Curriculums_model->getprereq($subject);
					}
				}
			}
			$this->render('curriculum/planner');
		}
		else{
			$this->render('gate/home');
		}
		//$this->main['product_list'] = $this->Products_model->get_all();
		
		
	}
}

/* End of file Gate.php */
/* Location: ./system/application/controllers/Gate.php */
