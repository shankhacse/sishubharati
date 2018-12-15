<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class transferstudent extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('transferstudentmodel','transferstudentmodel',TRUE);
		$this->load->model('admissionmodel','admmodel',TRUE);
	
	}
	
	
	public function index()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-transfer/transfer_student_list_view';
			$result = [];
			$header = "";
			$session_id=$session['yid'];
			$result['classList']=$this->transferstudentmodel->getClassListForTransfer($session_id);
			//pre($result['classList']);
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function transfer_status()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-transfer/transfer_status_list_view';
			$result = [];
			$header = "";
			$session_id=$session['yid'];
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	public function classStudentListToTransfer()
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
				$result['from_class_id']=$sel_class;
				$session_id=$session['yid'];
				
				//current class Data
				$where_cls = array('class_master.id' => $sel_class, );
				$ClassMasterData=$this->commondatamodel->getSingleRowByWhereCls('class_master',$where_cls);
				$result['frm_class_name']=$ClassMasterData->name;
				
				//current academic session data
				$where_session = array('session_year.session_id' => $session_id, );
				$SessionYearData=$this->commondatamodel->getSingleRowByWhereCls('session_year',$where_session);
				$result['frm_session_id']=$SessionYearData->session_id;
				$result['frm_session_year']=$SessionYearData->year;

				//next class Data
				$where_next_cls = array('class_master.id' => $sel_class+1, );
				$result['nextClassMasterData']=$this->commondatamodel->getSingleRowByWhereCls('class_master',$where_next_cls);
				
				//next academic session data
				$where_next_session = array(
											'session_year.session_id' => $session_id+1,
											'session_year.is_active' => 'Y',
											 );
				$result['nextSessionYearData']=$this->commondatamodel->getSingleRowByWhereCls('session_year',$where_next_session);
				

			

			
			$where = array(
							'rank_master.class_id' => $sel_class,
							'rank_master.session_id' => $session_id
						);
			$rankMasterData=$this->commondatamodel->getSingleRowByWhereCls('rank_master',$where);
			 if ($rankMasterData) {
			$rank_master_id=$rankMasterData->rank_master_id;
			
				
				 	
				$result['studentList'] =$this->transferstudentmodel->getStudentForTransfer($rank_master_id); 
			     }else{$result['studentList']=[];}
           
			}else{
					

           $result['studentList']=[];
			}


			//pre($result['studentList']);exit;
			$page = "dashboard/adminpanel_dashboard/ds-transfer/transfer_student_list_data";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	/* save transfer student*/

    public function transfer_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$rank = $dataArry['rank'];
			$chkstudent = $dataArry['chkstudent'];
			$student_uniq_id = $dataArry['student_uniq_id'];
			$from_sel_class = $dataArry['from_sel_class'];
			$from_sel_session = $dataArry['from_sel_session'];
			$next_sel_class = $dataArry['next_sel_class'];
			$next_sel_session = $dataArry['next_sel_session'];

			$arraysize=count($student_uniq_id);
			
			
			
			
			$transfer_master_array = array(
					"class_master_id" => $from_sel_class,
					"session_id" => $session['yid'],
					"created_by" => $session['userid']
					
				    );

			$insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('transfer_master',$transfer_master_array);

		for ($i=0; $i <$arraysize ; $i++) { 
					if ($chkstudent[$i]=='P') {

								$transfer_details_array = array(
								'transfer_master_id' => $insert_id ,
								'student_uniq_id' => $student_uniq_id[$i],
								'rank' => $rank[$i],
								'from_class_id' => $from_sel_class,
								'next_class_id' => $next_sel_class,
								'from_session_id' => $from_sel_session,
								'next_session_id' => $next_sel_session,
								'status' => $chkstudent[$i],
								
								  );

				

					$insertTransferDetailsData=$this->commondatamodel->insertSingleTableData('transfer_details',$transfer_details_array);

					$academic_details = array(
							'student_uniq_id' => $student_uniq_id[$i], 
							'class_id' => $next_sel_class, 
							'class_roll' => $rank[$i], 
							'session_id' => $next_sel_session, 
							'rank' => $rank[$i],
							'created_by' => $session['userid'], 
							'transfer_master_id' => $insert_id, 
						);

						$insertAcafemicDetailsData=$this->commondatamodel->insertSingleTableData('student_academic_details',$academic_details);

					
					}else{

						$data['lastRollData'] = $this->admmodel->getLastClassRoll($from_sel_class,$next_sel_session);

									if (sizeof($data['lastRollData'])=='0') {
								     	$classrole=1;
								     }else{
								     	foreach ($data['lastRollData'] as $value) {
								         $lastroll=$value->class_roll;
								       }

								       $classrole=$lastroll+1;

								      }


							$transfer_details_array = array(
								'transfer_master_id' => $insert_id ,
								'student_uniq_id' => $student_uniq_id[$i],
								'rank' => $rank[$i],
								'from_class_id' => $from_sel_class,
								'next_class_id' => $from_sel_class,
								'from_session_id' => $from_sel_session,
								'next_session_id' => $next_sel_session,
								'status' => $chkstudent[$i],
								
								  );
							$insertTransferDetailsData=$this->commondatamodel->insertSingleTableData('transfer_details',$transfer_details_array);	      	
							$academic_details = array(
								'student_uniq_id' => $student_uniq_id[$i], 
								'class_id' => $from_sel_class, 
								'class_roll' => $classrole, 
								'session_id' => $next_sel_session, 
								'rank' => $classrole,
								'created_by' => $session['userid'], 
								'transfer_master_id' => $insert_id, 
							);

						$insertAcafemicDetailsData=$this->commondatamodel->insertSingleTableData('student_academic_details',$academic_details);
					


					}
				
				

						
				 
		}
			
			


			
					

					$user_activity = array(
						"activity_module" => 'Transfer Student',
						"action" => 'Insert',
						"from_method" => 'transferstudent/transfer_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

				    
					$tbl_name = array('user_activity_report');
					$insert_array = array($user_activity);
					$insertData = $this->commondatamodel->insertMultiTableData($tbl_name,$insert_array);

					if($insertData)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Transfred successfully",
							
							
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "There is some problem.Try again"
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


/* transfer student data*/

	public function TransferStudentList()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$session_id=$session['yid'];

			$result=[];
			
			if (isset($dataArry['sel_class'])) {
				$sel_class = $dataArry['sel_class'];

				$where = array(
							'transfer_master.class_master_id' => $sel_class,
							'transfer_master.session_id' => $session_id
						);
			$transferMasterData=$this->commondatamodel->getSingleRowByWhereCls('transfer_master',$where);

				if ($transferMasterData) {
					$transfer_master_id=$transferMasterData->transfer_master_id;
					
					$result['studentList'] = $this->transferstudentmodel->getTransferStudentList($transfer_master_id); 
				}else{
					$result['studentList']=[];
				}
				
				
           
			}else{
					

           $result['studentList']=[];
			}


			
			$page = "dashboard/adminpanel_dashboard/ds-transfer/transfer_status_data";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

}//end of class