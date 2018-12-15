<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class importantinfo extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		
		$this->load->model('importantinfomodel','impinfo',TRUE);
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$result['infoList'] = $this->impinfo->getAllInfoList();
			

			/*echo "<pre>";
			print_r($result['infoList']);
			echo "</pre>";*/
			//exit;

			$page = "dashboard/adminpanel_dashboard/ds-importantinfo/importantinfo_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function addInfo()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$noticeID = 0;
				$result['InfoEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$infoID = $this->uri->segment(3);
				
				
				
			}

			$header = "";
			
			$result['academicyearList']= $this->impinfo->getAcademicYear();
		

			
			$page = "dashboard/adminpanel_dashboard/ds-importantinfo/importantinfo_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}




public function saveInfo()
	{
		if($this->session->userdata('user_data'))
		{
			$notice_array = array();
			$user_activity = array();
			$tbl_name = array();
		
			$session = $this->session->userdata('user_data');
			$infoID = trim($this->input->post('infoID'));
			$mode = trim($this->input->post('mode'));
			
		
			
		    $docType = '3';
			$userFilename = $this->input->post('userFileName');
			$fileDesc = $this->input->post('fileDesc');

			
		

			$info_array = array(
				"infoID" => $infoID,
				"mode" => $mode,
				"title" => $this->input->post('infotitle'),
				
			
			
				"docType" => $docType,
				"userFilename" => $userFilename,
				"docFile" => $_FILES,
				"fileDesc" => $fileDesc
			);


			if($infoID>0 && $mode=="EDIT")
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
				
				
				$info_array_add_info = array(
					'isChangedFile' => $isFileChanged 
				);

				$info_array_new_add = array_merge($info_array,$info_array_add_info);
				
				$insertData = $this->impinfo->inserIntoInfo($info_array_new_add,$session);
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
			redirect('administratorpanel','refresh');
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
				"important_info.info_id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Important Info',
					"action" => "Update",
					"from_method" => "importantinfo/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('important_info',$update_array,$where,'user_activity_report',$user_activity);
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



public function deleteInfo()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$infoid = trim($this->input->post('infoid'));
			$docid = trim($this->input->post('docid'));
			
				
			$where_info = array(
				"important_info.info_id" => $infoid
				);
			$where_doc = array(
				"uploaded_documents_all.id" => $docid
				);
			
			
			
				$delete = $this->commondatamodel->DeleteData('important_info',$where_info);
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
}//end of class