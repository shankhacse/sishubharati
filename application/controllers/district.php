<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class district extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('locationmodel','Locationmodel',TRUE);
	}
	
	
	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$header = "";
			//getALLDistricts(stateID) if stateID = 0 will fetch all district 
			$result['districtLists'] = $this->Locationmodel->getALLDistricts(0); 
			$this->db->freeDBResource($this->db->conn_id); 
			$page = "dashboard/adminpanel_dashboard/ds-district/district_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function adddistrict()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$districtID = 0;
				$result['DistrictEditdata'] = [];
				$result['stateList'] = $this->Locationmodel->getAllStates(101,'Y'); // getAllStates(countryID,activestatus)
				$this->db->freeDBResource($this->db->conn_id); 
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$districtID = $this->uri->segment(3);
				$whereAry = array(
					'district.id' => $districtID
				);
				$result['DistrictEditdata'] = $this->Locationmodel->getDistrictByID($whereAry); 

				$result['stateList'] = $this->Locationmodel->getAllStates($result['DistrictEditdata']->countryID,'Y'); // getAllStates(countryID,activestatus)
				$this->db->freeDBResource($this->db->conn_id); 
			}

			$header = "";
			$result['countryList'] = $this->Locationmodel->getAllCountry('Y');
			$this->db->freeDBResource($this->db->conn_id); 

			
			
			
			$page = "dashboard/adminpanel_dashboard/ds-district/district_add_edit_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function district_action()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$districtID = trim(htmlspecialchars($dataArry['districtID']));
			$mode = trim(htmlspecialchars($dataArry['districtMode']));
			$country = trim(htmlspecialchars($dataArry['country']));
			$state = trim(htmlspecialchars($dataArry['state']));
			$district = trim(htmlspecialchars($dataArry['district']));


			if($country!="0" && $state!="0" && $district!="")
			{


				if($districtID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$array_upd = array(
						"name" => $district,
						"state_id" => $state
					);

					$where_upd = array(
						"district.id" => $districtID
					);

					$user_activity = array(
						"activity_date" => date("Y-m-d H:i:s"),
						"activity_module" => 'District',
						"action" => 'Update',
						"from_method" => 'district/district_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform(),
						"login_time" => NULL,
						"logout_time" => NULL
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('district',$array_upd,$where_upd,'user_activity_report',$user_activity);
					
					
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
						"name" => $district,
						"state_id" => $state,
						"is_active" => 'Y',
						"created_by" => $session['userid'],
						"created_on" => date('Y-m-d H:i:s')
					);

					$user_activity = array(
						"activity_date" => date("Y-m-d H:i:s"),
						"activity_module" => 'District',
						"action" => 'Insert',
						"from_method" => 'district/district_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform(),
						"login_time" => NULL,
						"logout_time" => NULL
					 );

						
					$tbl_name = array('district','user_activity_report');
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
			redirect('administratorpanel','refresh');
		}
	}


	public function setStatus()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$districtID = trim($this->input->post('uid'));
			$setstatus = trim($this->input->post('setstatus'));
			
			$update_array  = array(
				"is_active" => $setstatus
				);
				
			$where = array(
				"district.id" => $districtID
				);
			
			
			$user_activity = array(
					"activity_date" => date("Y-m-d H:i:s"),
					"activity_module" => 'District',
					"action" => "Update",
					"from_method" => "district/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform(),
					"login_time" => NULL,
					"logout_time" => NULL
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('district',$update_array,$where,'user_activity_report',$user_activity);
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


	public function getStates()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$country = trim($this->input->post('country'));
			$result['stateList'] = $this->Locationmodel->getAllStates($country,'Y'); // getAllStates(countryID,activestatus)
			$this->db->freeDBResource($this->db->conn_id); 

			$page = "dashboard/adminpanel_dashboard/ds-district/partial_states_dropdown_view";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function getDistrictAutocomplet()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$searchQ =  trim($this->input->post('query'));
			$orderby = "district.name";
		
			$result['autoHints'] = $this->commondatamodel->getAllRecordOrderByLike('district','name',$searchQ,$orderby,'ASC');


			$autoHints = "";
			foreach($result['autoHints'] as $autohints)
			{
				$autoHints[] = $autohints->name;
			}

			echo json_encode($autoHints);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	

}
?>