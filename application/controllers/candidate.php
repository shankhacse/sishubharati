<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class candidate extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('excel');//load PHPExcel library
        $this->load->model('candidate_xls_model');
        $this->load->model('batchmodel','',TRUE);
        $this->load->model('projectmodel','',TRUE);
    
	}	


	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$result = "";
			$header = "";

			$result['mode'] = "Add";
			$result['submitBtn'] = "Upload";
			$result['btnText'] = "Verify";
	       // $result['candidateList'] = $this->candidate_xls_model->getAllCandidateList($session['subcomp_id']);
			$result['batchList'] = $this->batchmodel->getBatchList($session['subcomp_id']);
			$page = 'dashboard/candidate/upload_File_candidate_view';
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('login','refresh');
		}
	}


	public function candidateExcelDataAdd()	
	{
		if($this->session->userdata('user_data'))
		{  
			$session = $this->session->userdata('user_data');
			$batch_id = $this->input->post('sel_batch');
			
		/*$dir1 = $_SERVER['DOCUMENT_ROOT'].'/prosikshan_panel/application/assets/document/CandidateFileXLS';	//server*/
		

		$dir1 = APPPATH.'/assets/document/CandidateFileXLS';		//localhost
		$config = array(
			'upload_path' => $dir1,
			'allowed_types' =>  'xlsx|xls|txt|docx|jpeg|jpg|png|gif',
			'max_size' => '5120', // Can be set to particular file size , here it is 2 MB(2048 Kb)
			'max_filename' => '255',
			'encrypt_name' => TRUE,
			);

		 $this->load->library('upload', $config);
		 $this->upload->do_upload('candidatefile');
		 // $error = array('error' => $this->upload->display_errors());
		// print_r($error);
		 $upload_data = $this->upload->data(); 
         $file_name = $upload_data['file_name']; 
		 $extension=$upload_data['file_ext'];  

       
		 $docType=7;
		 $detail_array =array(
					"random_file_name" => $file_name,
					"document_type_id" =>  $docType,
					
					
					"uploaded_on" => date('Y-m-d'),
					"modified_on" => date('Y-m-d'),
					"upload_from_module" => "candidate",
					
					"sub_comp_id" => $session['subcomp_id'],
					"uploaded_by_user" => $session['user_id'],
					"is_active" => 'Y'
				); 

	      $insertDocDataID = $this->candidate_xls_model->insertIntoDocAll($detail_array);

	     $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
          //Set to read only
        $objReader->setReadDataOnly(true); 
         	  
        //Load excel file
		 $objPHPExcel=$objReader->load(APPPATH.'assets/document/CandidateFileXLS/'.$file_name);		 
         $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
         $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
          //loop from first data untill last data
//echo $totalrows;
			  for($i=2;$i<=$totalrows;$i++) 
           
         
        	  {  
              $tp_enrollment_number=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(0,$i)->getValue())); 	     	         //Excel Column 0		
              $candidate_id=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(1,$i)->getValue()));   			                 //Excel Column 1		
              $course_name=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(2,$i)->getValue()));   			                 //Excel Column 2		
              $salutation=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(3,$i)->getValue())); 		      			         //Excel Column 3		
              $first_name_candidate=htmlspecialchars(trim( $objWorksheet->getCellByColumnAndRow(4,$i)->getValue()));  			         //Excel Column 4
			  $last_name_candidate=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(5,$i)->getValue()));    			         //Excel Column 5
			  $guardian_type=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(6,$i)->getValue()));          			         //Excel Column 6
			  $marital_status=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(7,$i)->getValue()));	     			         //Excel Column 7
			  $date_of_birth=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(8,$i)->getValue()));          			         //Excel Column 8

			  if (strpos($date_of_birth, '/') !== false) 
			  {
  				  $date_of_birth=str_replace(['/'], '-', $objWorksheet->getCellByColumnAndRow(8,$i)->getValue());  
  				  $date_of_birth = date("Y-m-d",strtotime($date_of_birth));
  				
			  }
			  else
			  {
			  		$date_of_birth = $objWorksheet->getCellByColumnAndRow(8,$i)->getValue();
			  		$date_of_birth= ($date_of_birth == "" ? NULL : date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($date_of_birth)) );

			  		
			  }

			  $place_of_birth=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(9,$i)->getValue()));  					         //Excel Column 9
			  $first_name_of_father_guardian=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(10,$i)->getValue()));            //Excel Column 10
			  $last_name_of_father_guardian=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(11,$i)->getValue()));             //Excel Column 11
			  $aadhaar_enrollment_number=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(12,$i)->getValue()));                //Excel Column 12
			  $aadhaarno=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(13,$i)->getValue()));                                //Excel Column 13

			  $alternative_id_type=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(14,$i)->getValue()));                      //Excel Column 14
			  $alternative_id_no=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(15,$i)->getValue()));                        //Excel Column 15

             // add 23.03.2018 
			      
	
			  $ration_card_no=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(16,$i)->getValue() ));         			     //Excel Column 16
			  $gender=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(17,$i)->getValue())); 								     //Excel Column 17
			  $caste_category=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(18,$i)->getValue()));  					     //Excel Column 18
			  $religion=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(19,$i)->getValue())); 			    			     //Excel Column 19
			  $trainee_address=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(20,$i)->getValue()));         			     //Excel Column 20
			  $tc_state= htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(21,$i)->getValue()));  							     //Excel Column 21
			  $tc_district=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(22,$i)->getValue())); 						     //Excel Column 22
			  $pin_code=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(23,$i)->getValue()));                			     //Excel Column 23
			  $contactno_of_trainee=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(24,$i)->getValue()));    			     //Excel Column 24
			  $email_of_trainee=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(25,$i)->getValue()));        			     //Excel Column 25
			  $pre_training_status=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(26,$i)->getValue()));     			     //Excel Column 26
			  $no_of_years_of_previous_experience=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(27,$i)->getValue()));       //Excel Column 27
			  $no_of_month_of_previous_experience=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(28,$i)->getValue()));       //Excel Column 28
			  $education_level=  htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(29,$i)->getValue()));                        //Excel Column 29


			 

			  $technical_education=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(30,$i)->getValue()));              	     //Excel Column 30
			  $sector_covered=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(31,$i)->getValue()));                   	     //Excel Column 31
			  $fee_paid_by= htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(32,$i)->getValue()));                    	     //Excel Column 32
			  $placement_status=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(33,$i)->getValue()));                 	     //Excel Column 33
			  $employment_type=  htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(34,$i)->getValue()));     //Excel Column 34
			//  echo "doj : ".$date_of_joining=str_replace(['/'], '-', $objWorksheet->getCellByColumnAndRow(35,$i)->getValue());          //Excel Column 35
			 
			  $dateJoining = $objWorksheet->getCellByColumnAndRow(35,$i)->getValue();
			  if (strpos($dateJoining, '/') !== false) 
			  {
  				  $date_of_joining=str_replace(['/'], '-', $objWorksheet->getCellByColumnAndRow(35,$i)->getValue());  
  				  $date_of_joining = date("Y-m-d",strtotime($date_of_joining));
  				
			  }
			  else
			  {
			  		$date_of_joining = $objWorksheet->getCellByColumnAndRow(35,$i)->getValue();
			  		$date_of_joining= ($date_of_joining == "" ? NULL : date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($date_of_joining) ));

			  		
			  }

			 
			  $employer_name_or_self_employed=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(36,$i)->getValue()));   	     //Excel Column 36
			  $employer_contact_person_name=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(37,$i)->getValue()));     	     //Excel Column 37
			  $employer_contact_person_designation=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(38,$i)->getValue()));      //Excel Column 38
			  $employer_contact_no=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(39,$i)->getValue()));                      //Excel Column 39
			  $location_of_employer_state=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(40,$i)->getValue()));               //Excel Column 40
			  $location_of_employer_district=  htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(41,$i)->getValue()));          //Excel Column 41
			  $state_of_placement_or_work= htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(42,$i)->getValue() ));             //Excel Column 42

			  // htmlspecialchars(trim()); 
			 
			  $district_of_placement_or_work= htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(43,$i)->getValue()));           //Excel Column 43
			  $monthly_earning_or_ctc_before_training= htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(44,$i)->getValue() )); //Excel Column 44
			  $monthly_current_ctc_or_earning= htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(45,$i)->getValue()));          //Excel Column 45
			  $below_poverty_line=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(46,$i)->getValue()));                       //Excel Column 46
			  $annual_household_income=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(47,$i)->getValue()));  				 //Excel Column 47
			  $passport_number=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(48,$i)->getValue()));                          //Excel Column 48
			  $validity_date=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(49,$i)->getValue()));  						     //Excel Column 49
			  $skilling_category=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(50,$i)->getValue())); 					     //Excel Column 50
			  $bank_name=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(51,$i)->getValue()));  							     //Excel Column 51
			  $branch_address=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(52,$i)->getValue())); 						     //Excel Column 52
			  $ifsc_code=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(53,$i)->getValue()));  								 //Excel Column 53
			  $bank_account_number=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(54,$i)->getValue()));						 //Excel Column 54

			  // save ID of another table date 26.03.2018
              if ($course_name!="") {
			  $whereCourseNane = array("course.course_name"=>$course_name);
			  $courseData = $this->commondatamodel->getSingleRowByWhereCls('course',$whereCourseNane);
			  $courseID=$courseData->id;
			  }else{ $courseID=NULL;  }

			  if ($salutation!="") {
			  $whereSalutationType = array("salutation.type"=>$salutation);
			  $salutationData = $this->commondatamodel->getSingleRowByWhereCls('salutation',$whereSalutationType);
			  $salutationID=$salutationData->id;
			  }else{ $salutationID=NULL;  }

			  if ($guardian_type!="") {
			  $whereGuardianType = array("guardian_type_master.type"=>$guardian_type);
			  $guardianData = $this->commondatamodel->getSingleRowByWhereCls('guardian_type_master',$whereGuardianType);
			  $guardianID=$guardianData->id;
			  }else{ $guardianID=NULL;  }

			  if ($marital_status!="") {
			  $whereMaritalStatus = array("marital_status.status"=>$marital_status);
			  $maritalStatusData = $this->commondatamodel->getSingleRowByWhereCls('marital_status',$whereMaritalStatus);
              $maritalID=$maritalStatusData->id;
              }else{ $maritalID=NULL;  }

              if ($gender!="") {
			  $whereGenderType = array("gender.type"=>$gender);
			  $genderData = $this->commondatamodel->getSingleRowByWhereCls('gender',$whereGenderType);
              $genderID=$genderData->id;
              }else{ $genderID=NULL;  }


              if ($caste_category!="") {
			  $whereCasteType = array("caste_category_master.type"=>$caste_category);
			  $casteData = $this->commondatamodel->getSingleRowByWhereCls('caste_category_master',$whereCasteType);
              $casteID=$casteData->id;
              }else{ $casteID=NULL;  }


              if ($religion!="") {
			  $whereReligionType = array("religion_master.type"=>$religion);
			  $religionData = $this->commondatamodel->getSingleRowByWhereCls('religion_master',$whereReligionType);
              $religionID=$religionData->id;
              }else{ $religionID=NULL;  }

              if ($tc_state!="") {
			  $whereTcState = array("state_master.state_name"=>$tc_state);
			  $tcstateData = $this->commondatamodel->getSingleRowByWhereCls('state_master',$whereTcState);
              $tcstateID=$tcstateData->state_id;
              }else{ $tcstateID=NULL;  }

              if ($tc_district!="") {
			  $whereTcDistrict = array("district_master.district_name"=>$tc_district);
			  $tcdistrictData = $this->commondatamodel->getSingleRowByWhereCls('district_master',$whereTcDistrict);
              $tcdistrictID=$tcdistrictData->district_id;
              }else{ $tcdistrictID=NULL;  }

              if ($pre_training_status!="") {
			  $wherePreTraining = array("pre_training_status.type"=>$pre_training_status);
			  $preTrainingData = $this->commondatamodel->getSingleRowByWhereCls('pre_training_status',$wherePreTraining);
              $pretrainingstatusID=$preTrainingData->id;
              }else{ $pretrainingstatusID=NULL;  }

              if ($education_level!="") {
			  $whereEducationLevel = array("education_level_master.level"=>$education_level);
			  $educationLevelData = $this->commondatamodel->getSingleRowByWhereCls('education_level_master',$whereEducationLevel);
              $educationLevelID=$educationLevelData->id;
              }else{ $educationLevelID=NULL;  }

              if ($technical_education!="") {
			  $whereTechnicalEducation = array("technical_education.type"=>$technical_education);
			  $technicaleducationData = $this->commondatamodel->getSingleRowByWhereCls('technical_education',$whereTechnicalEducation);
              $technicaleducationID=$technicaleducationData->id;
              }else{ $technicaleducationID=NULL;  }

              if ($sector_covered!="") {
			  $whereSectorCovered = array("sector_covered_master.name"=>$sector_covered);
			  $sectorcoveredData = $this->commondatamodel->getSingleRowByWhereCls('sector_covered_master',$whereSectorCovered);
              $sectorcoveredID=$sectorcoveredData->id;
              }else{ $sectorcoveredID=NULL;  }

              if ($fee_paid_by!="") {
			  $whereFeePaidType = array("fee_paid_by.type"=>$fee_paid_by);
			  $feepaidtypeData = $this->commondatamodel->getSingleRowByWhereCls('fee_paid_by',$whereFeePaidType);
              $feepaidtypeID=$feepaidtypeData->id;
              }else{ $feepaidtypeID=NULL;  }

              if ($employment_type!="") {
			  $whereEmploymentType = array("employment_type_master.type"=>$employment_type);
			  $employmentData = $this->commondatamodel->getSingleRowByWhereCls('employment_type_master',$whereEmploymentType);
              $employmentID=$employmentData->id;
              }else{ $employmentID=NULL;  }

              if ($location_of_employer_state!="") {
			  $wherelocationOfempState = array("state_master.state_name"=>$location_of_employer_state);
			  $locationOfempstateData = $this->commondatamodel->getSingleRowByWhereCls('state_master',$wherelocationOfempState);
              $locationOfempstateID=$locationOfempstateData->state_id;
              }else{ $locationOfempstateID=NULL;  }


              if ($location_of_employer_district!="") {
			  $whereLocationOfempDistrict = array("district_master.district_name"=>$location_of_employer_district);
			  $locationOfempDistrictData = $this->commondatamodel->getSingleRowByWhereCls('district_master',$whereLocationOfempDistrict);
              $locationOfempDistrictID=$locationOfempDistrictData->district_id;
              }else{ $locationOfempDistrictID=NULL;  }

              if ($state_of_placement_or_work!="") {
			  $whereStateOfPlacement = array("state_master.state_name"=>$state_of_placement_or_work);
			  $stateofplacementData = $this->commondatamodel->getSingleRowByWhereCls('state_master',$whereStateOfPlacement);
              $stateofplacementID=$stateofplacementData->state_id;
              }else{ $stateofplacementID=NULL;  }

              if ($district_of_placement_or_work!="") {
			  $whereDistrictOfPlacement = array("district_master.district_name"=>$district_of_placement_or_work);
			  $districtofplacementData = $this->commondatamodel->getSingleRowByWhereCls('district_master',$whereDistrictOfPlacement);
              $districtofplacementID=$districtofplacementData->district_id;
              }else{ $districtofplacementID=NULL;  }

              if ($annual_household_income!="") {
			  $whereAnnualHouseholdIncome= array("annual_household_income.income_limit"=>$annual_household_income);
			  $annualhouseholdincomeData = $this->commondatamodel->getSingleRowByWhereCls('annual_household_income',$whereAnnualHouseholdIncome);
              $annualhouseholdincomeID=$annualhouseholdincomeData->id;
              }else{ $annualhouseholdincomeID=NULL;  }

               if ($skilling_category!="") {
			  $whereSkillingCategory= array("skilling_category_master.category"=>$skilling_category);
			  $skillingcategoryData = $this->commondatamodel->getSingleRowByWhereCls('skilling_category_master',$whereSkillingCategory);
              $skillingcategorID=$skillingcategoryData->id;
              }else{ $skillingcategorID=NULL;  }


           
                                


			  // end another table
			  

			  $data_candidate=array(
			  	'batch_id'=>$batch_id, 
			  	'tp_enrollment_number'=>$tp_enrollment_number, 
			  	'candidate_id'=>$candidate_id, 
			  	'course_id'=>$courseID, 
			  	'upload_id'=>$insertDocDataID, 
			  	'salutation'=>$salutationID, 
			  	'first_name'=>$first_name_candidate,
			  	'last_name'=>$last_name_candidate,
			  	'guardian_type'=>$guardianID,
			  	'marital_status'=>$maritalID ,
			  	'date_of_birth'=>$date_of_birth,
			  	'place_of_birth'=>$place_of_birth,
			  	'first_name_of_father_guardian'=>$first_name_of_father_guardian,
			  	'last_name_of_father_guardian'=>$last_name_of_father_guardian,
			  	'aadhaar_enrollment_no'=>$aadhaar_enrollment_number,
			  	'aadhaar_no'=>$aadhaarno,
			  	'alternative_id_type'=>$alternative_id_type,
			  	'alternative_id_no'=>$alternative_id_no,

			  	'ration_card_no'=>$ration_card_no,
			  	'gender'=>$genderID,
			  	'caste_category'=>$casteID,
			  	'religion'=>$religionID,
			  	'trainee_address'=>$trainee_address,
			  	'tc_state'=>$tcstateID,
			  	'tc_district'=>$tcdistrictID,
			  	'pin_code'=>$pin_code,
			  	'contactno_of_trainee'=>$contactno_of_trainee,
			  	'email_of_trainee'=>$email_of_trainee,
			  	'pre_training_status'=>$pretrainingstatusID,
			  	'no_of_years_of_previous_experience'=>$no_of_years_of_previous_experience,
			  	'no_of_month_of_previous_experience'=>$no_of_month_of_previous_experience,
			  	'education_level'=>$educationLevelID,

			  	'technical_education'=>$technicaleducationID,
			  	'sector_covered'=>$sectorcoveredID,
			  	'fee_paid_by'=>$feepaidtypeID,
			  	'placement_status'=>$placement_status,
			  	'employment_type'=>$employmentID,
			  	'date_of_joining'=>$date_of_joining,
			  	'employer_name_or_self_employed'=>$employer_name_or_self_employed,
			  	'employer_contact_person_name'=>$employer_contact_person_name,
			  	'employer_contact_person_designation'=>$employer_contact_person_designation,
			  	'employer_contact_no'=>$employer_contact_no,
			  	'location_of_employer_state'=>$locationOfempstateID,
			  	'location_of_employer_district'=>$locationOfempDistrictID,
			  	'state_of_placement_or_work'=>$stateofplacementID,

			  	'district_of_placement_or_work'=>$districtofplacementID,
			  	'monthly_earning_or_ctc_before_training'=>$monthly_earning_or_ctc_before_training,
			  	'monthly_current_ctc_or_earning'=>$monthly_current_ctc_or_earning,
			  	'below_poverty_line'=>$below_poverty_line,
			  	'annual_household_income'=>$annualhouseholdincomeID,
			  	'passport_number'=>$passport_number,
			  	'validity_date'=>($validity_date == "" ? NULL : date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($validity_date)) ),
			  	'skilling_category'=>$skillingcategorID,
			  	'bank_name'=>$bank_name,
			  	'branch_address'=>$branch_address,
			  	'ifsc_code'=>$ifsc_code,
			  	'bank_account_number'=>$bank_account_number

			  	
			  	);
			  
			 /*  echo "<pre>";
			  print_r($data_candidate);
			  echo "</pre>";*/
			//  exit;
			  		
			  			$where_unit = array(
							"candidate_master.candidate_id" => $data_candidate['candidate_id'],
							"candidate_master.sub_comp_id" => $session['subcomp_id']
						);

		             $row_count = $this->commondatamodel->checkExistanceData('candidate_master',$where_unit);
					  	
					 
					 
					if ( $row_count==1) {

					$user_activity = array(
					"activity_date" => date("Y-m-d H:i:s"),
					"activity_module" => 'Candidate',
					"activity_module_desc" => "Update Candidate ",
					"action" => "Update",
					"from_method" => "candidate/Uploadcandidate",
					"user_id" => $session['user_id'],
					"sub_comp_id" => $session['subcomp_id'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
				);
					$insertData = $this->commondatamodel->updateData_WithUserActivity('candidate_master',$data_candidate,$where_unit,'user_activity_report',$user_activity);

					}else
					{

					$insertData = $this->candidate_xls_model->insertIntoCandidate($data_candidate,$session);
					

				     }
              
						  
          }
          

           $insert_user_activity = array(
					"activity_date" => date("Y-m-d H:i:s"),
					"activity_module" => 'Candidate',
					"activity_module_desc" => "Upload Candidate ",
					"action" => "Insert",
					"from_method" => "candidate/Uploadcandidate",
					"user_id" => $session['user_id'],
					"sub_comp_id" => $session['subcomp_id'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
				);
			
		$this->candidate_xls_model->insertActivity($insert_user_activity);


          if($insertData)
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
						"msg_data" => "There is some problem while updating ...Please try again."
					);
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


   public function candidateList()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$result = "";
			$header = "";
			
			
			$result['projectList'] = $this->projectmodel->getProjectList($session['subcomp_id']);
			$result['batchList'] = $this->batchmodel->getBatchList($session['subcomp_id']);
			#$result['candidateList'] = $this->candidate_xls_model->getAllCandidateList($session['subcomp_id']);
			$page = 'dashboard/candidate/candidatelist_view';
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('login','refresh');
		}
	}

	 public function candidateDetails()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			
			$project = $this->input->post('project');
			$batch = $this->input->post('batch');
			
			
			$result['candidateList'] = $this->candidate_xls_model->getAllCandidateList($session['subcomp_id'],$project,$batch);
			/*$page = 'dashboard/candidate/candidate_details_summery';
			createbody_method($result, $page, $header, $session);*/

			$viewTemp = $this->load->view('dashboard/candidate/candidate_details_summery',$result);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}



