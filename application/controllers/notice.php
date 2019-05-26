<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class notice extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		
		$this->load->model('noticemodel','noticemodel',TRUE);
	}
	
	
	public function index()
	{ 
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{       
			
			$header = "";
			$result['NoticeList'] = $this->noticemodel->getAllNoticeList();
			

			/*echo "<pre>";
			print_r($result['NoticeList']);
			echo "</pre>";*/
			//exit;

			$page = "dashboard/adminpanel_dashboard/ds-notice/notice_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function addNotice()
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
				$result['NoticeEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$noticeID = $this->uri->segment(3);
				
				
				
			}

			$header = "";
			
			$result['academicyearList']= $this->noticemodel->getAcademicYear();
		

			
			$page = "dashboard/adminpanel_dashboard/ds-notice/notice_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}




public function saveNotice()
	{
		if($this->session->userdata('user_data'))
		{
			$notice_array = array();
			$user_activity = array();
			$tbl_name = array();
		
			$session = $this->session->userdata('user_data');
			$noticeID = trim($this->input->post('noticeID'));
			$mode = trim($this->input->post('mode'));
			
		
			
		    $docType = '3';
			$userFilename = $this->input->post('userFileName');
			$fileDesc = $this->input->post('fileDesc');

			
		

			$notice_array = array(
				"noticeID" => $noticeID,
				"mode" => $mode,
				"title" => $this->input->post('notictitle'),
				"academic_year" => $this->input->post('aceyear'),
			
			
				"docType" => $docType,
				"userFilename" => $userFilename,
				"docFile" => $_FILES,
				"fileDesc" => $fileDesc
			);


			if($noticeID>0 && $mode=="EDIT")
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
				
				
				$notice_array_add_info = array(
					'isChangedFile' => $isFileChanged 
				);

				$notice_array_new_add = array_merge($notice_array,$notice_array_add_info);
				
				$insertData = $this->noticemodel->inserIntoNotice($notice_array_new_add,$session);
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
				"notice.notice_id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Notice',
					"action" => "Update",
					"from_method" => "notice/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('notice',$update_array,$where,'user_activity_report',$user_activity);
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



public function deleteNotice()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$noticeid = trim($this->input->post('noticeid'));
			$docid = trim($this->input->post('docid'));
			
				
			$where_notice = array(
				"notice.notice_id" => $noticeid
				);
			$where_doc = array(
				"uploaded_documents_all.id" => $docid
				);
			
			
			
				$delete = $this->commondatamodel->DeleteData('notice',$where_notice);
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


	public function PublishedMessage()
	{ 
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-notice/publish_msg_list_view.php';
			$result = [];
			$header = "";
			
			$where = array(
                'published_message.id' =>1,
                
            );
            $result['PublishMsgData']= $this->commondatamodel->getSingleRowByWhereCls('published_message',$where);
			
			//pre($result['aboutUsData']);
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	public function updatePublishedMessage(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$pubmsgid = $this->input->post('pubmsgid');
			$columnname = $this->input->post('columnname');
			$message = $this->input->post('message');
		
			
			if ($columnname=='message') {
				$update_array  = array("message" => $message);
			}
			
				
			$where = array(
				"published_message.id" => $pubmsgid
				);
			
			
			$user_activity = array(
					"activity_module" => 'Publias Message',
					"action" => "Update",
					"from_method" => "notice/updatePublushed Message",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('published_message',$update_array,$where,'user_activity_report',$user_activity);
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => $columnname." updated"
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


	public function setStatusPublishMsg(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$updID = trim($this->input->post('uid'));
			$setstatus = trim($this->input->post('setstatus'));
			
			$update_array  = array(
				"is_active" => $setstatus
				);
				
			$where = array(
				"published_message.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Notice',
					"action" => "Update",
					"from_method" => "notice/setStatusPublishMsg",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('published_message',$update_array,$where,'user_activity_report',$user_activity);
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
}//end of class