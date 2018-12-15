<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class classsubject extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('classsubjectmodel','classsubjectmodel',TRUE);
	}
	
	
	public function index()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-class_subject_assign/class_subject_add_edit_view';
			$result = [];
			$header = "";
			$result['classList']=$this->classsubjectmodel->getClassListForSubjectassign();
			$result['subjectList']=$this->commondatamodel->getAllDropdownData('subject_master');
			//pre($result['classList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function subjectList()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-class_subject_assign/subject_list_view';
			$result = [];
			$header = "";
			
			$result['classsubjectList']=$this->classsubjectmodel->getAllClassWiseSubjectDetails();
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


public function classSubjectList()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			    
			
			$header = "";
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			

			$result=[];
			
			if (isset($dataArry['sel_class']) && isset($dataArry['sel_subject'])) {
				$sel_class = $dataArry['sel_class'];
				$subject_ids = $dataArry['sel_subject'];
				$where_class = array('class_master.id' => $sel_class );
				$classData=$this->commondatamodel->getSingleRowByWhereCls('class_master',$where_class);

				$result['classname']=$classData->name;
				$result['sel_class']=$sel_class;
				//pre($subject_ids);
				foreach ($subject_ids as  $subject_id) {

				$where_subject = array('subject_master.id' => $subject_id );
				$subjectData=$this->commondatamodel->getSingleRowByWhereCls('subject_master',$where_subject);


					$subject_array[] = array(
						'id' => $subject_id,
						'subject' => $subjectData->subject,
						'subject_code' => $subjectData->subject_code
						 );

				}
				
			$result['subjectList']=$subject_array;	
           
			}else{
					

           $result['subjectList']=[];
			}


			
			$page = "dashboard/adminpanel_dashboard/ds-class_subject_assign/class_subject_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}



	public function saveClassSubject()
	{
		if($this->session->userdata('user_data'))
		{  
		    $formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$student_array = array();
			$user_activity = array();
			$tbl_name = array();
			$sel_subfirst=[];
		
			$session = $this->session->userdata('user_data');
			$classsubID = $dataArry['classsubID'];
			$class_id = $dataArry['sel_class'];
			
			$subjectid = $dataArry['subjectid'];
			$sel_fullmarks = $dataArry['sel_fullmarks'];
			$sel_writtenmarks = $dataArry['sel_writtenmarks'];
			$sel_oralmarks = $dataArry['sel_oralmarks'];
			$sel_wr = $dataArry['sel_wr'];
			
			$mode = $dataArry['mode'];
		    $arraysize=count($subjectid);

			if($classsubID>0 && $mode=="EDIT")
			{
				
			
					$update = 1;
			

				if($update)
				{
					$json_response = array(
						"msg_status" => 1,
						"msg_data" => "Updated successfully"
					);
				}
				else
				{
					$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : There is some problem while saving ...Please try again."
					);
				}


			}
			else
			{

				$clssubject_array = array(
				"class_master_id" => $class_id,
				"session_id" => $session['yid'],
				"created_by" => $session['userid']
			    );

			$insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('class_subject_asign_master',$clssubject_array);
				for ($i=0; $i <$arraysize ; $i++) { 
					
				
				$clssubject_details_array = array(
				'asign_master_id' => $insert_id ,
				'subject_id' => $subjectid[$i],
				'subject_full_marks' => $sel_fullmarks[$i],
				'subject_written_marks' => $sel_writtenmarks[$i],
				'subject_oral_marks' => $sel_oralmarks[$i],
				'marks_type' => $sel_wr[$i]
				
				  );

$insertData=$this->commondatamodel->insertSingleTableData('class_subject_asign_details',$clssubject_details_array);

				 
				}
				if($insertData)
				{
					$json_response = array(
						"msg_status" => 1,
						"msg_data" => "Saved successfully"
					);
				}
				else
				{
					$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : There is some problem while saving ...Please try again."
					);
				}				
					
				
				    
			}
			
				
			//header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;
			
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


