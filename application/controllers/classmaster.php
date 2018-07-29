<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class classmaster extends CI_Controller {
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
			$result['classList'] = $this->classmastermodel->getAllClass(); 
			$page = "dashboard/adminpanel_dashboard/ds-class/class_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function addclass()
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
				$result['ClassEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$classID = $this->uri->segment(3);
				$whereAry = array(
					'class_master.id' => $classID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['ClassEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('class_master',$whereAry); 
				
			}

			$header = "";
			$clswhere = [
				"admisson_type.is_active" => 1 
				];
			$result['admissointypeList'] = $this->commondatamodel->getAllRecordWhereOrderBy('admisson_type',$clswhere,'admisson_type.id'); 
			
			$page = "dashboard/adminpanel_dashboard/ds-class/class_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function class_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$classID = trim(htmlspecialchars($dataArry['classID']));
			$adtypeID = trim(htmlspecialchars($dataArry['adtype']));
			$mode = trim(htmlspecialchars($dataArry['mode']));
			$classname = trim(htmlspecialchars($dataArry['classname']));
			$classcode = trim(htmlspecialchars($dataArry['classcode']));


			if($adtypeID!="0" && $classname!="")
			{
	
				
				
				if($classID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$array_upd = array(
						"name" => $classname,
						"class_code" => $classcode,
						"admisson_type_id" => $adtypeID,
						"is_active" => 1
					
					);

					$where_upd = array(
						"class_master.id" => $classID
					);

					$user_activity = array(
						"activity_module" => 'Class',
						"action" => 'Update',
						"from_method" => 'Class/class_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('class_master',$array_upd,$where_upd,'activity_log',$user_activity);
					
					
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
						"name" => $classname,
						"class_code" => $classcode,
						"admisson_type_id" => $adtypeID,
						"is_active" => 1
					);
					
					
	
					$user_activity = array(
						"activity_module" => 'Class',
						"action" => 'Insert',
						"from_method" => 'class/class_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

						
					$tbl_name = array('class_master','activity_log');
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
			redirect('adminpanel','refresh');
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
				"class_master.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Class',
					"action" => "Update",
					"from_method" => "classmaster/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('class_master',$update_array,$where,'activity_log',$user_activity);
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