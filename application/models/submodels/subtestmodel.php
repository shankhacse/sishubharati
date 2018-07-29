<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Centermodel extends CI_Model{

	public function getAllCenters()
	{
	
		$data = array();
		$this->db->select("center_master.`id` AS centerID,
					center_master.`center_name`,
					center_master.`contact_no`,
					center_master.`alt_contact_no`,
					center_master.`contact_person`,
					center_master.`center_email`,
					center_master.`description`,
					center_master.`center_full_add`,
					center_master.`pincode_id`,
					center_master.`nearest_landmark`,
					center_master.`latitude`,
					center_master.`longitude`,
					center_master.`is_active` AS centerStatus,
					pincode_master.pincode,
					district.name AS districtName,
					states.name AS stateName,
					countries.name AS countryName
					")
				->from('center_master')
				->join('pincode_master','pincode_master.id = center_master.pincode_id','INNER')
				->join('district','district.id = pincode_master.district_id','INNER')
				->join('states','states.id = district.state_id','INNER')
				->join('countries','countries.id = states.country_id','INNER')
				->order_by('center_master.center_name','ASC');
			
			$query = $this->db->get();

		//echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = array(
					"centerMasterData" => $rows,
					"centerFacilitiesData" =>$this->getCenterFacilities($rows->centerID),
					"centerTimingData" =>$this->getCenterTimings($rows->centerID),
					"centerUploadedDocsData" => $this->getCenterUploadedDocuments($rows->centerID,"CENTER"),
				); 
				
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

	public function getCenterByID($centerID)
	{
	
		$where = array("center_master.id"=>$centerID);
		$data = array();
		$this->db->select("center_master.`id` AS centerID,
					center_master.`center_name`,
					center_master.`contact_no`,
					center_master.`alt_contact_no`,
					center_master.`contact_person`,
					center_master.`center_email`,
					center_master.`description`,
					center_master.`center_full_add`,
					center_master.`pincode_id`,
					center_master.`nearest_landmark`,
					center_master.`latitude`,
					center_master.`longitude`,
					center_master.`is_active` AS centerStatus,
					pincode_master.pincode,
					district.name AS districtName,
					states.name AS stateName,
					countries.name AS countryName
					")
				->from('center_master')
				->join('pincode_master','pincode_master.id = center_master.pincode_id','INNER')
				->join('district','district.id = pincode_master.district_id','INNER')
				->join('states','states.id = district.state_id','INNER')
				->join('countries','countries.id = states.country_id','INNER')
				->where($where)
				->order_by('center_master.center_name','ASC');
			
			$query = $this->db->get();

		//echo $this->db->last_query();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data = array(
					"centerMasterData" => $rows,
					"centerFacilitiesData" =>$this->getCenterFacilities($rows->centerID),
					"centerTimingData" =>$this->getCenterTimings($rows->centerID),
					"centerUploadedDocsData" => $this->getCenterUploadedDocuments($rows->centerID,"CENTER"),
				); 
				
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

	/* -------------------------------
	*	getCenterFacilities(centerid)
	* --------------------------------
	*/
	public function getCenterFacilities($centerID)
	{
		$where = array("center_facilities_detail.center_id"=>$centerID);
		$data = [];
		try{
        	$this->db->select("center_facilities_detail.`id` AS centerFacilityDtlID,
					center_facilities_detail.`facility_id` AS facilityID,
					facility_master.`title` AS facilityname,
					facility_master.`icon_random_name`
					")
				->from('center_facilities_detail')
				->join('facility_master','facility_master.id = center_facilities_detail.facility_id','INNER')
				->where($where)
				->order_by('center_facilities_detail.facility_srl_no','ASC');
			
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
			}
        }
		
            return $data;
        }
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}

	/* -------------------------------
	*	getCenterTimings(centerid)
	* --------------------------------
	*/

	public function getCenterTimings($centerID)
	{
		$where = array("center_timing_detail.center_id"=>$centerID);
		$data = [];
		try{
        	$this->db->select("center_timing_detail.`id` AS centertimngDtlID,
							center_timing_detail.`opening_time`,
							center_timing_detail.`close_time`,
							center_timing_detail.`is_close`,
							week_master.`days_name`,
							week_master.`short_name` AS dayshort_name
							")
						->from('center_timing_detail')
						->join('week_master','week_master.id = center_timing_detail.day_id','INNER')
						->where($where)
						->order_by('center_timing_detail.day_id','ASC');
			
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
			}
        }
		
            return $data;
        }
		catch (Exception $err) 
		{
            echo $err->getTraceAsString();
        }
	}

	/* -------------------------------
	*	getCenterUploadedDocuments(centerid)
	* --------------------------------
	*/


	public function getCenterUploadedDocuments($moduleID,$moduleTag)
	{
		$detailData = array();
		$where = array(
			"uploaded_documents_all.upload_from_module_id" => $moduleID,
			"uploaded_documents_all.upload_from_module" => $moduleTag
		);

		$this->db->select("*")
				->from('uploaded_documents_all')
				->join('documents_upload_type','documents_upload_type.id = uploaded_documents_all.document_type_id','INNER')
				->where($where);
		$query = $this->db->get();
		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$detailData[] = $rows;
				
            }
            return $detailData;
        }
		else
		{
             return $detailData;
        }
	}

	public function updateCenter($centerID,$data,$sesion_data)
	{
		try
		{
			$this->db->trans_begin();
        	$center_master_update = array(); 
			$insert_trainer_data = array();
			$insert_user_activity = array();
			
			$center_ID = trim(htmlspecialchars($data['centerData']['centerID'])); 
			$upd_where = array("center_master.id" => $center_ID);
			
			/*echo "<pre>";
			print_r($data);
			echo "</pre>";*/
			//exit;
			
			$pincode = trim(htmlspecialchars($data['centerData']['centerpincode']));
			$center_master_update = array(
				'center_name' => trim(htmlspecialchars($data['centerData']['centername'])),  
				'contact_no' =>  trim(htmlspecialchars($data['centerData']['centercontact'])),  
				'alt_contact_no' => trim(htmlspecialchars($data['centerData']['alternateno'])),  
				'contact_person' => trim(htmlspecialchars($data['centerData']['centercontactperson'])),  
				'center_email' => trim(htmlspecialchars($data['centerData']['centeremail'])),  
				'description' => trim(htmlspecialchars($data['centerData']['centerdesc'])),  
				'center_full_add' => trim(htmlspecialchars($data['centerData']['centeraddress'])),  
				'pincode_id' => $this->getPincodeID($pincode),  
				'nearest_landmark' => trim(htmlspecialchars($data['centerData']['nearestlandmark'])),  
				'latitude' => trim(htmlspecialchars($data['centerData']['centerlatitude'])),  
				'longitude' => trim(htmlspecialchars($data['centerData']['centerlongitude'])),  
				
			);
			
			$this->db->where($upd_where);
            $this->db->update('center_master',$center_master_update);

			//echo $this->db->last_query();
			$center_master_id = $center_ID;

			$insertFacility = $this->insertIntoFacility($center_master_id,$data['centerData'],$sesion_data);
			$insertCenterTimng = $this->insertIntoCenterTiming($center_master_id,$data['centerData'],$sesion_data);
			$insertUploadData = $this->insertIntoDocumentUpload($center_master_id,$data,$sesion_data);


			
			
			$insert_user_activity = array(
				"activity_date" => date("Y-m-d H:i:s"),
				"activity_module" => 'Center',
				"action" => 'Update',
				"from_method" => 'pathologycenter/pathologycenter_action/updateCenter',
				"user_id" => $sesion_data['userid'],
				"ip_address" => getUserIPAddress(),
				"user_browser" => getUserBrowserName(),
				"user_platform" => getUserPlatform(),
				"login_time" => NULL,
				"logout_time" => NULL
			);
			
			$user_activity = $this->db->insert('user_activity_report', $insert_user_activity);
		
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

	public function insertIntoCenter($data,$sesion_data)
	{
		try
		{
			$this->db->trans_begin();
        	$center_master_insert = array(); 
			$insert_trainer_data = array();
			$insert_user_activity = array();
			
			
			
			$pincode = trim(htmlspecialchars($data['centerData']['centerpincode']));
			$center_master_insert = array(
				'center_name' => trim(htmlspecialchars($data['centerData']['centername'])),  
				'contact_no' =>  trim(htmlspecialchars($data['centerData']['centercontact'])),  
				'alt_contact_no' => trim(htmlspecialchars($data['centerData']['alternateno'])),  
				'contact_person' => trim(htmlspecialchars($data['centerData']['centercontactperson'])),  
				'center_email' => trim(htmlspecialchars($data['centerData']['centeremail'])),  
				'description' => trim(htmlspecialchars($data['centerData']['centerdesc'])),  
				'center_full_add' => trim(htmlspecialchars($data['centerData']['centeraddress'])),  
				'pincode_id' => $this->getPincodeID($pincode),  
				'nearest_landmark' => trim(htmlspecialchars($data['centerData']['nearestlandmark'])),  
				'latitude' => trim(htmlspecialchars($data['centerData']['centerlatitude'])),  
				'longitude' => trim(htmlspecialchars($data['centerData']['centerlongitude'])),  
				"created_on" => date('Y-m-d H:i:s'),
				"created_by" => $sesion_data['userid'],
				"is_active" => 'Y'
			);
			
			$centrmaster_ins = $this->db->insert('center_master', $center_master_insert);
			//echo $this->db->last_query();
			$center_master_id = $this->db->insert_id();

			$insertFacility = $this->insertIntoFacility($center_master_id,$data['centerData'],$sesion_data);
			$insertCenterTimng = $this->insertIntoCenterTiming($center_master_id,$data['centerData'],$sesion_data);
			$insertUploadData = $this->insertIntoDocumentUpload($center_master_id,$data,$sesion_data);


			
			
			$insert_user_activity = array(
				"activity_date" => date("Y-m-d H:i:s"),
				"activity_module" => 'Center',
				"action" => 'Update',
				"from_method" => 'pathologycenter/pathologycenter_action/insertIntoCenter',
				"user_id" => $sesion_data['userid'],
				"ip_address" => getUserIPAddress(),
				"user_browser" => getUserBrowserName(),
				"user_platform" => getUserPlatform(),
				"login_time" => NULL,
				"logout_time" => NULL
			);
			
			$user_activity = $this->db->insert('user_activity_report', $insert_user_activity);
		
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


	private function insertIntoFacility($centerId,$data,$sesion_data)
	{
		if($data['centerMode']=="EDIT" && $data['centerID']>0)
		{
			$where_facility_dtl = array("center_facilities_detail.center_id" => $centerId);
			$this->db->where($where_facility_dtl);
			$this->db->delete('center_facilities_detail'); 
		}

		$facility_dtl_ary = array();

		#$facilitycount = sizeof($data['facilityTitle']);
		if(isset($data['facilityTitle'])){
			for($i=0;$i<sizeof($data['facilityTitle']);$i++)
	        {
	        	$facility_dtl_ary = array(
	        		"center_id" => $centerId,
	        		"facility_id" => $data['facilityTitle'][$i],
	        		"facility_srl_no" => $i+1,
	        		"created_on" => date("Y-m-d H:i:s"),
	        		"created_by" => $sesion_data['userid'],
	        		"is_active" => 'Y'
	        	);
	        	 $this->db->insert('center_facilities_detail', $facility_dtl_ary);
	        }
    	}
	}

	private function insertIntoCenterTiming($centerId,$data,$sesion_data)
	{
		if($data['centerMode']=="EDIT" && $data['centerID']>0)
		{
			$where_facility_dtl = array("center_timing_detail.center_id" => $centerId);
			$this->db->where($where_facility_dtl);
			$this->db->delete('center_timing_detail'); 
		}

		$timing_dtl_ary = array();
		for($i=0;$i<sizeof($data['centredays']);$i++)
        {
        	$isclose = "N";
        	if(isset($data['closedays'][$i]) && $data['closedays'][$i]=="on")
        	{
        		$isclose = "Y";
        	}
        	$timing_dtl_ary = array(
        		"center_id" => $centerId,
        		"day_id" => $data['centredays'][$i],
				"opening_time" => $data['openingHours'][$i] == "" ? NULL : date("Y-m-d H:i:s",strtotime($data['openingHours'][$i])),
        		"close_time" => $data['openingHours'][$i] == "" ? NULL : date("Y-m-d H:i:s",strtotime($data['closingHours'][$i])),
        		"is_close" => $isclose,
        		"created_on" => date("Y-m-d H:i:s"),
        		"created_by" => $sesion_data['userid']
        		
        	);
        	$this->db->insert('center_timing_detail', $timing_dtl_ary);
        }
	}

	

	private function insertIntoDocumentUpload($centerId,$data,$sesion_data)
	{
		if($data['centerData']['centerMode']=="EDIT" && $data['centerData']['centerID']>0)
		{	
			$where_centerdata = array(
				"uploaded_documents_all.upload_from_module_id" => $centerId,
				"uploaded_documents_all.upload_from_module" => "CENTER"
				);

			$this->db->where($where_centerdata);
			$this->db->delete('uploaded_documents_all'); 
		}

		 //$dir1 = $_SERVER['DOCUMENT_ROOT'].'/assets/UploadedDocs/CenterUpload'; //FCPATH . '/posts';
		// $dir1 = 'http://softhought.com/diagnostic/application/assets/UploadedDocs/CenterUpload'; //FCPATH . '/posts';
		//$dir1 = APPPATH . 'assets/UploadedDocs/CenterUpload/'; //FCPATH . '/posts';
		//$dir1 = $_SERVER['DOCUMENT_ROOT'].'/prosikshan_panel/application/assets/document/trainerUpload';

	    $dir1 = APPPATH . 'assets/ds-documents/center_upload'; 
	
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

        
        if(isset($data['centerData']['centerUploadisChangedFile'])){
        	$count_docs = sizeof($data['centerData']['centerUploadisChangedFile']);
	        for($k=0;$k<$count_docs;$k++)
	        {
	        	
	        	
	        	if($data['centerData']['centerUploadisChangedFile'][$k]=="Y")
	        	{
	        			
	        		$_FILES['images[]']['name']= $_FILES['centerUploadfileName']['name'][$k];
		            $_FILES['images[]']['type']= $_FILES['centerUploadfileName']['type'][$k];
		            $_FILES['images[]']['tmp_name']= $_FILES['centerUploadfileName']['tmp_name'][$k];
		            $_FILES['images[]']['error']= $_FILES['centerUploadfileName']['error'][$k];
		            $_FILES['images[]']['size']= $_FILES['centerUploadfileName']['size'][$k];
					$this->upload->initialize($config);
					if ($this->upload->do_upload('images[]'))
					{
		               $file_detail = $this->upload->data();
		               $file_name = $file_detail['file_name']; 
		               $detail_array =array(
							"random_file_name" => $file_name,
							"document_type_id" => $data['centerData']['centerUploaddocType'][$k],
							"user_file_name" => $data['centerData']['centerUploaduserFileName'][$k],
							"uploaded_file_desc" => $data['centerData']['centerUploadfileDesc'][$k],
							"uploaded_on" => date('Y-m-d'),
							"modified_on" => date('Y-m-d'),
							"upload_from_module" => "CENTER",
							"upload_from_module_id" => $centerId,
							"upload_srl_no" => $k+1,
							"created_by" => $sesion_data['userid'],
							"is_active" => 'Y'
						); 

		             	$this->db->insert('uploaded_documents_all',$detail_array);	
		            }
	        	}
	        	else
	        	{
	        		$detail_array_unchanged =array(
						"random_file_name" => $data['centerData']['centerUploadrandomFileName'][$k],
						"document_type_id" => $data['centerData']['centerUploaddocType'][$k],
						"user_file_name" => $data['centerData']['centerUploadprvFilename'][$k],
						"uploaded_file_desc" => $data['centerData']['centerUploadfileDesc'][$k],
						"uploaded_on" => date('Y-m-d H:i:s'),
						"modified_on" => date('Y-m-d H:i:s'),
						"upload_from_module" => "CENTER",
						"upload_from_module_id" => $centerId,
						"upload_srl_no" => $k+1,
						"created_by" => $sesion_data['userid'],
						"is_active" => 'Y'
					); 

					$this->db->insert('uploaded_documents_all',$detail_array_unchanged);
	        	}

	        	
	        }
    	}


        /*
        for($i=0;$i<sizeof($data['centerUploadData']['centerUploadfileName']['name']);$i++)
        {
      		$_FILES['images[]']['name']= $_FILES['centerUploadfileName']['name'][$i];
            $_FILES['images[]']['type']= $_FILES['centerUploadfileName']['type'][$i];
            $_FILES['images[]']['tmp_name']= $_FILES['centerUploadfileName']['tmp_name'][$i];
            $_FILES['images[]']['error']= $_FILES['centerUploadfileName']['error'][$i];
            $_FILES['images[]']['size']= $_FILES['centerUploadfileName']['size'][$i];
			$this->upload->initialize($config);
			if ($this->upload->do_upload('images[]'))
			{
               $file_detail = $this->upload->data();
               $file_name = $file_detail['file_name']; 
               $detail_array =array(
					"random_file_name" => $file_name,
					"document_type_id" => $data['centerData']['centerUploaddocType'][$i],
					"user_file_name" => $data['centerData']['centerUploaduserFileName'][$i],
					"uploaded_file_desc" => $data['centerData']['centerUploadfileDesc'][$i],
					"uploaded_on" => date('Y-m-d'),
					"modified_on" => date('Y-m-d'),
					"upload_from_module" => "CENTER",
					"upload_from_module_id" => $centerId,
					"upload_srl_no" => $i+1,
					"created_by" => $sesion_data['userid'],
					"is_active" => 'Y'
				); 

             	$this->db->insert('uploaded_documents_all',$detail_array);	
            }
        }
		*/
		
	}



	public function getPincodeID($pincode)
	{
	 	$pincode_id = 0;
	 	$where = array("pincode_master.pincode"=>$pincode,"pincode_master.is_active"=>"Y");
		try
	 	{
			$this->db->select("pincode_master.`id` AS pincodeID,
							pincode_master.`pincode` ,
							pincode_master.`district_id` AS districtID")
				->from('pincode_master')
				->where($where);

			$query = $this->db->get();
			if($query->num_rows()> 0)
			{
	           $row = $query->row();
	           $pincode_id = $row->pincodeID;
	        }
	        return $pincode_id;
			
		}
	 	catch(Exception $err)
	 	{
	 		 echo $err->getTraceAsString();
	 	}
	}

	/*--------------------------*/

	public function insertIntoUploadFile($data,$session_data,$where_data)
	{
		if($data['mode']=="Edit" && $data['trainerID']>0)
		{

			$where_trainer = array(
				"document_upload_all.upload_from_module_id" => $data['trainerID'],
				"document_upload_all.upload_from_module" => $where_data['From']
				);

				$this->db->where($where_trainer);
				$this->db->delete('document_upload_all'); 

		}

		//$dir = APPPATH . 'assets/document/trainerUpload/'; //FCPATH . '/posts';
		//$dir = APPPATH . 'assets/application_extension/';
		//$dir1 = $_SERVER['DOCUMENT_ROOT'].'/img';
		$dir1 = $_SERVER['DOCUMENT_ROOT'].'/prosikshan_panel/application/assets/document/trainerUpload';
		//echo "<br>";
		//echo "Document ROOT : ". $dir ='http://prosikshan.in/images';
		//exit;
		
		$config = array(
			'upload_path' => $dir1,
			'allowed_types' => 'docx|doc|pdf|jpg|png|txt|xls',
			'max_size' => '5120', // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_filename' => '255',
			'encrypt_name' => TRUE,
			);

		$this->load->library('upload', $config);
		$images = array();
        $detail_array = array();	

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
					"document_type_id" => $data['docType'][$i],
					"user_file_name" => $data['userFilename'][$i],
					"uploaded_file_desc" => $data['fileDesc'][$i],
					"uploaded_on" => date('Y-m-d'),
					"modified_on" => date('Y-m-d'),
					"upload_from_module" => "Trainer",
					"upload_from_module_id" => $where_data['masterID'],
					"sub_comp_id" => $session_data['subcomp_id'],
					"uploaded_by_user" => $session_data['user_id'],
					"is_active" => 'Y'
				); 

             	$this->db->insert('document_upload_all',$detail_array);	
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
					"document_type_id" => $data['docType'][$k],
					"user_file_name" => $data['prvFilename'][$k],
					"uploaded_file_desc" => $data['fileDesc'][$k],
					"uploaded_on" => date('Y-m-d'),
					"modified_on" => date('Y-m-d'),
					"upload_from_module" => "Trainer",
					"upload_from_module_id" => $where_data['masterID'],
					"sub_comp_id" => $session_data['subcomp_id'],
					"uploaded_by_user" => $session_data['user_id'],
					"is_active" => 'Y'
				); 

				$this->db->insert('document_upload_all',$detail_array_edit);	
			}
        }

	}

	/*--------------------------*/




}