<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class generaterank extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('generaterankmodel','generaterankmodel',TRUE);

	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master'); 
			$page = "dashboard/adminpanel_dashboard/ds-generate_rank/generate_rank_list_view";
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
			  $check=$this->commondatamodel->checkExistanceData('rank_master',$where);

							 if ($check) {
							 	$page = "dashboard/adminpanel_dashboard/ds-generate_rank/completed_generate_rank_list_data";

							 	$marksMasterData=$this->commondatamodel->getSingleRowByWhereCls('rank_master',$where);
							 	$rank_master_id=$marksMasterData->rank_master_id;
							 	$result['rank_master_id']=$rank_master_id;
							 $result['studentList']=$this->generaterankmodel->getAllStudentsbyRankmasterId($rank_master_id);	


							 }else{
							 	$page = "dashboard/adminpanel_dashboard/ds-generate_rank/generate_rank_list_data";	
							 	$result['studentList'] = $this->generaterankmodel->getAllStudentsbyClassRank($session['yid'],$sel_class);
							 }
			
			

			 	
           
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


	public function saveStudentRank()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$rankmasterID = trim(htmlspecialchars($dataArry['rankmasterID']));
			
			$mode = trim(htmlspecialchars($dataArry['mode']));
			$sel_class = trim(htmlspecialchars($dataArry['sel_class']));
			$student_uniq_id = $dataArry['student_uniq_id'];
			$academic_id = $dataArry['academic_id'];
			$studentname = $dataArry['studentname'];
			$academic_id = $dataArry['academic_id'];
			$class_roll = $dataArry['class_roll'];
			$rank = $dataArry['rank'];
			$grand_total = $dataArry['grand_total'];
			$arraysize=count($student_uniq_id);
			
			


				
				
				if($rankmasterID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					
					$update = 1;
					
					
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



				} // end if mode
				else
				{
					/*  ADD MODE
					 *	-----------------
					*/


					$rank_master_array = array(
					"class_id" => $sel_class,
					"session_id" => $session['yid'],
					"created_by" => $session['userid']
					
				    );

			$insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('rank_master',$rank_master_array);

				for ($i=0; $i <$arraysize ; $i++) { 
					
				
				$rank_details_array = array(
				'rank_master_id' => $insert_id ,
				'academic_id' => $academic_id[$i],
				'studentname' => $studentname[$i],
				'student_uniq_id' => $student_uniq_id[$i],
				'class_roll' => $class_roll[$i],
				'session_id' => $session['yid'],
				'rank' => $rank[$i],
				'grand_total' => $grand_total[$i],
				
				  );

				

		$insertrankDetailsData=$this->commondatamodel->insertSingleTableData('rank_details',$rank_details_array);

				 
				}

				$user_activity = array(
						"activity_date" => date("Y-m-d H:i:s"),
						"activity_module" => 'Generate Rank',
						"action" => 'Insert',
						"from_method" => 'generaterank/saveStudentRank',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform(),
						"login_time" => NULL,
						"logout_time" => NULL
					 );

						
				$insertData=$this->commondatamodel->insertSingleTableData('user_activity_report',$user_activity);	

					if($insertData)
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

				} // end add mode ELSE PART

	

			

			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('admin','refresh');
		}
	}


	public function deleteClassRank()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$rankmasterid = trim($this->input->post('rankmasterid'));
			
			
				
			$where_rank_master = array(
				"rank_master.rank_master_id" => $rankmasterid
				);
			$where_rank_details = array(
				"rank_details.rank_master_id" => $rankmasterid
				);
			
			
			
				$delete = $this->commondatamodel->DeleteData('rank_details',$where_rank_details);
				$delete1 = $this->commondatamodel->DeleteData('rank_master',$where_rank_master);
			if($delete1)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Successfully deleted"
				);
			}
			else
			{
				$json_response = array(
					"msg_status" => 0,
					"msg_data" => "Failed to delete"
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