<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class gallerymodel extends CI_Model{
		/* get all events List*/

	public function getAllImageList(){
		$data = [];
		$where = array('gallery_images_all.upload_from_module' =>'Gallery' );
		$query = $this->db->select("gallery_images_all.*,
									album_master.name as album
									")
				->from('gallery_images_all')
				->join('album_master','album_master.album_id = gallery_images_all.album_master_id','INNER')
				->where($where)
				->order_by('gallery_images_all.album_master_id')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}

		/* get all image List*/

	public function getAllImageListdel(){
		$data = [];
	
		$query = $this->db->select("gallery.*,
									gallery_images_all.random_file_name,
									gallery_images_all.id as docid,
									album_master.name as album
									")
				->from('gallery')
				->join('gallery_images_all','gallery_images_all.upload_from_module_id = gallery.gallery_id','INNER')
				->join('album_master','album_master.album_id = gallery_images_all.album_master_id','INNER')
				
				->order_by('gallery.gallery_id','desc')
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}
	
		/* get all atcive events List limit 4*/

	public function getAllActiveEventsListLimit(){
		$data = [];
		$where = array(
						'uploaded_documents_all.upload_from_module' =>'Events',
						'events.is_active' =>1
						 );
		$query = $this->db->select("events.*,
									uploaded_documents_all.random_file_name,
									uploaded_documents_all.id as docid
									")
				->from('events')
				->join('uploaded_documents_all','uploaded_documents_all.upload_from_module_id = events.events_id','INNER')
				->where($where)
				->order_by('events.events_id')
				->limit(4)
				->get();
				 #q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}
	public function inserIntoGallery($data,$sesion_data)
	{
		try
		{
        	$this->db->trans_begin();
			$insert_student_data = array();
			$insert_user_activity = array();
			$is_file_uploaded = "N";
			if(isset($data['docFile']['fileName']))
			{
				if(sizeof($data['docFile']['fileName']['name'])>0)
				{
					$is_file_uploaded = "Y";
				}
				else
				{
					$is_file_uploaded = "N";
				}
			}
             

			$insert_gallery_data = array(
				  
				'session_id' => $sesion_data['yid'],  
				 
				'is_file_uploaded' => $is_file_uploaded,
				'created_by' => $sesion_data['userid'],  
				'is_active' => 1,  
				
			);
			
			$event_insert = $this->db->insert('gallery', $insert_gallery_data);
			#echo $this->db->last_query();
			$event_insert_ID = $this->db->insert_id();
			
			#$event_insert_ID = 100;
			
			$insert_where = array(
				"masterID" => $event_insert_ID,
				"From" => "Gallery",
			);
			
			if($is_file_uploaded=="Y")
			{

				$detail_insert = $this->insertIntoUploadFile($data,$sesion_data,$insert_where);
			}
			
			$insert_user_activity = array(
				"activity_date" => date('Y-m-d'),  
				"activity_module" => 'Gallery',
				
				"action" => "Insert",
				"from_method" => "gallery/saveimage",
				"user_id" => $sesion_data['userid'],
				
				"ip_address" => getUserIPAddress(),
				"user_browser" => getUserBrowserName(),
				"user_platform" => getUserPlatform()
			);
			
			$user_activity = $this->db->insert('user_activity_report', $insert_user_activity);
		    #echo $this->db->last_query();
			if($this->db->trans_status() === FALSE) 
			{
	            $this->db->trans_rollback();
	            return false;
	        } 
			else 
				{
		            $this->db->trans_commit();
		            return true;
		        }
	        }
			catch (Exception $err) 
			{
	            echo $err->getTraceAsString();
	        }
	}

/*Upload File*/




public function insertIntoUploadFile($data,$session_data,$where_data)
	{ 
		if($data['mode']=="EDIT" && $data['galleryID']>0)
		{

			$where_notice = array(
				"gallery_images_all.upload_from_module_id" => $data['galleryID'],
				"gallery_images_all.upload_from_module" => $where_data['From']
				);

				$this->db->where($where_notice);
				$this->db->delete('uploaded_documents_all'); 

		}

		//$dir = APPPATH . 'assets/document/trainerUpload/'; //FCPATH . '/posts';
		//$dir = APPPATH . 'assets/application_extension/';
		//$dir1 = $_SERVER['DOCUMENT_ROOT'].'/img';
		$dir1 = $_SERVER['DOCUMENT_ROOT'].'/application/assets/ds-documents/gallery_upload'; //server

		//$dir1 = $_SERVER['DOCUMENT_ROOT'].'/sishubharati/application/assets/ds-documents/gallery_upload'; //local
		
		
		
		$config = array(
			'upload_path' => $dir1,
			'allowed_types' => 'docx|doc|pdf|jpg|png|txt|xls|xlsx',
			'max_size' => '5120', // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_filename' => '255',
			'encrypt_name' => TRUE,
			);

		$this->load->library('upload', $config);
		$images = array();
        $detail_array = array();	
       $count_docs = sizeof($data['docFile']['fileName']['name']);
       $srl_no=1;
       	for($i=0;$i<sizeof($data['docFile']['fileName']['name']);$i++)
        {
      		$_FILES['images[]']['name']= $_FILES['fileName']['name'][$i];
            $_FILES['images[]']['type']= $_FILES['fileName']['type'][$i];
            $_FILES['images[]']['tmp_name']= $_FILES['fileName']['tmp_name'][$i];
            $_FILES['images[]']['error']= $_FILES['fileName']['error'][$i];
            $_FILES['images[]']['size']= $_FILES['fileName']['size'][$i];
			$this->upload->initialize($config);
			if ($this->upload->do_upload('images[]'))
			{
               $file_detail = $this->upload->data();
               $file_name = $file_detail['file_name']; 
               $detail_array =array(
					"random_file_name" => $file_name,
					"album_master_id" => $data['docType'][$i],
					"user_file_name" => $data['userFilename'][$i],
					"uploaded_file_desc" => $data['fileDesc'][$i],
					"uploaded_on" => date('Y-m-d'),
					"modified_on" => date('Y-m-d'),
					"upload_from_module" => "Gallery",
					"upload_from_module_id" => $where_data['masterID'],
					"upload_srl_no" => $srl_no++,
					
					"uploaded_by_user" => $session_data['userid'],
					"is_active" => 'Y'
				); 

             	$this->db->insert('gallery_images_all',$detail_array);	
             	#echo $this->db->last_query();
            }
        }

        // If File Not Changed Then insert Info
        $countChanged = sizeof($data['isChangedFile']);

       // echo "Count Changed ".$countChanged;
      //  exit;

        for($k=0;$k<$countChanged;$k++)
        {
        	$detail_array_edit = array();

        	if($data['isChangedFile'][$k]=="N")
        	{   
				$detail_array_edit =array(
					"random_file_name" => $data['randomFileName'][$k],
					"album_master_id" => $data['docType'][$k],
					"user_file_name" => $data['prvFilename'][$k],
					"uploaded_file_desc" => $data['fileDesc'][$k],
					"uploaded_on" => date('Y-m-d'),
					"modified_on" => date('Y-m-d'),
					"upload_from_module" => "Gallery",
					"upload_from_module_id" => $where_data['masterID'],
					"upload_srl_no" => $srl_no++,
					
					"uploaded_by_user" => $session_data['userid'],
					"is_active" => 'Y'
				); 

				$this->db->insert('gallery_images_all',$detail_array_edit);
				#echo $this->db->last_query();	
			}
        }

	}




}// end of class