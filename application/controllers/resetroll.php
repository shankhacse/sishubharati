<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class resetroll extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('resetrollmodel','resetrollmodel',TRUE);
	}
	
	
	public function index()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-reset_roll/reset_roll_list_view.php';
			$result = [];
			$header = "";
			
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			
			//pre($result['gradeList']);
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function classStudentList()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			

			$result=[];
			
			if (isset($dataArry['sel_class'])) {
				$sel_class = $dataArry['sel_class'];
				
			$result['studentList'] = $this->resetrollmodel->getAllStudentsbyClass($session['yid'],$sel_class); 	
           
			}else{
					

           $result['studentList']=[];
			}


			//pre($result['studentList']);
			$page = "dashboard/adminpanel_dashboard/ds-reset_roll/reset_roll_list_data";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	public function resetRollByRank()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			
			$newroll = $dataArry['newroll'];
			$academic_id = $dataArry['academic_id'];
			
			
			$arraysize=count($academic_id);
			
			for ($i=0; $i <$arraysize ; $i++) { 
					
				
				$academic_details_updarray = array(
				'class_roll' => $newroll[$i],
				  );
				$upd_where = array('student_academic_details.academic_id' =>$academic_id[$i] );
				

		$update=$this->resetrollmodel->updateRollbyRank($academic_details_updarray,$upd_where);

				 
				}

				if($update)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Updated successfully",
							"mode" => "EDIT"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 0,
							"msg_data" => "There is some problem while updating ...Please try again."
						);
					}


					

			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



}//end of class