/*  Validate Candiadtes */
public function validatecandidate()
	{   
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$batchID = trim(htmlspecialchars($this->input->post('sel_batch')));
			$where = array("batch_master.id"=>$batchID);
			$batchData = $this->commondatamodel->getSingleRowByWhereCls('batch_master',$where);

			if($_FILES['candidatefile']['error']!=4)
			{
				 $tempFile = $_FILES['candidatefile']['tmp_name'];
				//$extension = ".xls";
				
              $array = explode('.', $_FILES['candidatefile']['name']);
             $extension = end($array);

				
				if($extension=="xls")
				{
					$objReader= PHPExcel_IOFactory::createReader('Excel5');	// For excel 2007 	  
				}
				else
				{           	
				    $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
				}
				



				
				$filename =  $tempFile;
				
				$objReader->setReadDataOnly(true); 		
				$objPHPExcel=$objReader->load($filename);
		        $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
		        $objWorksheet=$objPHPExcel->setActiveSheetIndex(0); 
		        $totalcolumn = $objPHPExcel->setActiveSheetIndex(0)->getHighestDataColumn();

		 
		   
		        for($i=2;$i<=$totalrows;$i++)
		        {      
		            	$enrollmentnumber[] = array(
							/*"error" => $this->isValidEnrolment($objWorksheet->getCellByColumnAndRow(0,$i)->getValue()),*/
							"error" => 0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(0,$i)->getColumn().$i,
							"value" =>  ($objWorksheet->getCellByColumnAndRow(0,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(0,$i)->getValue()  ),
						); 
						$candidate_id[] = array(
							"error" => $this->isValidCandidateID($objWorksheet->getCellByColumnAndRow(1,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(1,$i)->getColumn().$i,
							"value" =>  ($objWorksheet->getCellByColumnAndRow(1,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(1,$i)->getValue()  ),
						);
						$course_name[] = array(  
							"error" => $this->isValidCourseName($objWorksheet->getCellByColumnAndRow(2,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(2,$i)->getColumn().$i,
							"value" =>  ($objWorksheet->getCellByColumnAndRow(2,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(2,$i)->getValue()  ),
						);    

						$salutation[] = array(
							"error" => $this->isValidSalutation($objWorksheet->getCellByColumnAndRow(3,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(3,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(3,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(3,$i)->getValue()  ),
						);

						$first_name[] = array(
							"error" => $this->isValidFname($objWorksheet->getCellByColumnAndRow(4,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(4,$i)->getColumn().$i,
							"value" =>  ($objWorksheet->getCellByColumnAndRow(4,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(4,$i)->getValue()  ),
						); 

						$last_name[] = array(
							"error" => $this->isValidLname($objWorksheet->getCellByColumnAndRow(5,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(5,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(5,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(5,$i)->getValue()  ),
						);

						$guardian_type[] = array(
							"error" => $this->isValidGuardianType($objWorksheet->getCellByColumnAndRow(6,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(6,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(6,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(6,$i)->getValue()  ),
						);
						$marital_status[] = array(
							"error" => $this->isValidMaritalStatus($objWorksheet->getCellByColumnAndRow(7,$i)->getValue()),
							/*"error" => 0,*/
							"cell" =>  $objWorksheet->getCellByColumnAndRow(7,$i)->getColumn().$i,
							"value" =>($objWorksheet->getCellByColumnAndRow(7,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(7,$i)->getValue()  ),
						);
						 $date_of_birth=htmlspecialchars(trim($objWorksheet->getCellByColumnAndRow(8,$i)->getValue()));  
							  if (strpos($date_of_birth, '/') !== false) 
							  {
				  				  $date_of_birth=str_replace(['/'], '-', $objWorksheet->getCellByColumnAndRow(8,$i)->getValue());  
				  				  $date_of_birth = date("d-m-Y",strtotime($date_of_birth));
				  				
							  }
							  else
							  {
							  		$date_of_birth = $objWorksheet->getCellByColumnAndRow(8,$i)->getValue();
							  		$date_of_birth= ($date_of_birth == "" ? NULL : date('d-m-Y', PHPExcel_Shared_Date::ExcelToPHP($date_of_birth)) );

							  		
							  }

						$dob[] = array(
							"error" =>  $this->isValidDate($objWorksheet->getCellByColumnAndRow(8,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(8,$i)->getColumn().$i,
							"value" => $date_of_birth,
						);

						$place_of_birth[] = array(
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(9,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(9,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(9,$i)->getValue()  ),
						);

						$fnameguardian[] = array(
							"error" => $this->isValidGrdFname($objWorksheet->getCellByColumnAndRow(10,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(10,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(10,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(10,$i)->getValue()  ),
						);
						$lnameguardian[] = array(
							"error" => $this->isValidGrdLname($objWorksheet->getCellByColumnAndRow(11,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(11,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(11,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(11,$i)->getValue()  ),
						);
						$aadhaar_enr_no[] = array(
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(12,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(12,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(12,$i)->getValue()  ),
						);
						$aadhaar_no[] = array(
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(13,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(13,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(13,$i)->getValue()  ),
						);

						//add 24.03.2018

						$alternative_id_type[] = array(
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(14,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(14,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(14,$i)->getValue()  ),
						);
						$alternative_id_no[] = array(
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(15,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(15,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(15,$i)->getValue()  ),
						);


						//------------------------------------------
						$ration_no[] = array(
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(16,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(16,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(16,$i)->getValue()  ),
						);

						$gender[] = array(
							"error" => $this->isValidGender($objWorksheet->getCellByColumnAndRow(17,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(17,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(17,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(17,$i)->getValue()  ),
						);

						$caste_category[] = array(
							"error" => $this->isValidCasteCategory($objWorksheet->getCellByColumnAndRow(18,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(18,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(18,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(18,$i)->getValue()  ),
						);

						$religion[] = array(
							"error" => $this->isValidReligion($objWorksheet->getCellByColumnAndRow(19,$i)->getValue()),
							/*"error" =>  0,*/
							"cell" =>  $objWorksheet->getCellByColumnAndRow(19,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(19,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(19,$i)->getValue()  ),
						);

						$trainee_address[] = array(   //validate required isValidTraineeAddress
							"error" => $this->isValidTraineeAddress($objWorksheet->getCellByColumnAndRow(20,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(20,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(20,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(20,$i)->getValue()  ),
						);

						$state[] = array(
							"error" => $this->isValidState($objWorksheet->getCellByColumnAndRow(21,$i)->getValue()),
							/*"error" =>  0,*/
							"cell" =>  $objWorksheet->getCellByColumnAndRow(21,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(21,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(21,$i)->getValue()  ),
						);

						$district[] = array(
							"error" => $this->isValidDistrict($objWorksheet->getCellByColumnAndRow(21,$i)->getValue(),$objWorksheet->getCellByColumnAndRow(22,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(22,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(22,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(22,$i)->getValue()  ),
						);

						$pin_code[] = array(
							/*"error" => $this->isValidPinCode($objWorksheet->getCellByColumnAndRow(21,$i)->getValue()),*/
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(23,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(23,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(23,$i)->getValue()  ),
						);

						$contact_no_trainee[] = array(
							"error" => $this->isValidContact($objWorksheet->getCellByColumnAndRow(24,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(24,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(24,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(24,$i)->getValue()  ),
						);

						// add on 24.03.2018

						$email_of_trainee[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(25,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(25,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(25,$i)->getValue()  ),
						);

						$pre_training_status[] = array(	
							"error" =>  $this->isValidPreTrainingStatus($objWorksheet->getCellByColumnAndRow(26,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(26,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(26,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(26,$i)->getValue()  ),
						);

						$no_of_years_of_previous_experience[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(27,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(27,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(27,$i)->getValue()  ),
						);

						$no_of_month_of_previous_experience[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(28,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(28,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(28,$i)->getValue()  ),
						);

						$education_level[] = array(	    
							"error" => $this->isValidEducationLevel($objWorksheet->getCellByColumnAndRow(29,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(29,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(29,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(29,$i)->getValue()  ),
						);

						$technical_education[] = array(	
							"error" =>   $this->isValidTechnicalEducation($objWorksheet->getCellByColumnAndRow(30,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(30,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(30,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(30,$i)->getValue()  ),
						);
								
						$sector_covered[] = array(	
							"error" =>   $this->isValidSectorCovered($objWorksheet->getCellByColumnAndRow(31,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(31,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(31,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(31,$i)->getValue()  ),
						);

						$fee_paid_by[] = array(	
							"error" =>   $this->isValidFeePaidBy($objWorksheet->getCellByColumnAndRow(32,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(32,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(32,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(32,$i)->getValue()  ),
						);

						$placement_status[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(33,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(33,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(33,$i)->getValue()  ),
						);
							
						$employment_type[] = array(	
							"error" =>   $this->isValidEmploymentType($objWorksheet->getCellByColumnAndRow(34,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(34,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(34,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(34,$i)->getValue()  ),
						);

							  $dateJoining = $objWorksheet->getCellByColumnAndRow(35,$i)->getValue();
							  if (strpos($dateJoining, '/') !== false) 
							  {
				  				  $dateJoining=str_replace(['/'], '-', $objWorksheet->getCellByColumnAndRow(35,$i)->getValue());  
				  				  $dateJoining = date("d-m-Y",strtotime($dateJoining));
				  				
							  }
							  else
							  {
							  		$dateJoining = $objWorksheet->getCellByColumnAndRow(35,$i)->getValue();
							  		$dateJoining= ($dateJoining == "" ? NULL : date('d-m-Y', PHPExcel_Shared_Date::ExcelToPHP($dateJoining) ));

							  		
							  }

						$date_of_joining[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(35,$i)->getColumn().$i,
							"value" => $dateJoining,
						);

						$employer_name_or_self_employed[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(36,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(36,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(36,$i)->getValue()  ),
						);

						$employer_contact_person_name[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(37,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(37,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(37,$i)->getValue()  ),
						);

						$employer_contact_person_designation[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(38,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(38,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(38,$i)->getValue()  ),
						);

						$employer_contact_no[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(39,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(39,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(39,$i)->getValue()  ),
						);

						$location_of_employer_state[] = array(	
							"error" => $this->isValidState($objWorksheet->getCellByColumnAndRow(40,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(40,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(40,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(40,$i)->getValue()  ),
						);

						$location_of_employer_district[] = array(	
							"error" => $this->isValidDistrict($objWorksheet->getCellByColumnAndRow(40,$i)->getValue(),$objWorksheet->getCellByColumnAndRow(41,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(41,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(41,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(41,$i)->getValue()  ),
						);

						$state_of_placement_or_work[] = array(	
							"error" => $this->isValidState($objWorksheet->getCellByColumnAndRow(42,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(42,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(42,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(42,$i)->getValue()  ),
						);

						$district_of_placement_or_work[] = array(	
							"error" => $this->isValidDistrict($objWorksheet->getCellByColumnAndRow(42,$i)->getValue(),$objWorksheet->getCellByColumnAndRow(43,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(43,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(43,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(43,$i)->getValue()  ),
						);

						$monthly_earning_or_ctc_before_training[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(44,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(44,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(44,$i)->getValue()  ),
						);

						$monthly_current_ctc_or_earning[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(45,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(45,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(45,$i)->getValue()  ),
						);

						$below_poverty_line[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(46,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(46,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(46,$i)->getValue()  ),
						);     

						$annual_household_income[] = array(	
							"error" =>  $this->isValidAnnualHouseHoldIncome($objWorksheet->getCellByColumnAndRow(47,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(47,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(47,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(47,$i)->getValue()  ),
						);

						$passport_number[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(48,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(48,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(48,$i)->getValue()  ),
						);

						$validity_date[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(49,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(49,$i)->getValue() == "" ? "" : date('d-m-Y', PHPExcel_Shared_Date:: ExcelToPHP($objWorksheet->getCellByColumnAndRow(49,$i)->getValue())) ),
						);

						$skilling_category[] = array(	
							"error" =>  $this->isValidSkillCategory($objWorksheet->getCellByColumnAndRow(50,$i)->getValue()),
							"cell" =>  $objWorksheet->getCellByColumnAndRow(50,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(50,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(50,$i)->getValue()  ),
						);

						$bank_name[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(51,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(51,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(51,$i)->getValue()  ),
						);

						$branch_address[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(52,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(52,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(52,$i)->getValue()  ),
						);

						$ifsc_code[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(53,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(53,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(53,$i)->getValue()  ),
						);

						$bank_account_number[] = array(	
							"error" =>  0,
							"cell" =>  $objWorksheet->getCellByColumnAndRow(54,$i)->getColumn().$i,
							"value" => ($objWorksheet->getCellByColumnAndRow(54,$i)->getValue() == "" ? "" :$objWorksheet->getCellByColumnAndRow(54,$i)->getValue()  ),
						);

					
		        

		        }

	        }

	     /* echo "<pre>";
	      print_r($district);
	      echo "</pre>";
	        exit;
			*/
		       	$json_response= array(
		       		"msg_status" => 1,
		       		"batch" => $batchData->batch_title,

		        	"enrol" => $enrollmentnumber,
		        	"candidate_id" => $candidate_id,			  //validation check
		        	"course_name" => $course_name,				  //validation check
		        	"salut" => $salutation,			              //validation check
		        	"fname" => $first_name,						  //validation check
		        	"lname" => $last_name,      				  //validation check
		        	"guardian_type" => $guardian_type,	          //validation check
		        	"marital_status" => $marital_status,   
		        	"dob" => $dob,								  //validation check
		        	"place_of_birth" => $place_of_birth,
		        	"fnameguardian" => $fnameguardian,			  //validation check
		        	"lnameguardian" => $lnameguardian,			  //validation check
		        	"aadhaar_enr_no" => $aadhaar_enr_no,
		        	"aadhaar_no" => $aadhaar_no,
		        	"alternative_id_type" => $alternative_id_type,
		        	"alternative_id_no" => $alternative_id_no,
		        	"ration_no" => $ration_no,
		        	"gender" => $gender,					                                     //validation check
		        	"caste_category" => $caste_category,	                                     //validation check
		        	"religion" => $religion,				
		        	"trainee_address" => $trainee_address,										//validation check			
		        	"state" => $state,				        
		        	"district" => $district,				
		        	"pin_code" => $pin_code,				
		        	"contact_no_trainee" => $contact_no_trainee,                                  //validation check
		        	"email_of_trainee" => $email_of_trainee,				
		        	"pre_training_status" => $pre_training_status,				
		        	"no_of_years_of_previous_experience" => $no_of_years_of_previous_experience,				
		        	"no_of_month_of_previous_experience" => $no_of_month_of_previous_experience,				
		        	"education_level" => $education_level,			                              //validation check	
		        	"technical_education" => $technical_education,				
		        	"sector_covered" => $sector_covered,				
		        	"fee_paid_by" => $fee_paid_by,				
		        	"placement_status" => $placement_status,				
		        	"employment_type" => $employment_type,				
		        	"date_of_joining" => $date_of_joining,				
		        	"employer_name_or_self_employed" => $employer_name_or_self_employed,				
		        	"employer_contact_person_name" => $employer_contact_person_name,				
		        	"employer_contact_person_designation" => $employer_contact_person_designation,				
		        	"employer_contact_no" => $employer_contact_no,				
		        	"location_of_employer_state" => $location_of_employer_state,				
		        	"location_of_employer_district" => $location_of_employer_district,				
		        	"state_of_placement_or_work" => $state_of_placement_or_work,				
		        	"district_of_placement_or_work" => $district_of_placement_or_work,				
		        	"monthly_earning_or_ctc_before_training" => $monthly_earning_or_ctc_before_training,				
		        	"monthly_current_ctc_or_earning" => $monthly_current_ctc_or_earning,				
		        	"below_poverty_line" => $below_poverty_line,				
		        	"annual_household_income" => $annual_household_income,				
		        	"passport_number" => $passport_number,				
		        	"validity_date" => $validity_date,				
		        	"skilling_category" => $skilling_category,				
		        	"bank_name" => $bank_name,				
		        	"branch_address" => $branch_address,				
		        	"ifsc_code" => $ifsc_code,				
		        	"bank_account_number" => $bank_account_number,				

		        );


		  header('Content-Type: application/json');
		  echo json_encode( $json_response );
		  exit;
	    }
     	else
		{
			redirect('login','refresh');
		}
        	
	}


/*
	@return type boolean
	@method isValidEnrolment(enrolment)
	@date  06.03.2018
*/
	private function isValidEnrolment($enrolment)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($enrolment!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}
/*
	@return type boolean
	@method isValidSalutation(salutation_name)
	@date  06.03.2018
*/
	private function isValidSalutation($salut)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$where = array("salutation.type"=>$salut);
			$isexist = $this->commondatamodel->checkExistanceData('salutation',$where);
			if($isexist>=1)
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidFname(fname)
	@date  06.03.2018
*/
	private function isValidFname($fname)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($fname!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}


/*
	@return type boolean
	@method isValidFname(lname)
	@date  06.03.2018
*/
	private function isValidLname($lname)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($lname!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidDate(lname)
	@date  06.03.2018
*/
	private function isValidDate($date)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($date!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidGrdFname(grdfname)
	@date  06.03.2018
*/
	private function isValidGrdFname($grdfname)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($grdfname!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidGrdLname(grdlname)
	@date  06.03.2018
*/
	private function isValidGrdLname($grdlname)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($grdlname!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidGuardianType(guardian_type)
	@date  06.03.2018
*/
	private function isValidGuardianType($guardian_type)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$where = array("guardian_type_master.type"=>$guardian_type);
		    $isexist = $this->commondatamodel->checkExistanceData('guardian_type_master',$where);
			if($isexist>=1)
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidMaritalStatus(marital_status)
	@date  06.03.2018
*/
	private function isValidMaritalStatus($marital_status)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			if($marital_status!="")
			{
				$where = array("marital_status.status"=>$marital_status);
						    $isexist = $this->commondatamodel->checkExistanceData('marital_status',$where);
							if($isexist>=1)
							{
								return 0;
							}
							else
							{
								return 1;
							}		

			}
			else
			{
				return 0;
			}

   

		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidGender(marital_status)
	@date  06.03.2018
*/
	private function isValidGender($gender)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$where = array("gender.type"=>$gender);
		    $isexist = $this->commondatamodel->checkExistanceData('gender',$where);
			if($isexist>=1)
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidCasteCategory(caste)
	@date  06.03.2018
*/
	private function isValidCasteCategory($caste)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$where = array("caste_category_master.type"=>$caste);
		    $isexist = $this->commondatamodel->checkExistanceData('caste_category_master',$where);
			if($isexist>=1)
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidReligion(religion)
	@date  06.03.2018
*/
	private function isValidReligion($religion)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{


			if($religion!="")
			{
				$where = array("religion_master.type"=>$religion);
			    $isexist = $this->commondatamodel->checkExistanceData('religion_master',$where);
				if($isexist>=1)
				{
					return 0;
				}
				else
				{
					return 1;
				}


			}
			else
			{
				return 0;
			}
				
		
		}
		else
		{
			redirect('login','refresh');
		}
	}


/*
	@return type boolean
	@method isValidState(state)
	@date  07.03.2018
*/
	private function isValidState($state)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($state!="")
			{

				$where = array("state_master.state_name"=>$state);
			    $isexist = $this->commondatamodel->checkExistanceData('state_master',$where);
				if($isexist>=1)
				{
					return 0;
				}
				else
				{
					return 1;
				}
				
			}
			else
			{
				return 0;
			}

		


		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidDistrict(district)
	@date  07.03.2018
*/


			  
            


	private function isValidDistrict($state,$district)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			if($district!="" && $state!="")
			{
					  $whereTcState = array("state_master.state_name"=>$state);
					  $tcstateData = $this->commondatamodel->getSingleRowByWhereCls('state_master',$whereTcState);
		              $tcstateID=$tcstateData->state_id;


						$where = array(
							"district_master.district_name"=>$district,
							"district_master.state_id"=>$tcstateID
					    );
					    $isexist = $this->commondatamodel->checkExistanceData('district_master',$where);
						if($isexist>=1)
						{
							return 0;
						}
						else
						{
							return 1;
						}
		
				
			}elseif ($district!="") {

						$where = array("district_master.district_name"=>$district);
					    $isexist = $this->commondatamodel->checkExistanceData('district_master',$where);
						if($isexist>=1)
						{
							return 0;
						}
						else
						{
							return 1;
						}

				
			}
			else
			{
				return 0;
			}

		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidPinCode(pin_code)
	@date  07.03.2018
*/
	private function isValidPinCode($pin_code)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($pin_code!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}


/*
	@return type boolean
	@method isValidContact(contact_n0)
	@date  24.03.2018
*/
	private function isValidContact($contact_no)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($contact_no!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}


/*
	@return type boolean
	@method isValidTraineeAddress(address)
	@date  24.03.2018
*/
	private function isValidTraineeAddress($address)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($address!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidCourseName(name)
	@date  24.03.2018
*/
	private function isValidCourseName($name)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
		$where = array("course.course_name"=>trim($name));
		    $isexist = $this->commondatamodel->checkExistanceData('course',$where);
			if($isexist>=1)
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}


/*
	@return type boolean
	@method isValidCandidateID(id)
	@date  24.03.2018
*/
	private function isValidCandidateID($id)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($id!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}


/*
	@return type boolean
	@method isValidEducationLevel(level)
	@date  24.03.2018
*/
	private function isValidEducationLevel($level)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			
			if($level!="")
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			redirect('login','refresh');
		}
	}


/*
	@return type boolean
	@method isValidPreTrainingStatus(pretrainingstatus)
	@date  26.03.2018
*/
	private function isValidPreTrainingStatus($pretrainingstatus)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{


			if($pretrainingstatus!="")
			{
				$where = array("pre_training_status.type"=>$pretrainingstatus);
			    $isexist = $this->commondatamodel->checkExistanceData('pre_training_status',$where);
				if($isexist>=1)
				{
					return 0;
				}
				else
				{
					return 1;
				}


			}
			else
			{
				return 0;
			}
				
		
		}
		else
		{
			redirect('login','refresh');
		}
	}


/*
	@return type boolean
	@method isValidTechnicalEducation($status)
	@date  26.03.2018
*/
	private function isValidTechnicalEducation($status)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{


			if($status!="")
			{
				$where = array("technical_education.type"=>$status);
			    $isexist = $this->commondatamodel->checkExistanceData('technical_education',$where);
				if($isexist>=1)
				{
					return 0;
				}
				else
				{
					return 1;
				}


			}
			else
			{
				return 0;
			}
				
		
		}
		else
		{
			redirect('login','refresh');
		}
	}



/*
	@return type boolean
	@method isValidSectorCovered($sector)
	@date  26.03.2018
*/
	private function isValidSectorCovered($sector)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{


			if($sector!="")
			{
				$where = array("sector_covered_master.name"=>$sector);
			    $isexist = $this->commondatamodel->checkExistanceData('sector_covered_master',$where);
				if($isexist>=1)
				{
					return 0;
				}
				else
				{
					return 1;
				}


			}
			else
			{
				return 0;
			}
				
		
		}
		else
		{
			redirect('login','refresh');
		}
	}

/*
	@return type boolean
	@method isValidFeePaidBy($fee)
	@date  26.03.2018
*/
	private function isValidFeePaidBy($fee)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{


			if($fee!="")
			{
				$where = array("fee_paid_by.type"=>$fee);
			    $isexist = $this->commondatamodel->checkExistanceData('fee_paid_by',$where);
				if($isexist>=1)
				{
					return 0;
				}
				else
				{
					return 1;
				}


			}
			else
			{
				return 0;
			}
				
		
		}
		else
		{
			redirect('login','refresh');
		}
	}



/*
	@return type boolean
	@method isValidEmploymentType($type)
	@date  26.03.2018
*/
	private function isValidEmploymentType($type)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{


			if($type!="")
			{
				$where = array("employment_type_master.type"=>$type);
			    $isexist = $this->commondatamodel->checkExistanceData('employment_type_master',$where);
				if($isexist>=1)
				{
					return 0;
				}
				else
				{
					return 1;
				}


			}
			else
			{
				return 0;
			}
				
		
		}
		else
		{
			redirect('login','refresh');
		}
	}


/*
	@return type boolean
	@method isValidAnnualHouseHoldIncome($income)
	@date  26.03.2018
*/
	private function isValidAnnualHouseHoldIncome($income)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{


			if($income!="")
			{
				$where = array("annual_household_income.income_limit"=>$income);
			    $isexist = $this->commondatamodel->checkExistanceData('annual_household_income',$where);
				if($isexist>=1)
				{
					return 0;
				}
				else
				{
					return 1;
				}


			}
			else
			{
				return 0;
			}
				
		
		}
		else
		{
			redirect('login','refresh');
		}
	}


/*
	@return type boolean
	@method isValidSkillCategory($category)
	@date  26.03.2018
*/
	private function isValidSkillCategory($category)
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{


			if($category!="")
			{
				$where = array("skilling_category_master.category"=>$category);
			    $isexist = $this->commondatamodel->checkExistanceData('skilling_category_master',$where);
				if($isexist>=1)
				{
					return 0;
				}
				else
				{
					return 1;
				}


			}
			else
			{
				return 0;
			}
				
		
		}
		else
		{
			redirect('login','refresh');
		}
	}




}//End of class

?>

