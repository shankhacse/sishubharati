<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class occupation extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('classmastermodel','classmastermodel',TRUE);
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			$result['occupationList'] = $this->commondatamodel->getAllDropdownData('occupation_master'); 
			$page = "dashboard/adminpanel_dashboard/ds-occupation/occupation_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

public function addoccupation()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$classID = 0;
				$result['occupationEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$occupationID = $this->uri->segment(3);
				$whereAry = array(
					'occupation_master.occupation_id' => $occupationID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['occupationEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('occupation_master',$whereAry); 
				
			}

			$header = "";
			
			
			$page = "dashboard/adminpanel_dashboard/ds-occupation/occupation_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


public function occupation_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$occupationID = trim(htmlspecialchars($dataArry['occupationID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));
			$occupation_type = trim(htmlspecialchars($dataArry['occupation']));
			


				
				
				if($occupationID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$array_upd = array(
						"occupation_type" => $occupation_type
						
					);

					$where_upd = array(
						"occupation_master.occupation_id" => $occupationID
					);

					$user_activity = array(
						"activity_module" => 'Occupation',
						"action" => 'Update',
						"from_method" => 'occupation/occupation_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('occupation_master',$array_upd,$where_upd,'activity_log',$user_activity);
					
					
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
						"occupation_type" => $occupation_type
						
					);
					
					
	
					$user_activity = array(
						"activity_module" => 'Occupation',
						"action" => 'Insert',
						"from_method" => 'occupation/occupation_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

						
					$tbl_name = array('occupation_master','activity_log');
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



			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

}// end of class