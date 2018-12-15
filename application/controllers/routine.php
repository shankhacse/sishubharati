<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class routine extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('routinemodel','routinemodel',TRUE);
		
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-routine/routine_list_view';
			$result = [];
			$header = "";
			$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			//pre($result['classList']);
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


	public function addroutine()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$routineID = 0;
				$result['routineEditdata'] = [];
				$result['classList']=$this->routinemodel->getClassListForRoutine($session['yid']);
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$routineID = $this->uri->segment(3);
				
				// getSingleRowByWhereCls(tablename,where params)
				$result['routineEditdata'] = $this->routinemodel->getRoutinebyRoutineMasterID($routineID,$session['yid']); 
				//pre($result['routineEditdata']);
				$result['classList']=$this->commondatamodel->getAllDropdownData('class_master');
			}

			$header = "";
			$wheresession = array('session_year.session_id' =>$session['yid']);
			$result['year']= $this->commondatamodel->getSingleRowByWhereCls('session_year',$wheresession);
		    
		    $result['subjectList']=$this->commondatamodel->getAllDropdownData('subject_master');
		    $result['dayList']=$this->routinemodel->getAllweekDays();
			
			$page = 'dashboard/adminpanel_dashboard/ds-routine/routine_add_edit_view';
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



	public function saveRoutine()
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
			$routineID = $dataArry['routineID'];
			$class_id = $dataArry['sel_class'];
			$day = $dataArry['day'];
			$sel_subfirst = $dataArry['sel_subfirst'];
			$sel_subsecond = $dataArry['sel_subsecond'];
			$sel_subthird = $dataArry['sel_subthird'];
			$sel_subfourth = $dataArry['sel_subfourth'];
			$sel_subfifth = $dataArry['sel_subfifth'];
			$sel_subsixth = $dataArry['sel_subsixth'];
			$mode = $dataArry['mode'];

			

			if($routineID>0 && $mode=="EDIT")
			{
				
				$routine_details = $dataArry['routine_details'];
				for ($i=0; $i <5 ; $i++) { 
				$routine_details_updt = array(
				'week_master_id' => $day[$i],
				'first_cls_sub_id' => $sel_subfirst[$i],
				'second_cls_sub_id' => $sel_subsecond[$i],
				'third_cls_sub_id' => $sel_subthird[$i],
				'fourth_cls_sub_id' => $sel_subfourth[$i],
				'fifth_cls_sub_id' => $sel_subfifth[$i],
				'sixth_cls_sub_id' => $sel_subsixth[$i],
				  );

					$where_upd = array(
						"routine_details.id" => $routine_details[$i]
					);

					$user_activity = array(
						"activity_module" => 'Class',
						"action" => 'Update',
						"from_method" => 'Routine/saveRoutine',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('routine_details',$routine_details_updt,$where_upd,'user_activity_report',$user_activity);
				}

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

				$routine_array = array(
				"class_master_id" => $class_id,
				"session_id" => $session['yid'],
				"created_by" => $session['userid']
			    );

			$insert_id=$this->commondatamodel->insertSingleTableDataRerurnInsertId('routine_master',$routine_array);
				for ($i=0; $i <5 ; $i++) { 
					
				
				$routine_details_array = array(
				'routine_master_id' => $insert_id ,
				'week_master_id' => $day[$i],
				'first_cls_sub_id' => $sel_subfirst[$i],
				'second_cls_sub_id' => $sel_subsecond[$i],
				'third_cls_sub_id' => $sel_subthird[$i],
				'fourth_cls_sub_id' => $sel_subfourth[$i],
				'fifth_cls_sub_id' => $sel_subfifth[$i],
				'sixth_cls_sub_id' => $sel_subsixth[$i],
				  );

$insertData=$this->commondatamodel->insertSingleTableData('routine_details',$routine_details_array);

				 
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
			redirect('login','refresh');
		}
	}
 



 public function getRoutineList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			
			if (isset($dataArry['sel_class'])) {
				$sel_class = $dataArry['sel_class'];
				
			$result['routineList'] = $this->routinemodel->getRoutinebyClass($sel_class,$session['yid']); 	
           
			}else{
					

           $result['routineList']=[];
			}


			
			$page = "dashboard/adminpanel_dashboard/ds-routine/routine_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}	
}//end of class