/* class-subject model data*/


	public function getSubjectDetails()
 	{
 		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{   $data=[];
			$clssubmstid = trim(htmlspecialchars($this->input->post('clssubmstid')));
			$mode = trim(htmlspecialchars($this->input->post('mode')));
			$classname = trim(htmlspecialchars($this->input->post('classname')));
			
			$data['cls_sub_assign_mstid']=$clssubmstid;
			if($mode=="Add")
			{
				$page = "dashboard/adminpanel_dashboard/ds-class_subject_assign/assign_modal/add_class-subject_partial_modal_view";
				
				$data['subjectList']=$this->classsubjectmodel->getRemainSubjectList($clssubmstid);

				

				$documentDetailView = $this->load->view($page,$data);

			}elseif ($mode=="Edit") {
				
				$page = "dashboard/adminpanel_dashboard/ds-class_subject_assign/assign_modal/edit_class-subject_partial_modal_view";
				
				

				$data['subjectDetails'] = $this->classsubjectmodel->getClassSubjectDetails($clssubmstid);
				

				$documentDetailView = $this->load->view($page,$data);

			}elseif ($mode=="Delete") {

				$page = "dashboard/adminpanel_dashboard/ds-class_subject_assign/assign_modal/delete_class-subject_partial_modal_view";

				$data['subjectDetails'] = $this->classsubjectmodel->getClassSubjectDetails($clssubmstid);
				


				$documentDetailView = $this->load->view($page,$data);

			}

			echo $documentDetailView;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
 	}

/*update subject full marks*/

public function updateSubjectFullMarks()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$assdtlid = $this->input->post('assdtlid');
			$sel_subfmarks = $this->input->post('sel_subfmarks');
			$sel_subwmarks = $this->input->post('sel_subwmarks');
			$sel_subomarks = $this->input->post('sel_subomarks');
			$sel_wr = $this->input->post('sel_wr');
			
			$update_array  = array(
				"subject_full_marks" => $sel_subfmarks,
				"subject_written_marks" => $sel_subwmarks,
				"subject_oral_marks" => $sel_subomarks,
				"marks_type" => $sel_wr,
				
				);
				
			$where = array(
				"class_subject_asign_details.id" => $assdtlid
				);
			
			
			$user_activity = array(
					"activity_date" => date("Y-m-d H:i:s"),
					"activity_module" => 'ClassSubject',
					"action" => "Update",
					"from_method" => "classsubject/updateSubjectFullMarks",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform(),
					"login_time" => NULL,
					"logout_time" => NULL
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('class_subject_asign_details',$update_array,$where,'user_activity_report',$user_activity);
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Fullmarks Updated"
				);
			}
			else
			{
				$json_response = array(
					"msg_status" => 0,
					"msg_data" => "Failed to update"
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

	/* delete subject of a class*/

public function deleteSubject()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$assdtlid = trim($this->input->post('assdtlid'));
			
			
				
			$where_assigndtl = array(
				"class_subject_asign_details.id" => $assdtlid
				);
			
			
			
			
				$delete = $this->commondatamodel->DeleteData('class_subject_asign_details',$where_assigndtl);
				
			if($delete)
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


/* save single subject to class*/

public function saveSingleSubjectClass()
	{
		if($this->session->userdata('user_data'))
		{  
		    $formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

	
			$session = $this->session->userdata('user_data');
		
			$clssunasinmstid = $dataArry['clssunasinmstid'];
			
			$subjectid = $dataArry['sel_subject'];
			$sel_fullmarks = $dataArry['sel_fullmarks'];
			$sel_writtenmarks = $dataArry['sel_writtenmarks'];
			$sel_oralmarks = $dataArry['sel_oralmarks'];
			$sel_wr = $dataArry['sel_wr'];
			
				
					
				
				$clssubject_details_array = array(
				'asign_master_id' => $clssunasinmstid ,
				'subject_id' => $subjectid,
				'subject_full_marks' => $sel_fullmarks,
				'subject_written_marks' => $sel_writtenmarks,
				'subject_oral_marks' => $sel_oralmarks,
				"marks_type" => $sel_wr,
				
				  );

$insertData=$this->commondatamodel->insertSingleTableData('class_subject_asign_details',$clssubject_details_array);

				 
				
				if($insertData)
				{
					$json_response = array(
						"msg_status" => 1,
						"msg_data" => "Saved successfully"
					);
				}
				else
				{
					$json_response = array(
						"msg_status" => 0,
						"msg_data" => "Error : There is some problem while saving ...Please try again."
					);
				}				
					
				
				    
			
			
				
			//header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;
			
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

}// end of class