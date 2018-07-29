<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class subject extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			$result['subjectList'] = $this->commondatamodel->getAllDropdownData('subject_master'); 
			$page = "dashboard/adminpanel_dashboard/ds-subject/subject_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function addsubject()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$subjectID = 0;
				$result['SubjectEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)

			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$subjectID = $this->uri->segment(3);
				$whereAry = array(
					'subject_master.id' => $subjectID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['SubjectEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('subject_master',$whereAry); 
				
			}

			$header = "";
			
			
			$page = "dashboard/adminpanel_dashboard/ds-subject/subject_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function subject_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$subjectID = trim(htmlspecialchars($dataArry['subjectID']));
			
			$mode = trim(htmlspecialchars($dataArry['mode']));
			$subjectname = trim(htmlspecialchars($dataArry['subjectname']));
			$subcode = trim(htmlspecialchars($dataArry['subcode']));


			if($subjectname!="" && $subcode!="")
			{
	
				
				
				if($subjectID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$array_upd = array(
						"subject" => $subjectname,
						"subject_code" => $subcode,
						"is_active" => 1
					
					);

					$where_upd = array(
						"subject_master.id" => $subjectID
					);

					$user_activity = array(
						"activity_module" => 'Subject',
						"action" => 'Update',
						"from_method" => 'Subject/subject_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('subject_master',$array_upd,$where_upd,'activity_log',$user_activity);
					
					
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


					$array_insert = array(
						"subject" => $subjectname,
						"subject_code" => $subcode,
						"is_active" => 1
					);
					
					
	
					$user_activity = array(
						"activity_module" => 'Subject',
						"action" => 'Insert',
						"from_method" => 'subject/subject_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

						
					$tbl_name = array('subject_master','activity_log');
					$insert_array = array($array_insert,$user_activity);
					$insertData = $this->commondatamodel->insertMultiTableData($tbl_name,$insert_array);

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
							"msg_status" => 1,
							"msg_data" => "There is some problem.Try again"
						);
					}

				} // end add mode ELSE PART




				

			}
			else
			{
				$json_response = array(
						"msg_status" =>0,
						"msg_data" => "All fields are required"
					);
			}

			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			//redirect('adminpanel','refresh');
		}
	}


	public function setStatus(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$updID = trim($this->input->post('uid'));
			$setstatus = trim($this->input->post('setstatus'));
			
			$update_array  = array(
				"is_active" => $setstatus
				);
				
			$where = array(
				"subject_master.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Subject',
					"action" => "Update",
					"from_method" => "subject/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('subject_master',$update_array,$where,'activity_log',$user_activity);
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Status updated"
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


	
	

}
?>