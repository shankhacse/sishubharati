<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class temperrank extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('temperrankmodel','temperrankmodel',TRUE);
		$this->load->model('generaterankmodel','generaterankmodel',TRUE);

	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			$result['classList']=$this->temperrankmodel->getClassFromRankMasterList(); 
			$page = "dashboard/adminpanel_dashboard/ds-temper_rank/temper_rank_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('admin','refresh');
		}
	}


public function classStudentListRankWise()
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
				$result['selectclass']=	$sel_class;

				$where = array(
								'rank_master.session_id' => $session['yid'],
								'rank_master.class_id' => $sel_class,
								 );
			 

							 	$page = "dashboard/adminpanel_dashboard/ds-temper_rank/temper_generate_rank_list_data";	
							 	$marksMasterData=$this->commondatamodel->getSingleRowByWhereCls('rank_master',$where);
							 	$rank_master_id=$marksMasterData->rank_master_id;
							 	$result['rank_master_id']=$rank_master_id;
							 $result['studentList']=$this->generaterankmodel->getAllStudentsbyRankmasterId($rank_master_id);
							
			
			

			 	
           
			}else{
					

           $result['studentList']=[];
			}


			
			
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('admin','refresh');
		}
	}



		public function UpdateTemperStudentRank()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			
			$rank_details_id = $dataArry['rank_details_id'];
			$rank = $dataArry['rank'];
			
			$arraysize=count($rank);

			for ($i=0; $i <$arraysize ; $i++) {

				$where = array('rank_details.rank_details_id' => $rank_details_id[$i] );

				$rank_details_array = array(
				'rank' => $rank[$i] ,
				 
				 );


				$update=$this->temperrankmodel->updateSingleTableData('rank_details',$rank_details_array,$where);

			 }
			
			


				

		if($update)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Saved successfully",
							"mode" => "ADD"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 0,
							"msg_data" => "There is some problem.Try again"
						);
					}

			

			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('admin','refresh');
		}
	}


	public function UpdateStudentRollIndviduals()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			
			$academic_id = $dataArry['acdid'];
			$oldroll = $dataArry['oldroll'];
			$roll = $dataArry['roll'];
			$classid = $dataArry['classid'];
			
		
			if ($roll!=$oldroll) {
				$where = array(
								'student_academic_details.session_id' => $session['yid'],
								'student_academic_details.class_id' => $classid,
								'student_academic_details.class_roll' => $roll,
								'student_academic_details.is_active' => 'Y'
								 );
				 $check=$this->commondatamodel->rowcountwhere('student_academic_details',$where);
			}else{
				$check=0;
			}
		
				if($check==0){
				$where = array('student_academic_details.academic_id' => $academic_id );
	
				$acd_details_array = array(
				'class_roll' => $roll ,
				 
				 );


				$update=$this->temperrankmodel->updateSingleTableData('student_academic_details',$acd_details_array,$where);

			

		if($update)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Update successfully",
							"mode" => "ADD"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 0,
							"msg_data" => "There is some problem.Try again"
						);
					}

			}else{

				$json_response = array(
							"msg_status" => 0,
							"msg_data" => "Roll no already assigned."
						);

			}

			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('admin','refresh');
		}
	}

}//end of class