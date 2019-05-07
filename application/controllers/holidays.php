<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class holidays extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('holidaysmodel','holidaysmodel',TRUE);
		
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-holidays/holidays_list_view';
			$result = [];
			$header = "";
			
			$result['holidaysList']=$this->holidaysmodel->getHolidaysList($session['yid']);
			//pre($result['holidaysList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}

	public function addholidays()
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
				$result['HolidaysEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$holidaysID = $this->uri->segment(3);
				$whereAry = array(
					'holidays.id' => $holidaysID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['HolidaysEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('holidays',$whereAry); 
				
			}

			$header = "";
			
			
			$page = "dashboard/adminpanel_dashboard/ds-holidays/holidays_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	public function holidays_action()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$holidaysID = trim(htmlspecialchars($dataArry['holidaysID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));
			$dtholiday = trim(htmlspecialchars($dataArry['dtholiday']));
			$todtholiday = trim(htmlspecialchars($dataArry['todtholiday']));
			$holititle = trim(htmlspecialchars($dataArry['holititle']));
			
		   

			 if($dtholiday!=""){
				$dtholiday = str_replace('/', '-', $dtholiday);
				$dtholiday = date("Y-m-d",strtotime($dtholiday));
			 }
			 else{
				 $dtholiday = NULL;
			 }

			 if($todtholiday!=""){
				$todtholiday = str_replace('/', '-', $todtholiday);
				$todtholiday = date("Y-m-d",strtotime($todtholiday));
			 }
			 else{
				 $todtholiday = NULL;
			 }

			if (isset($dataArry['dtrange'])) {
				$is_daterange='Y';
			}else{
				$is_daterange='N';
				 $todtholiday = NULL;
			}
			$year= date("Y",strtotime($dtholiday));
			

			if($holititle!="" && $dtholiday!="")
			{


				if($holidaysID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

						$array_upd = array(
						"title" => $holititle,
						"date" => $dtholiday,
						"todate" => $todtholiday,
						"year" => $year,
						"is_daterange" => $is_daterange,
						"session_id" => $session['yid'],
						
					);


					$where_upd = array(
						"holidays.id" => $holidaysID
					);

					$user_activity = array(
						"activity_date" => date("Y-m-d H:i:s"),
						"activity_module" => 'Holidays',
						"action" => 'Update',
						"from_method" => 'holidays/holidays_action',
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
					$update = $this->commondatamodel->updateData_WithUserActivity('holidays',$array_upd,$where_upd,'user_activity_report',$user_activity);
					
					
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
						"title" => $holititle,
						"date" => $dtholiday,
						"todate" => $todtholiday,
						"year" => $year,
						"is_daterange" => $is_daterange,
						"session_id" => $session['yid'],
						
					);

					$user_activity = array(
						"activity_date" => date("Y-m-d H:i:s"),
						"activity_module" => 'Holidays',
						"action" => 'Insert',
						"from_method" => 'holidays/holidays_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform(),
						"login_time" => NULL,
						"logout_time" => NULL
					 );

						
					$tbl_name = array('holidays','user_activity_report');
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


public function deleteHoliday()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$holiid = trim($this->input->post('holiid'));
			
				
			$where = array(
				"holidays.id" => $holiid
				);
			
			
			
				$delete = $this->commondatamodel->DeleteData('holidays',$where);
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


}// end of class