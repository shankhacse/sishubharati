<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gallery extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('gallerymodel','gallerymodel',TRUE);
	 
		
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-gallery/gallery';
			$result = [];
			$header = "";
			
			
			$result['imageList'] = $this->gallerymodel->getAllImageList();
			$result['albumList']=$this->commondatamodel->getAllDropdownData('album_master');
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}


public function addImage()
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
				$result['GalleryEditdata'] = [];
				$result['albumList']=$this->commondatamodel->getAllDropdownData('album_master');
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
			
			$page = "dashboard/adminpanel_dashboard/ds-gallery/gallery_add_edit_view.php";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

public function saveImage()
	{
		if($this->session->userdata('user_data'))
		{
			$image_array = array();
			$user_activity = array();
			$tbl_name = array();
		
			$session = $this->session->userdata('user_data');
			$galleryID = trim($this->input->post('galleryID'));
			$mode = trim($this->input->post('mode'));
			

			
			
		
			
		    $docType = $this->input->post('album');
			$userFilename = $this->input->post('userFileName');
			$fileDesc = $this->input->post('fileDesc');

			
		

			$gallery_array = array(
				"galleryID" => $galleryID,
				"mode" => $mode,
				
			
				"docType" => $docType,
				"userFilename" => $userFilename,
				"docFile" => $_FILES,
				"fileDesc" => $fileDesc
			);


			if($galleryID>0 && $mode=="EDIT")
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
				
				
				$gallery_array_add_info = array(
					'isChangedFile' => $isFileChanged 
				);

				$gallery_array_new_add = array_merge($gallery_array,$gallery_array_add_info);
				
				$insertData = $this->gallerymodel->inserIntoGallery($gallery_array_new_add,$session);
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
public function imageList()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-gallery/gallery_list_view';
			$result = [];
			$header = "";
			
			
			$result['imageList'] = $this->gallerymodel->getAllImageListdel();
			
			createbody_method($result, $page, $header, $session);
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



public function deleteGallery()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['security_token']))
		{
			$galleryid = trim($this->input->post('galleryid'));
			$docid = trim($this->input->post('docid'));
			
				
			$where_gallery = array(
				"gallery.gallery_id" => $galleryid
				);
			$where_doc = array(
				"gallery_images_all.id" => $docid
				);
			
			
			
				$delete = $this->commondatamodel->DeleteData('gallery',$where_gallery);
				$delete1 = $this->commondatamodel->DeleteData('gallery_images_all',$where_doc);
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