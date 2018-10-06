<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class events extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		
		$this->load->model('eventsmodel','eventsmodel',TRUE);
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$result['EventsList'] = $this->eventsmodel->getAllEventsList();
			

			/*echo "<pre>";
			print_r($result['NoticeList']);
			echo "</pre>";*/
			//exit;

			$page = "dashboard/adminpanel_dashboard/ds-events/events_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

public function addEvents()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$eventsID = 0;
				$result['EventsEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$eventsID = $this->uri->segment(3);
				
				
				
			}

			$header = "";
			
			$page = "dashboard/adminpanel_dashboard/ds-events/events_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

public function saveEvents()
	{
		if($this->session->userdata('user_data'))
		{
			$notice_array = array();
			$user_activity = array();
			$tbl_name = array();
		
			$session = $this->session->userdata('user_data');
			$eventsID = trim($this->input->post('eventsID'));
			$mode = trim($this->input->post('mode'));
			$eventdate = trim($this->input->post('eventdate'));

			 if($eventdate!=""){
				$eventdate = str_replace('/', '-', $eventdate);
				$eventdate = date("Y-m-d",strtotime($eventdate));
			 }
			 else{
				 $eventdate = NULL;
			 }
			
		
			
		    $docType = '2';
			$userFilename = $this->input->post('userFileName');
			$fileDesc = $this->input->post('fileDesc');

			
		

			$event_array = array(
				"eventsID" => $eventsID,
				"mode" => $mode,
				"title" => $this->input->post('eventstitle'),
				"event_place" => $this->input->post('eventplace'),
				"event_date" => $eventdate,
				"event_time" => $this->input->post('eventtime'),
			
			
				"docType" => $docType,
				"userFilename" => $userFilename,
				"docFile" => $_FILES,
				"fileDesc" => $fileDesc
			);


			if($eventsID>0 && $mode=="EDIT")
			{
				$isFileChanged = $this->input->post('isChangedFile');
				$randomFileName = $this->input->post('randomFileName');
				$prvFilename = $this->input->post('prvFilename');
				$docDetailIDs = $this->input->post('docDetailIDs');
				
				

				$updateData = 1;
				if($updateData)
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
				
				$isFileChanged = $this->input->post('isChangedFile');
				
				
				$event_array_add_info = array(
					'isChangedFile' => $isFileChanged 
				);

				$event_array_new_add = array_merge($event_array,$event_array_add_info);
				
				$insertData = $this->eventsmodel->inserIntoEvents($event_array_new_add,$session);
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
			
				
			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;
			
			
		}
		else
		{
			redirect('login','refresh');
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
				"events.events_id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Events',
					"action" => "Update",
					"from_method" => "events/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('events',$update_array,$where,'user_activity_report',$user_activity);
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



public function deleteEvent()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$eventid = trim($this->input->post('eventid'));
			$docid = trim($this->input->post('docid'));
			
				
			$where_notice = array(
				"events.events_id" => $eventid
				);
			$where_doc = array(
				"uploaded_documents_all.id" => $docid
				);
			
			
			
				$delete = $this->commondatamodel->DeleteData('events',$where_notice);
				$delete1 = $this->commondatamodel->DeleteData('uploaded_documents_all',$where_doc);
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